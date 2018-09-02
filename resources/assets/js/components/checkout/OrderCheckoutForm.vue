<template>
    <div class="card" v-if="show_checkout">
        <div class="px-4 py-3 mx-auto text-center">
            <h3 class="title">Корзина</h3>
            <p class="p-5">В вашей корзине нет товаров</p>
        </div>
    </div>
    <div class="card" v-else-if="new_order_created">
        <div class="px-4 py-3 mx-auto text-center">
            <h4 class="title">Мы получили Ваш заказ!</h4>
            <p class="pb-5">В ближайшее время мы Вам позвоним по указанному телефону. Ожидайте подтверждение заказа</p>
        </div>
    </div>
    <div class="card" v-else>
        <div class="px-4 py-3 mx-auto">
            <h3 class="title">Ваш заказ</h3>
        </div>
        <div class="table-responsive px-5">

            <table class="table table-shopping">
                <thead>
                <tr style="vertical-align: top">
                    <th class="text-center" style="width: 80px;"></th>
                    <th>Продукт</th>
                    <th>Цена</th>
                    <th class="text-center">Скидка</th>
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
                            <img :src="'storage/products/thumb/'+product.options.image" alt="...">
                        </div>
                    </td>

                    <td class="td-name">
                        <a class="font-weight-bold" :href="'/brand/'+product.options.brand_slug+'/'+product.options.product_slug">{{ product.name }}</a>
                        <br><small>{{ product.options.title_rus }}</small>
                        <br><small class="text-uppercase">{{ product.options.brand }}</small>
                    </td>

                    <td class="font-weight-bold">{{ product.price }}&nbsp;&#x20BD;</td>
                    <td class="text-center font-weight-bold text-danger">-{{ product.biggest_discount }}%</td>
                    <td class="font-weight-bold">{{ product.discounted_price.toFixed(decimals) }}&nbsp;&#x20BD;</td>

                    <td class="td-actions text-center">
                        <ul role="navigation" class="pagination my-auto mx-auto">
                            <li class="page-item">
                                <button class="page-link" @click.prevent="removeItem(index, product.rowId, product.qty)">-</button>
                            </li>
                            <li class="page-item active">
                                <span class="page-link"><strong>{{ product.qty }}</strong></span>
                            </li>
                            <li class="page-item">
                                <button class="page-link" @click.prevent="addItem(index, product.rowId, product.qty)">+</button>
                            </li>
                        </ul>
                    </td>

                    <td class="td-number font-weight-bold">{{ product.subtotal.toFixed(decimals) }}&nbsp;&#x20BD;</td>

                    <td class="td-actions text-center">
                        <button type="button" class="btn btn-simple" @click.prevent="deleteItem(product.rowId)">
                            <i class="material-icons">close</i>
                        </button>
                    </td>
                </tr>

                <tr>
                    <td colspan="5" rowspan="10" style="vertical-align: top">
                        <!--<div class="card p-2 mx-auto" style="width: 300px;">-->
                            <!--<div class="card-body text-center">-->
                                <!--<h4 class="title my-1">Промокод</h4>-->
                                <!--<div class="form-group mx-auto" :class="order.coupon.valid ? ' has-success' : ''" style="width: 150px;">-->
                                    <!--<input class="form-control font-weight-bold text-center" type="text" v-model="order.coupon.coupon" v-on:change="validateCoupon" :disabled="coupon_input_disabled" placeholder="Промокод">-->
                                    <!--<small class="form-text text-danger" v-if="!order.coupon.valid">{{ order.coupon.error }}</small>-->
                                    <!--<small class="form-text text-success" v-if="order.coupon.valid">{{ order.coupon.success }}</small>-->
                                <!--</div>-->
                            <!--</div>-->
                        <!--</div>-->
                    </td>
                    <td><h4 class="title my-0">Итого</h4></td>
                    <td><h4 class="title my-0">{{ order.billing_total.toFixed(decimals) }} <i class="fas fa-ruble-sign fa-sm"></i></h4></td>
                    <td></td>
                </tr>

                </tbody>
            </table>
        </div>
        <div class="px-4 py-3 mx-auto">
            <h3 class="title">Покупатель</h3>
        </div>
        <div class="container px-5">
            <div class="row pb-3">
                <div class="col-12 col-md-5 offset-md-1">
                    <div class="form-group" @click.prevent="setFocus('name')">
                        <label for="name">Имя</label>
                        <input type="text" class="form-control" id="name" aria-describedby="nameHelp" v-model="order.user.name">
                        <small id="nameHelp" class="form-text text-muted"></small>
                    </div>
                </div>
                <div class="col-12 col-md-5">
                    <div class="form-group" @click.prevent="setFocus('surname')">
                        <label for="surname">Фамилия</label>
                        <input type="text" class="form-control" id="surname" aria-describedby="surnameHelp" v-model="order.user.surname">
                        <small id="surnameHelp" class="form-text text-muted"></small>
                    </div>
                </div>
            </div>

            <div class="row pb-3">
                <div class="col-12 col-md-5 offset-md-1">
                    <div class="form-group" @click.prevent="setFocus('phone')">
                        <label for="phone">Телефон</label>
                        <input id="phone" type="text" class="form-control" v-model="order.user.phone">
                        <small class="form-text text-muted"></small>
                    </div>
                </div>
                <div class="col-12 col-md-5">
                    <div class="form-group" @click.prevent="setFocus('email')">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" v-model="order.user.email">
                        <small id="emailHelp" class="form-text text-muted"></small>
                    </div>
                </div>
            </div>

        </div>
        <div class="px-4 pt-3 mx-auto">
            <h3 class="title pb-0">Адрес доставки</h3>
        </div>

        <!--<div class="px-4 pb-5 mx-auto" v-if="this.auth_user_addresses">-->
            <!--<div class="dropdown show">-->
                <!--<a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                    <!--Мои адреса-->
                <!--</a>-->
                <!--<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">-->
                    <!--<a class="dropdown-item" href="#" v-for="address, index in user_addresses" @click.prevent="applySavedAddress(index)">{{ address.address_name }}</a>-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->

        <div class="container px-5 pb-5">

            <div class="row pb-3">
                <div class="col-12 col-md-5 offset-md-1">
                    <div class="form-group" @click.prevent="setFocus('billing_city')">
                        <label for="billing_city">Город</label>
                        <input type="text" class="form-control" id="billing_city" aria-describedby="billing_cityHelp" v-model="order.address.billing_city">
                        <small id="billing_cityHelp" class="form-text text-muted"></small>
                    </div>
                </div>
                <div class="col-12 col-md-5">
                    <div class="form-group" @click.prevent="setFocus('billing_street')">
                        <label for="billing_street">Улица</label>
                        <input type="text" class="form-control" id="billing_street" aria-describedby="billing_streetHelp" v-model="order.address.billing_street">
                        <small id="billing_streetHelp" class="form-text text-muted"></small>
                    </div>
                </div>
            </div>

            <div class="row pb-3">
                <div class="col-12 col-md-2 offset-md-1">
                    <div class="form-group" @click.prevent="setFocus('billing_house')">
                        <label for="billing_house">Дом</label>
                        <input type="text" class="form-control" id="billing_house" aria-describedby="billing_houseHelp" v-model="order.address.billing_house">
                        <small id="billing_houseHelp" class="form-text text-muted"></small>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group" @click.prevent="setFocus('billing_apartment')">
                        <label for="billing_apartment">Квартира</label>
                        <input type="text" class="form-control" id="billing_apartment" aria-describedby="billing_apartmentHelp" v-model="order.address.billing_apartment">
                        <small id="billing_apartmentHelp" class="form-text text-muted"></small>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="form-group" @click.prevent="setFocus('billing_entrance')">
                        <label for="billing_entrance">Подъезд</label>
                        <input type="text" class="form-control" id="billing_entrance" aria-describedby="billing_entranceHelp" v-model="order.address.billing_entrance">
                        <small id="billing_entranceHelp" class="form-text text-muted"></small>
                    </div>
                </div>

                <div class="col-12 col-md-2">
                    <div class="form-group" @click.prevent="setFocus('billing_floor')">
                        <label for="billing_floor">Этаж</label>
                        <input type="text" class="form-control" id="billing_floor" aria-describedby="billing_floorHelp" v-model="order.address.billing_floor">
                        <small id="billing_floorHelp" class="form-text text-muted"></small>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-10 offset-md-1">
                    <div class="form-group" @click.prevent="setFocus('billing_comment')">
                        <label for="billing_comment">Комментарий к заказу</label>
                        <textarea class="form-control" id="billing_comment" rows="5" v-model="order.address.billing_comment"></textarea>
                    </div>
                </div>
            </div>

        </div>
        <div class="px-4 pb-5 mx-auto">
            <button type="submit" class="btn btn-primary" @click.prevent="storeOrder">
                <i class="material-icons pb-1">check</i> Отправить заказ<div class="ripple-container"></div>
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['session_cart', 'session_cart_subtotal', 'session_coupon', 'auth_user', 'auth_user_addresses'],
        data() {
            return {
                decimals: 2,
                new_order_created: false,
                payload: {
                    rowId: '',
                    qty: ''
                },
                user_addresses: {},
                coupon_input_disabled: false,
                order: {
                    cart: [],
                    user: {
                        loyalty: 0, // Default value 0 if !Auth()->User()
                    },

                    coupon: {
                        discount: 0,
                        coupon: '',
                        error: '',
                        valid: false
                    },

                    address: {
                        billing_city: '',
                        billing_street: '',
                        billing_house: '',
                        billing_apartment: '',
                        billing_entrance: '',
                        billing_floor: '',
                        billing_comment: '',
                    },
                    billing_total: 0,
                }
            }
        },
