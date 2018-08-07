<template>
    <button type="submit" class="btn btn-default btn-sm" @click.prevent="saveToCart" :disabled="disabled">
        <i class="material-icons pb-1" v-html="disabled ? 'thumb_up' : 'shopping_cart'"></i> {{ disabled ? 'В корзине' : 'В корзину'}}
        <div class="ripple-container"></div>
    </button>
</template>

<script>
    export default {
        props: ['endpoint', 'model', 'price_to_show'],
        data() {
            return {
                payload: {
                    priceToShow: ''
                },
                disabled: false,
            }
        },
        methods: {
            saveToCart() {
                axios.post(this.endpoint, this.payload)
                    .then( response => {
                        window.cartUpdate();
                        window.flash('Продукт '+this.payload.title_eng+' добавлен в корзину');
                        this.disabled = true;
                    } )
            }
        },
        mounted() {
            this.payload = this.model;
            this.payload.priceToShow = this.price_to_show;
        }
    }
</script>
