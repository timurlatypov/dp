<template>
    <a class="text-dark" href="#" data-toggle="dropdown">
        <i class="material-icons">shopping_cart</i><span class="badge badge-pill badge-danger" v-if="count"><b>{{ count }}</b></span>
    </a>
</template>

<script>
    export default {
        props: ['cart_items', 'cart_count'],
        data() {
            return {
                items: '',
                count: '',
            }
        },
        created() {
            window.events.$on('cartUpdate', () => {
                this.cartUpdate();
            })

        },
        methods: {
            cartUpdate() {
                axios.get('/cart/refresh')
                    .then(response => {
                        this.items = response.data.cart_items;
                        this.count = response.data.cart_count;
                    })
            }
        },
        mounted() {
            this.items = this.cart_items;
            this.count = this.cart_count;
        }
    }
</script>