//////////////////////////////////////////////////
//
//
//                  COMPUTED
//
//
////////////////////////////////////////////////////
        computed: {
            show_checkout: function () {
                return this.order.cart.length === 0 ? true : false;
            }
        },
//////////////////////////////////////////////////
//
//
//                  METHODS
//
//
////////////////////////////////////////////////////
        methods: {
            setFocus(el) {
                document.getElementById(el).focus();
            },
            // Checkout actions
            addItem(index, rowId, qty) {
                if (qty >= 10) {
                    return;
                }

                this.payload.rowId = rowId;
                this.payload.qty = qty;

                axios.post('/checkout/add', this.payload)
                    .then( response => {
                        this.refreshStage(Object.values(response.data.cart));
                        window.cartUpdate();
                    })

            },
            removeItem(index, rowId, qty) {
                if (qty === 1) {
                    return;
                }

                this.payload.rowId = rowId;
                this.payload.qty = qty;

                axios.post('/checkout/remove', this.payload)
                    .then( response => {
                        this.refreshStage(Object.values(response.data.cart));
                        window.cartUpdate();
                    })
            },
            deleteItem(rowId) {
                axios.delete('/checkout/delete/'+rowId)
                    .then( response => {
                        this.refreshStage(Object.values(response.data.cart));
                        window.cartUpdate();
                    })
            },
            // Checkout form logic
            defineBiggestDiscount(productDiscount, loyaltyDiscount, couponDiscount) {
                return Math.max(productDiscount, loyaltyDiscount, couponDiscount);
            },
            discountedPrice(price, discount){
                return (Math.round( (Number(price) - (Number(price) * (discount/100))) * 100 ) / 100).toFixed(2);
            },
            calcSubtotal(discounted_price, qty) {
                return (discounted_price * qty).toFixed(2);
            },
            calcTotal() {
                let that = this;
                this.order.billing_total = 0;
                this.order.cart.forEach( function (product, index) {
                    that.order.billing_total += Number(product.subtotal);
                });
            },

            validateCoupon() {
                axios.post('/coupon/validate', this.order.coupon)
                    .then( response => {
                        if( response.status === 202) {
                            this.order.coupon.error = response.data.message;
                            return;
                        }
                        this.order.coupon = response.data.coupon;
                        this.coupon_input_disabled = true;
                        this.order.coupon.valid = true;
                        this.order.coupon.success = 'Промокод применён';
                    }).catch( (e) => {
                })
            },
            applySavedAddress(index) {
                this.order.address = this.user_addresses[index];
            },

            storeOrder() {
                axios.post('/order/store', this.order)
                    .then(response => {
                        window.flash('Заказ получен!')
                        this.new_order_created = true;
                        window.cartUpdate();
                    })
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
                if (this.session_cart) {
                    this.order.cart = Object.values(this.session_cart);
                }

                if (this.auth_user) {
                    this.order.user = this.auth_user;
                }

                if (this.auth_user_addresses) {
                    this.user_addresses = this.auth_user_addresses;
                }

                if (this.session_coupon) {
                    this.order.coupon = this.session_coupon;
                    this.coupon_input_disabled = true;
                    this.order.coupon.valid = true;
                    this.order.coupon.success = 'Промокод применён';
                }

                this.order.cart.map((product, index) => {
                    product.biggest_discount = Number(this.defineBiggestDiscount(product.options.discount, this.order.user.loyalty, this.order.coupon.discount));
                    product.discounted_price =  Number(this.discountedPrice(product.price, product.biggest_discount));
                    product.subtotal = Number(this.calcSubtotal(product.discounted_price, product.qty));
                });

                this.calcTotal();
            }
        },
        mounted() {
            this.initStage();
        }
    }
</script>
