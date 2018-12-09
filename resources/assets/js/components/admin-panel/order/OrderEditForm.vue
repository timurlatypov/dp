<template>
    <div>

        <form class="form-inline pt-3" action="#">
            <div class="form-group bmd-form-group pt-0 ">
                <input type="text" name="selection" id="selection" class="algolia-form-control" placeholder="Добавить продукт">
            </div>
        </form>

        <br>

        <div class="table-responsive">
            <table class="table table-shopping">
                <thead>
                    <tr style="vertical-align: top">
                        <th class="text-center" style="width: 80px;"></th>
                        <th class="w-25">Продукт</th>
                        <th class="th-description">Цена</th>
                        <th class="th-descriptiontext-center">Скидка</th>
                        <th><nobr>Цена со скидкой</nobr></th>
                        <th>Кол-во</th>
                        <th class="">Сумма</th>
                        <th class="text-center" style="width: 60px;">Удалить</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product, index in order.cart">
                        <td>
                            <div class="img-container">
                                <img :src="'/storage/products/thumb/'+product.options.image">
                            </div>
                        </td>

                        <td class="td-name">
                            <span class="font-weight-bold" href="#">{{ product.name }}</span>
                            <br><small>{{ product.options.title_rus }}</small>
                            <br><small class="text-uppercase">{{ product.options.brand }}</small>
                        </td>

                        <td class="font-weight-bold">{{ product.price }}&nbsp;&#x20BD;</td>
                        <td class="text-center font-weight-bold text-danger">-{{ product.biggest_discount }}%</td>
                        <td class="font-weight-bold">{{ product.discounted_price.toFixed(decimals) }}&nbsp;&#x20BD;</td>

                        <td class="td-actions text-center">
                            <ul role="navigation" class="pagination my-auto mx-auto">
                                <li class="page-item">
                                    <button class="page-link" @click.prevent="removeItem(index, product.discounted_price, product.qty)">-</button>
                                </li>
                                <li class="page-item active">
                                    <span class="page-link"><strong>{{ product.qty }}</strong></span>
                                </li>
                                <li class="page-item">
                                    <button class="page-link" @click.prevent="addItem(index, product.discounted_price, product.qty)">+</button>
                                </li>
                            </ul>
                        </td>

                        <td class="td-number font-weight-bold">{{ product.subtotal.toFixed(decimals) }}&nbsp;&#x20BD;</td>

                        <td class="td-actions text-center">
                            <button type="button" class="btn btn-simple" @click.prevent="deleteItem(index)">
                                <i class="material-icons">close</i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="8" class="text-right" style="vertical-align: top">
                            <h3 class="title mt-4 mb-0">Итого: <nobr>{{ order.billing_total.toFixed(decimals) }}&nbsp;&#x20BD;</nobr></h3>
                            <small class="float-none">Без учёта стоимости доставки</small>
                            <br>
                            <button class="btn btn-danger mt-3" @click.prevent="updateOrder">Сохранить заказ</button>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</template>

<script>
    import { productautocomplete } from "../../../helpers/autocomplete"

    export default {
        props: {
            details: Array,
            id: Number
        },
        data() {
            return {
                decimals: 2,

                order: {
                    cart: [],
                    billing_total: 0,
                }
            }
        },

        methods: {

            // Checkout actions
            addItem(index, discounted_price, qty) {
                if (qty >= 10) {
                    return;
                }
                this.order.cart[index].qty++;

                this.order.cart[index].subtotal = this.calcSubtotal(discounted_price, this.order.cart[index].qty)
                this.calcTotal();
            },

            removeItem(index, discounted_price, qty) {
                if (qty === 1) {
                    return;
                }

                this.order.cart[index].qty--;

                this.order.cart[index].subtotal = this.calcSubtotal(discounted_price, this.order.cart[index].qty)
                this.calcTotal();

            },
            deleteItem(index) {
                this.order.cart.splice(index, 1);
                this.calcTotal();
            },
            // Checkout form logic
            defineBiggestDiscount(productDiscount, loyaltyDiscount, couponDiscount) {
                return Math.max(productDiscount, loyaltyDiscount, couponDiscount);
            },


            discountedPrice(price, discount){
                return parseFloat((Math.round( (Number(price) - (Number(price) * (discount/100))) * 100 ) / 100).toFixed(2));
            },
            calcSubtotal(discounted_price, qty) {
                return parseFloat((discounted_price * qty).toFixed(2));
            },
            calcTotal() {
                let that = this;
                this.order.billing_total = 0;
                this.order.cart.forEach( function (product, index) {
                    that.order.billing_total += Number(product.subtotal);
                });
            },

            refreshStage(products) {
                products.map((product, index) => {
                    product.biggest_discount = Number(this.defineBiggestDiscount(product.options.discount, this.order.user.loyalty, this.order.coupon.discount));
                    product.discounted_price =  Number(this.discountedPrice(product.price, product.biggest_discount));
                    product.subtotal = Number(this.calcSubtotal(product.discounted_price, product.qty));
                });
                this.order.cart = products;
                this.calcTotal();
            },

            initStage() {

                // this.order.cart.map((product, index) => {
                //     product.biggest_discount = Number(this.defineBiggestDiscount(product.options.discount, this.order.user.loyalty, this.order.coupon.discount));
                //     product.discounted_price =  Number(this.discountedPrice(product.price, product.biggest_discount));
                //     product.subtotal = Number(this.calcSubtotal(product.discounted_price, product.qty));
                // });

                this.calcTotal();
            },

            add(selection) {
                console.log(selection)

                let discounted_price = this.discountedPrice(selection.price, selection.discount)
                let subtotal = this.calcSubtotal(discounted_price, 1)

                let item = {
                    id: selection.id,
                    name: selection.title_eng,
                    qty: 1,
                    price: selection.price,
                    options: {
                        title_rus: selection.title_rus,
                        discount: selection.discount,
                        product_slug: selection.slug,
                        brand: selection.brand.name,
                        brand_slug: selection.brand.slug,
                        image: selection.thumb_path
                    },
                    tax: null,
                    subtotal: subtotal,
                    biggest_discount: selection.discount,
                    discounted_price: discounted_price
                }

                this.order.cart.push(item);
                this.calcTotal()
            },

            async updateOrder() {
                let payload = {
                    id: this.id,
                    details: JSON.stringify(this.order.cart),
                    billing_total: this.order.billing_total
                }
                await axios.patch('/admin-panel/orders/update', payload)
                    .then((response) => {
                        console.log(response)
                        window.location = `/admin-panel/orders/${this.id}/show`;
                    })
                    .catch((error) => {
                        console.log(error)
                    })
            }
        },
        mounted() {

            this.order.cart = this.details

            productautocomplete('#selection', {
                hitsPerPage: 10
            })
                .on('autocomplete:selected', (e, selection) => {
                    this.add(selection);
                })

            this.initStage();
        }
    }
</script>
