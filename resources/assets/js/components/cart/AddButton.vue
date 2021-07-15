<template>
    <button type="submit" class="btn btn-sm" :class="disabled ? '' : styling" @click.prevent="saveToCart" :disabled="disabled">
        <i class="fas fa-sm" :class="disabled ? ' fa-thumbs-up' : ' fa-shopping-cart'"></i>&nbsp;&nbsp;<span class="font-weight-bold">{{ disabled ? 'В корзине' : 'В корзину'}}</span>
        <div class="ripple-container"></div>
    </button>
</template>

<script>
    export default {
        props: ['endpoint', 'model', 'price_to_show', 'styling'],
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
                        window.cartModal(this.payload);
                        this.disabled = true;
                    })
            }
        },
        mounted() {
            this.payload = this.model;
            this.payload.priceToShow = this.price_to_show;
        }
    }
</script>
