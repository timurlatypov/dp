<template>
    <div class="tw-relative" :class="[classes]">

        <p class="tw-font-bold tw-text-base">Город отправления</p>
        <input value="г Москва" readonly type="text" class="tw-shadow tw-appearance-none tw-border tw-rounded tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight tw-focus:outline-none tw-focus:shadow-outline">

        <p class="tw-font-bold tw-text-base tw-pt-6">Город доставки</p>
        <input
                v-bind="$attrs"
                type="text"
                class="tw-shadow tw-appearance-none tw-border tw-rounded tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight tw-focus:outline-none tw-focus:shadow-outline"
                :placeholder="placeholder"
                autocomplete="off"
                v-model="query"
                @keydown.down="down"
                @keydown.up="up"
                @keydown.enter.prevent="hit"
                @keydown.esc="reset"
                @input="update($event)"
        />
        <div class="tw-absolute tw-border tw-w-full tw-rounded tw-shadow tw-bg-white tw-p-1" v-if="showResult">
            <template v-if="hasItems">
                <ul class="" role="menu" aria-labelledby="dropdownMenu">
                    <li v-for="(item , index) in items" :class="{active:activeClass(index)}" :key="'li'+index"
                        @mousedown="hit" @mousemove="setActive(index)">
                        <a href="#">{{ item.value }}</a>
                    </li>
                </ul>
            </template>
            <template v-else="!hasItems">
                <ul v-if="showSearchingFlag" class="" role="menu" aria-labelledby="dropdownMenu">
                    <li class="active" v-if="!loading">
                        <a>
                            <span v-html="NoResultText"></span>
                        </a>
                    </li>
                    <li class="active" v-else>
                        <a>
                            <span v-html="SearchingText"></span>
                        </a>
                    </li>
                </ul>
            </template>

        </div>
        <div class="tw-pt-6">
            <button class="tw-bg-orange-500 tw-hover:bg-orange-500 tw-text-white tw-font-bold tw-py-2 tw-px-4 tw-rounded tw-inline-flex tw-items-center"
                    @click.prevent="calculatePrice" type="button">
                <span>Рассчитать</span>
            </button>
        </div>

        <div class="tw-flex tw-pt-4" v-if="prices">
            <div class="tw-flex-initial tw-rounded tw-text-gray-700 tw-bg-gray-200 tw-mr-2 tw-my-2 tw-p-4 w-12 lg:w-1/4">
                <p class="tw-font-bold">СКЛАД-СКЛАД</p>
                <p class="tw-text-xs">До пункта выдачи</p>
                <p class="tw-pt-2 tw-text-lg tw-font-bold tw-text-green-500" v-if="prices[0].result.price">{{ prices[0].result.price }} руб.</p>
                <p class="tw-pt-2 tw-text-base tw-font-bold tw-text-red-500" v-if="prices[0].result.errors">Нет доставки</p>
                <p class="tw-text-xs" v-if="prices[0].result.price">Сроки: {{ getDeliveryDays(prices[1].result) }}</p>
            </div>
            <div class="tw-flex-initial tw-rounded tw-text-gray-700 tw-bg-gray-200 tw-mr-2 tw-my-2 tw-p-4 w-12 lg:w-1/4">
                <p class="tw-font-bold">СКЛАД-ДВЕРЬ</p>
                <p class="tw-text-xs">До двери</p>
                <p class="tw-pt-2 tw-text-lg tw-font-bold tw-text-green-500" v-if="prices[1].result.price">{{ prices[1].result.price }} руб.</p>
                <p class="tw-pt-2 tw-text-base tw-font-bold tw-text-red-500" v-if="prices[1].result.errors">Нет доставки</p>
                <p class="tw-text-xs" v-if="prices[1].result.price">Сроки: {{ getDeliveryDays(prices[1].result) }}</p>
            </div>
        </div>

    </div>
</template>
<style scoped>
    .dropdown-menu-list {
        display: list-item;
        width: 100%;
    }
