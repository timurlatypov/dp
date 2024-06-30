<template>
    <form class="form-inline pt-3">
        <div class="form-group bmd-form-group pt-0 ">
            <input type="text" name="products" id="products" v-on:keyup.enter="onEnter" v-model="data.search" class="algolia-form-control" placeholder="Поиск по каталогу">
        </div>
        <div class="btn btn-fab-search btn-white ml-1" v-on:click="onSubmit">
            <i class="material-icons" style="color: #888;">search</i>
            <div class="ripple-container"></div>
        </div>
    </form>
</template>

<script>
  import { productautocomplete } from "../helpers/autocomplete"

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
      productautocomplete('#products', {
          hitsPerPage: 20
      }).on('autocomplete:selected', (e, selection) => {
          window.location.href = '/brand/' + selection.brand.slug + '/' + selection.slug;
      })
    }
  }
</script>