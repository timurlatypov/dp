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

                        <!--<td class="font-weight-bold">-->
                            <!--{{ product.price }}&nbsp;&#x20BD;-->
                        <!--</td>-->

                        <td class="text-center font-weight-bold">
                            <div class="input-group" style="max-width: 80px;">
                                <div class="input-group-prepend">
                                  <span class="input-group-text pl-0 pr-1">
                                      <i class="fa fa-ruble-sign fa-sm"></i>
                                  </span>
                                </div>
                                <input
                                        class="form-control font-weight-bold"
                                        v-model="order.cart[index].price"
                                        type="number"
                                        min="0"
                                        oninput="validity.valid||(value='');">
                            </div>
                        </td>

                        <td class="text-center font-weight-bold">
                            <div class="input-group" style="max-width: 60px;">
                                <div class="input-group-prepend">
                                  <span class="input-group-text pl-0 pr-1">
                                      <i class="fa fa-percentage"></i>
                                  </span>
                                </div>
                                <input
                                        class="form-control font-weight-bold"
                                        v-model="order.cart[index].biggest_discount"
                                        type="number"
                                        min="0"
                                        oninput="validity.valid||(value='');">
                            </div>
                        </td>

                        <td class="td-actions font-weight-bold">
                            <button type="button" class="btn btn-danger btn-simple mr-2" @click.prevent="refreshDiscountedPrice(index)">
                                <i class="material-icons">refresh</i>
                            </button>
                            {{ product.discounted_price.toFixed(decimals) }}&nbsp;&#x20BD;
                        </td>

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
                        <td colspan="8" class="td-number font-weight-bold" style="vertical-align: top">

                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <h4 class="title mt-4 mb-0">Сумма:</h4>

                                    <div class="input-group" style="max-width: 120px;">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text pl-0 pr-1">
                                              <i class="fa fa-ruble-sign fa-sm"></i>
                                          </span>
                                        </div>
                                        <input
                                                style="padding-left: 6px;"
                                                class="form-control font-weight-bold"
                                                :value="order.billing_subtotal"
                                                type="number"
                                                min="0"
                                                readonly>
                                    </div>

                                    <small class="float-none text-danger">Без учёта стоимости доставки</small>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <h4 class="title mt-4 mb-0">Доставка:</h4>
                                    <div class="input-group" style="max-width: 120px;">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text pl-0 pr-1">
                                              <i class="fa fa-ruble-sign fa-sm"></i>
                                          </span>
                                        </div>
                                        <input
                                                style="padding-left: 6px;"
                                                class="form-control font-weight-bold"
                                                v-model="order.billing_delivery"
                                                type="number"
                                                min="0"
                                                @change="calcTotal"
                                                >
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <h4 class="title mt-4 mb-0">Итого:</h4>
                                    <div class="input-group" style="max-width: 120px;">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text pl-0 pr-1">
                                              <i class="fa fa-ruble-sign fa-sm"></i>
                                          </span>
                                        </div>
                                        <input
                                                style="padding-left: 6px;"
                                                class="form-control font-weight-bold"
                                                :value="order.billing_total"
                                                type="number"
                                                min="0"
                                                readonly>
                                    </div>
                                    <small class="float-none text-success">Включая стоимости доставки</small>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="text-right">
                <a href="#" class="btn btn-danger mt-2 mb-2" @click.prevent="updateOrder">
                    <i class="material-icons">save</i>
                    Сохранить изменения
                </a>
            </div>

        </div>
    </div>
</template>

<script>
    import {productautocomplete} from "../../../helpers/autocomplete"

    export default {
        props: {
            details: Array,
            id: Number,
            billing_subtotal: Number,
            billing_delivery: Number,
            billing_total: Number,
        },
        data() {
            return {
                decimals: 2,

                order: {
                    cart: [],
                    billing_subtotal: null,
                    billing_delivery: null,
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

            refreshDiscountedPrice(index) {
                this.order.cart[index].discounted_price = parseFloat((Math.round( (Number(this.order.cart[index].price) - (Number(this.order.cart[index].price) * (this.order.cart[index].biggest_discount/100))) * 100 ) / 100).toFixed(2));
                this.order.cart[index].subtotal = this.calcSubtotal(this.order.cart[index].discounted_price, this.order.cart[index].qty);
                this.calcTotal();
            },

            calcSubtotal(discounted_price, qty) {
                return parseFloat((discounted_price * qty).toFixed(2));
            },

            calcTotal() {
                let that = this;
                this.order.billing_subtotal = 0;
                this.order.cart.forEach( function (product, index) {
                    that.order.billing_subtotal += Number(product.subtotal);
                });
                this.order.billing_total = Number(this.order.billing_subtotal) + Number(this.order.billing_delivery)
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
                    billing_total: this.order.billing_total,
                    billing_delivery: this.order.billing_delivery,
                    billing_subtotal: this.order.billing_subtotal,
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
            this.order.billing_delivery = this.billing_delivery
            this.order.billing_total = this.billing_total
            this.order.billing_subtotal = this.billing_subtotal

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
