<template>
    <div class="container px-2 py-5">
        <div class="row">
            <div class="col-10 offset-1">
                <form action="#" @submit.prevent="send">
                    <div class="d-flex justify-content-center align-items-center py-2">
                        <div class="divider mb-2"></div>
                        <h6 class="text-center text-uppercase px-3">Поиск по каталогу</h6>
                        <div class="divider mb-2"></div>
                    </div>
                    <input type="text"  name="products" id="products" class="form-control" placeholder="Название препарата">
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import { productautocomplete } from "../helpers/autocomplete"

    export default {
        mounted() {
            productautocomplete('#products', {
                hitsPerPage: 30
            })
                .on('autocomplete:selected', (e, selection) => {
                    console.log(selection)
                })
        }
    }
</script>