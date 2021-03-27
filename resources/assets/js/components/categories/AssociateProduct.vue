<template>
    <div class="w-75">
        <form class="form-inline pt-3" action="#">
            <div class="form-group bmd-form-group pt-0 ">
                <input type="text" name="selection" id="selection" class="algolia-form-control" placeholder="Добавить продукт">
            </div>
        </form>

        <div class="d-flex align-items-center" v-for="product, index in products">
            <img :src="'/storage/'+product.thumb_path" width="35px" height="35px">
            <span>{{ product.brand.name }} - {{ product.title_eng }}</span>

            <button type="button" rel="tooltip" class="btn btn-white btn-fab btn-sm mx-2" @click.prevent="remove(index)">
                <i class="material-icons">close</i>
            </button>
        </div>

        <button type="button" rel="tooltip" class="btn btn-primary btn-sm mx-2" @click.prevent="associate()">
            <i class="material-icons"></i> Сохранить
        </button>

    </div>

</template>

<script>
    import { productautocomplete } from "../../helpers/autocomplete"

    export default {
        props: ['endpoint', 'object', 'items'],
        data() {
            return {
                category: '',
                products: ''
            }
        },
        methods: {
            associate() {
                axios.patch(this.endpoint, this.products)
                    .then( response => {
                        window.flash('Изменения сохранены!');
                    })
            },
            add(selection) {
                this.products.push(selection);
            },
            remove(index) {
                this.products.splice(index, 1);
            }
        },
        mounted() {
            this.category = this.object;
            this.products = this.items;

            productautocomplete('#selection', {
                hitsPerPage: 10
            })
                .on('autocomplete:selected', (e, selection) => {
                    this.add(selection);
                })
        }
    }
</script>
