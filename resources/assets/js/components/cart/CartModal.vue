<template>
    <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
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
                                <a href="#">{{ product.title_eng }}</a>
                                <br><small class="text-uppercase">{{ product.brand.name }}</small>
                            </td>
                            <td>{{ product.priceToShow }}&nbsp;&#x20BD;</td>
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
                    <button type="button" class="btn btn-default btn-sm mr-2" data-dismiss="modal">Продолжить покупки</button type="button">
                    <a href="/checkout" class="btn btn-primary btn-sm">Оформить заказ</a>
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