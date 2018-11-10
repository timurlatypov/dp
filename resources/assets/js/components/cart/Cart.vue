<template>
    <li class="dropdown nav-item">
        <a class="nav-link" href="#" data-toggle="dropdown"><i class="material-icons">shopping_cart</i>
            <span class="badge badge-pill badge-danger" v-if="count"><b>{{ count }}</b></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-with-icons px-3 pb-3">

            <div v-if="!count">
                     <span class="dropdown-item">В корзине пусто</span>
            </div>

            <div v-else>
                <h6 class="my-2"><nobr>Всего наименований: {{ count }}</nobr></h6>
                <div>
                    <table class="table table-shopping table-cart">
                        <tbody>
                            <tr v-for="item in items">
                                <td><img :src="'/storage/products/thumb/'+item.options['image']" width="35px"></td>
                                <td><nobr><b>{{ item.name }}</b></nobr></td>
                                <td><nobr>{{ item.qty }} ед.</nobr></td>
                                <td><nobr>{{ item.price }} &#x20BD;</nobr></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-right"><a class="btn btn-primary btn-sm" href="/checkout">Оформить заказ</a></div>
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