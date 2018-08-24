<template>
    <div class="form-group bmd-form-group pt-0 ">
        <input type="text" name="products-mobile" id="products-mobile" class="algolia-form-control" placeholder="Поиск по каталогу">
    </div>
</template>

<script>
    import { productautocompletemobile } from "../helpers/autocomplete-mobile"

    export default {
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