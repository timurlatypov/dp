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
        selectFirst: true,
        limit: 5,
        queryParamName: ':keyword',
        minChars: 2,
        delayTime: 500,
        placeholder: 'Введите город',
        classes: 'typeahead'
      }
    },
    methods: {
      getResponse: function (response) {
        console.log(response.data.data);
        return response.data.data
      },
      onHit: function (item, vue, index) {
        vue.query = item.value

        if (item.data.kladr_id.length > 13) {
          vue.kladr_id = item.data.kladr_id.substr(0, 11) + "00";
        } else {
          vue.kladr_id = item.data.kladr_id
        }
      },
      render: function (items) {
        return items
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
