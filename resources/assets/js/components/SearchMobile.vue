<template>
    <div class="form-group bmd-form-group pt-0 ">
        <input type="text" name="products-mobile" v-on:keyup.enter="onEnter" v-model="data.search" id="products-mobile" class="algolia-form-control" placeholder="Поиск по каталогу">
    </div>
</template>

<script>
  import { productautocompletemobile } from "../helpers/autocomplete-mobile"

  export default {
    props: {
      endpoint: {
        type: String
      }
    },
    data () {
      return {
        data: {
          search: ''
        }
      }
    },
    methods: {
      onEnter: function() {
        this.onSubmit();
      },
      onSubmit() {
        axios.post(this.endpoint, this.data)
            .then((response) => {
              this.redirect(response.data.redirect);
            }).catch((error) => {
        })
      },
      redirect(response) {
        window.location.href = response;
      }
    },
    mounted() {
      productautocompletemobile('#products-mobile', {
          hitsPerPage: 20
      })
      .on('autocomplete:selected', (e, selection) => {
          window.location.href = '/brand/' + selection.brand.slug + '/' + selection.slug;
      })
    }
  }
</script>