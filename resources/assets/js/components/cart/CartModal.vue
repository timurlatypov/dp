<template>
    <div class="modal" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog px-2" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title my-0" id="ModalLabel">Товар добавлен в корзину!</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" v-if="product">
                    <table class="table table-shopping">
                        <tbody>
                        <tr>
                            <td>
                                <div class="img-container">
                                    <img :src="'/storage/products/thumb/'+product.thumb_path" alt="">
                                </div>
                            </td>
                            <td class="td-name">
                                <b>{{ product.title_eng }}</b><br>
                                <small>{{ product.title_rus }}</small><br>
                                <small class="text-uppercase">{{ product.brand.name }}</small>
                            </td>
                            <td>{{ product.priceToShow }}&nbsp;<i class="fas fa-ruble-sign" style="font-size: 90%"></i></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>

                </div>

                <div class="modal-footer mx-auto">
                    <button type="button" class="btn btn-default mr-2 font-weight-bold" data-dismiss="modal">Продолжить покупки</button>
                    <a href="/checkout" class="btn btn-primary font-weight-bold">Оформить заказ</a>
                </div>

            </div>
        </div>
    </div>

</template>

<script>
    export default {
        props: ['payload'],
        data() {
            return {
                product: null,
                cart: null
            }
        },
        created() {
            if (this.message) {
                this.cartModal(this.message);
            }
            window.events.$on('cartModal', payload => {
                axios.get('/cart/refresh')
                    .then(response => {
                        this.cartModal(payload, response);
                    })
            })
        },
        methods: {
            cartModal(payload ,response) {
                $('#cartModal').modal('show');
                this.product = payload;
                this.cart = response.data;
            },
        }
    }
</script>