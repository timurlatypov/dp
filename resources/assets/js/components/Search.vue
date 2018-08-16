<template>
    <form class="form-inline pt-3" action="#" @submit.prevent="send">
        <div class="form-group bmd-form-group pt-0 ">
            <input type="text" name="products" id="products" class="algolia-form-control" placeholder="Поиск по каталогу">
        </div>
        <button type="submit" class="btn btn-fab-search btn-white ml-1">
            <i class="material-icons" style="color: #888;">search</i>
            <div class="ripple-container"></div>
        </button>
    </form>
</template>

<script>
    import { productautocomplete } from "../helpers/autocomplete"

    export default {
        mounted() {
            productautocomplete('#products', {
                hitsPerPage: 20
            })
                .on('autocomplete:selected', (e, selection) => {
                    window.location.href = '/brand/' + selection.brand.name + '/' + selection.slug;
                })
        }
    }
</script>