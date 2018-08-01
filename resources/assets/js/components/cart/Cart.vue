<template>
    <li class="dropdown nav-item">
        <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="material-icons">shopping_cart</i>
            <span class="badge badge-pill badge-danger" v-if="count"><b>{{ count }}</b></span>
        </a>
        <div class="dropdown-menu  dropdown-menu-right dropdown-with-icons">

            <div v-if="!count">
                <span class="dropdown-item">В корзине пусто</span>
            </div>

            <div v-else>
                <a class="dropdown-item" href="/checkout">Оформить заказ</a>
                <a class="dropdown-item" href="#" v-for="item in items">ID: {{ item.id }}, Name: {{ item.name }}, Qty: {{ item.qty }}, Price: {{ item.price }}</a>
            </div>


        </div>
    </li>
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