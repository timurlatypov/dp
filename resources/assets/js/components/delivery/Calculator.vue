<template>
    <div>
        <TypeAhead
                v-model="data"
                :classes="classes"
                :placeholder="placeholder"
                src="/api/v1/search?keyword=:keyword"
                :getResponse="getResponse"
                :selectFirst="selectFirst"
                :limit="parseInt(limit)"
                :queryParamName="queryParamName"
                :minChars="parseInt(minChars)"
                :delayTime="parseInt(delayTime)"
                :onHit="onHit"
                :highlighting="highlighting"
                :render="render"
                :fetch="fetch"
        ></TypeAhead>
    </div>
</template>

<script>
  import TypeAhead from './TypeAhead'

  export default {
    data () {
      return {
        data: '',
        selectFirst: false,
        limit: 5,
        queryParamName: ':keyword',
        minChars: 2,
        delayTime: 500,
        placeholder: 'Please input something',
        classes: 'typeahead'
      }
    },
    methods: {
      getResponse: function (response) {
        console.log(response.data.data);
        return response.data.data
      },
      onHit: function (item, vue, index) {
        vue.query = item
      },
      highlighting: function (item, vue) {
        return item.toString().replace(vue.query, `<b>${vue.query}</b>`)
      },
      render: function (items, vue) {
        let newItem = [vue.query, ...items]
        return newItem
      },
      fetch: function (url) {
        return axios.get(url)
      }
    },
    components: {
      TypeAhead
    }
  }
</script>