</style>
<script>
  import axios from 'axios'

  function escapeRegExp(str) {
    // eslint-disable-next-line no-useless-escape
    return str.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, '\\$&')
  }

  export default {
    name: 'TypeAhead',
    props: {
      selectFirst: {
        required: false,
        type: Boolean,
        default: false
      },
      queryParamName: {
        required: false,
        type: String,
        default: ':keyword'
      },
      limit: {
        required: false,
        type: Number,
        default: 10
      },
      minChars: {
        required: false,
        type: Number,
        default: 2
      },
      src: {
        required: false,
        type: String
      },
      delayTime: {
        required: false,
        default: 100,
        type: Number
      },
      placeholder: {
        required: false,
        type: String
      },
      showSearchingFlag: {
        required: false,
        default: true,
        type: Boolean
      },
      NoResultText: {
        required: false,
        default: 'No result',
        type: String
      },
      SearchingText: {
        required: false,
        default: 'Searching...',
        type: String
      },
      classes: {
        required: false,
        type: String
      },
      value: {
        required: false,
        type: String,
        default: ''
      },
      onHit: {
        required: false,
        type: Function,
        default: function (item) {
          this.query = item
        }
      },
      render: {
        required: false,
        type: Function,
        default: function (items) {
          return items
        }
      },
      getResponse: {
        required: false,
        type: Function
      },
      fetch: {
        required: false,
        type: Function,
        default: function (url) {
          return axios.get(url)
        }
      },
      objectArray: {
        required: false,
        type: Array
      },
    },
    data() {
      return {
        items: [],
        query: '',
        kladr_id: null,
        prices: null,
        current: -1,
        loading: false,
        lastTime: 0,
        data: [],
        showResult: false,
        isDisabled: true,
      }
    },
    methods: {
      getDeliveryDays(data) {
        if (data.deliveryPeriodMin == data.deliveryPeriodMax) {
          return data.deliveryPeriodMin + ' день';
        } else {
          return data.deliveryPeriodMin +'-'+ data.deliveryPeriodMax + ' дня';
        }
      },
      objectUpdate() {
        var filtered = this.objectArray.filter(entity => entity.toLowerCase().includes(this.query.toLowerCase()))
        this.data = this.limit ? filtered.slice(0, this.limit) : filtered
        this.items = this.render(this.limit ? this.data.slice(0, this.limit) : this.data, this)
        this.current = -1
        if (this.selectFirst) {
          this.down()
        }
      },
      calculatePrice() {
        this.isDisabled = true
        this.prices = null
        this.fetch('/api/v1/get-price?id=' + this.kladr_id)
          .then((response) => {
            this.prices = response.data.result
          })
      },
      update(event) {
        this.lastTime = event.timeStamp
        if (!this.query) {
          return this.reset()
        }
        if (this.minChars && this.query.length < this.minChars) {
          return
        }
        setTimeout(() => {
          if (this.lastTime - event.timeStamp === 0) {
            if (this.objectArray) {
              return this.objectUpdate()
            }
            this.loading = true
            this.showResult = true
            const re = new RegExp(this.queryParamName, 'g')

            this.fetch(this.src.replace(re, encodeURIComponent(this.query)))
              .then((response) => {
                let data = this.getResponse(response)

                this.items = this.render(this.limit ? data.slice(0, this.limit) : data, this)
                this.current = -1
                this.loading = false
                if (this.selectFirst) {
                  this.down()
                }

                })
          }
        }, this.delayTime)
      },
      setActive(index) {
        this.current = index
      },
      activeClass(index) {
        return this.current === index
      },
      hit() {
        if (this.current !== -1) {
          this.onHit(this.items[this.current], this, this.current)
        }
        this.reset()
      },
      up() {
        if (this.current > 0) {
          this.current--
        } else if (this.current === -1) {
          this.current = this.items.length - 1
        } else {
          this.current = -1
        }
        if (!this.selectFirst && this.current !== -1) {
          this.onHit(this.items[this.current], this)
        }
      },
      down() {
        if (this.current < this.items.length - 1) {
          this.current++
        } else {
          this.current = -1
        }
        if (!this.selectFirst && this.current !== -1) {
          this.onHit(this.items[this.current], this)
        }
      },
      reset: function () {
        this.items = []
        this.loading = false
        this.showResult = false
      }
    },
    watch: {
      value: function (value) {
        this.query = this.query !== value ? value : this.query
      },
      query: function (value) {
        this.$emit('input', value)
      }
    },
    computed: {
      vue: function () {
        return this
      },
      hasItems() {
        return this.items.length > 0
      },
      isEmpty() {
        return this.query === ''
      }
    },
    mounted() {
      this.query = this.value

      document.addEventListener('click', (e) => {
        if (!this.$el.contains(e.target)) {
          this.reset()
        }
      })
      if (this.objectArray) {
        this.objectArray.sort()
      }
    }
  }
</script>

<style scoped>
    .typeahead-dropdown-container {
        position: relative;
        width: 100%;
    }

    .type-ahead-select {
        border-top-right-radius: 0.25rem;
        border-bottom-right-radius: 0.25rem;
    }

    ul li {
        padding: 5px 0.5rem;
        margin: 0 0.25rem;
        cursor: pointer;
        border-radius: 4px;
    }

    ul li:hover {
        background-color: #f1f2f3;
    }
</style>
