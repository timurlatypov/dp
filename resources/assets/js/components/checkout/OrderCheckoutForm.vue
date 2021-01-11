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
                    <th class="w-50">Продукт</th>
                    <th>Цена</th>
                    <th class="text-center">Скидка</th>
                    <th class="text-center">Промокод</th>
                    <th><nobr>Цена со скидкой</nobr></th>
                    <th class="text-center">Кол-во</th>
                    <th class="">Сумма</th>
                    <th class="text-center" style="width: 60px;">Удалить</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(item, index) in order.cart">
                    <td>
                        <div class="img-container">
                            <img :src="'storage/products/thumb/' + item.options.image">
                        </div>
                    </td>
                    <td class="td-name">
                        <a class="font-weight-bold" :href="'/brand/' + item.options.brand_slug + '/' + item.options.product_slug">{{ item.name }}</a>
                        <br>
                        <small>{{ item.options.title_rus }}</small>
                        <br>
                        <small class="text-uppercase">{{ item.options.brand }}</small>
                    </td>
                    <td class="font-weight-bold">
                        <nobr>{{ item.price.toFixed(decimals) }}&nbsp;<i class="fas fa-ruble-sign" style="font-size: 90%"></i></nobr>
                    </td>
                    <td class="text-center font-weight-bold text-danger">-{{ item.options.discount }}%</td>

                        <td class="text-center font-weight-bold text-success">
                            <template v-if="item.options.coupon > 0">-{{ item.options.coupon }}%</template>
                        </td>

                    <td class="font-weight-bold">
                        <nobr>{{ item.discounted_price.toFixed(decimals) }}&nbsp;<i class="fas fa-ruble-sign" style="font-size: 90%"></i></nobr>
                    </td>
                    <td class="td-actions text-center">
                        <ul role="navigation" class="pagination my-auto mx-auto">
                            <li class="page-item">
                                <button class="page-link" @click.prevent="removeItem(index, item.rowId, item.qty)">-</button>
                            </li>
                            <li class="page-item active">
                                <span class="page-link"><strong>{{ item.qty }}</strong></span>
                            </li>
                            <li class="page-item">
                                <button class="page-link" @click.prevent="addItem(index, item.rowId, item.qty)">+</button>
                            </li>
                        </ul>
                    </td>

                    <td class="td-number font-weight-bold">
                        <nobr>{{ item.subtotal.toFixed(decimals) }}&nbsp;<i class="fas fa-ruble-sign" style="font-size: 90%"></i></nobr>
                    </td>

                    <td class="td-actions text-center">
                        <button type="button" class="btn btn-simple" @click.prevent="deleteItem(item.rowId)">
                            <i class="material-icons">close</i>
                        </button>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td class="td-actions" style="vertical-align: top">
                        <h3 class="title mb-0 mt-4">Промокод</h3>
                        <div class="form-group ">
                            <label for="exampleInput1" class="bmd-label-floating">Промокод</label>
                            <input type="text" class="form-control" style="width: 210px;" id="exampleInput1"
                                   v-model="order.coupon.coupon" :disabled="coupon_input_disabled" autocomplete="false">

                            <small class="form-text text-danger" v-if="!order.coupon.valid">{{ order.coupon.error }}&nbsp;</small>
                            <small class="form-text text-success" v-if="order.coupon.valid">{{ order.coupon.success }}&nbsp;</small>

                            <button type="button"
                                    class="btn btn-simple btn-primary mr-2 mb-2"
                                    @click.prevent="validateCoupon()"
                                    :disabled="coupon_apply_button_disabled"><i class="material-icons">check</i> <b>Применить</b>
                            </button>
                            <button type="button"
                                    class="btn btn-simple mb-2"
                                    @click.prevent="destroyCoupon()"
                                    :disabled="coupon_destroy_button_disabled"><i class="material-icons">close</i> <b>Отменить</b>
                            </button>

                        </div>
                    </td>
                    <td colspan="6" style="vertical-align: top">
                        <h3 class="title mt-4">Итого:
                            <nobr>{{ order.billing_total.toFixed(decimals) }}&nbsp;<i class="fas fa-ruble-sign" style="font-size: 90%"></i></nobr>
                        </h3>
                        <h5 class="title mb-1 mt-3 text-muted">Доставка</h5>
                        <p class="text-muted">Бесплатная доставка по Москве(в пределах МКАД) при сумме заказа от 5000
                            руб. Доставка за МКАД по Московской области и по России рассчитывается индивидуально после
                            оформления заказа.</p>
                    </td>
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
                        <label for="name">Имя <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" id="name" v-model="order.user.name"
                               v-validate="'required'">
                        <small v-show="errors.has('name')" class="text-danger">{{ errors.first('name') }}</small>
                    </div>
                </div>
                <div class="col-12 col-md-5">
                    <div class="form-group" @click.prevent="setFocus('surname')">
                        <label for="surname">Фамилия <span class="text-danger">*</span></label>
                        <input type="text" name="surname" class="form-control" id="surname" v-model="order.user.surname"
                               v-validate="'required'">
                        <small v-show="errors.has('surname')" class="text-danger">{{ errors.first('surname') }}</small>
                    </div>
                </div>
            </div>

            <div class="row pb-3">
                <div class="col-12 col-md-5 offset-md-1">
                    <div class="form-group" @click.prevent="setFocus('phone')">
                        <label for="phone">Телефон <span class="text-danger">*</span></label>
                        <input id="phone" type="tel" name="phone" class="form-control" v-model="order.user.phone"
                               v-validate="'required'">
                        <small v-show="errors.has('phone')" class="text-danger">{{ errors.first('phone') }}</small>
                    </div>
                </div>
                <div class="col-12 col-md-5">
                    <div class="form-group" @click.prevent="setFocus('email')">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" id="email" v-model="order.user.email"
                               v-validate="'required|email'">
                        <small v-show="errors.has('email')" class="text-danger">{{ errors.first('email') }}</small>
                    </div>
                </div>
            </div>

        </div>
        <div class="px-4 pt-3 mx-auto">
            <h3 class="title pb-0">Адрес доставки</h3>
        </div>
        <div class="container px-5 pb-5">

            <div class="row pb-3">

                <div class="col-12 col-md-2 offset-md-1">
                    <div class="form-group" @click.prevent="setFocus('billing_index')">
                        <label for="billing_city">Индекс</label>
                        <input type="text" name="billing_index" class="form-control" id="billing_index" v-model="order.address.billing_index">
                        <small v-show="errors.has('billing_index')" class="text-danger">{{ errors.first('billing_index') }}</small>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="form-group" @click.prevent="setFocus('billing_city')">
                        <label for="billing_city">Город <span class="text-danger">*</span></label>
                        <input type="text"
                               name="billing_city"
                               class="form-control"
                               id="billing_city"
                               v-model="order.address.billing_city"
                               v-validate="'required'">
                        <small v-show="errors.has('billing_city')"
                               class="text-danger">
                            {{ errors.first('billing_city') }}
                        </small>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="form-group" @click.prevent="setFocus('billing_street')">
                        <label for="billing_street">Улица <span class="text-danger">*</span></label>
                        <input type="text"
                               name="billing_street"
                               class="form-control"
                               id="billing_street"
                               v-model="order.address.billing_street"
                               v-validate="'required'">
                        <small v-show="errors.has('billing_street')"
                               class="text-danger">{{ errors.first('billing_street') }}
                        </small>
                    </div>
                </div>
            </div>

            <div class="row pb-3">
                <div class="col-12 col-md-2 offset-md-1">
                    <div class="form-group" @click.prevent="setFocus('billing_house')">
                        <label for="billing_house">Дом <span class="text-danger">*</span></label>
                        <input type="text" name="billing_house" class="form-control" id="billing_house"
                               v-model="order.address.billing_house" v-validate="'required'">
                        <small v-show="errors.has('billing_house')" class="text-danger">{{ errors.first('billing_house')
                            }}
                        </small>
                    </div>
                </div>

                <div class="col-12 col-md-2">
                    <div class="form-group" @click.prevent="setFocus('billing_building')">
                        <label for="billing_apartment">Корпус/Строение</label>
                        <input
                                type="text"
                                name="billing_apartment"
                                class="form-control"
                                id="billing_building"
                                v-model="order.address.billing_building"
                        >
                        <small v-show="errors.has('billing_building')" class="text-danger">{{
                            errors.first('billing_building') }}
                        </small>
                    </div>
                </div>

                <div class="col-12 col-md-2">
                    <div class="form-group" @click.prevent="setFocus('billing_apartment')">
                        <label for="billing_apartment">Квартира/Офис <span class="text-danger">*</span></label>
                        <input type="text" name="billing_apartment" class="form-control" id="billing_apartment"
                               v-model="order.address.billing_apartment" v-validate="'required'">
                        <small v-show="errors.has('billing_apartment')" class="text-danger">{{
                            errors.first('billing_apartment') }}
                        </small>
                    </div>
                </div>

                <div class="col-12 col-md-2">
                    <div class="form-group" @click.prevent="setFocus('billing_entrance')">
                        <label for="billing_entrance">Подъезд</label>
                        <input type="text" class="form-control" id="billing_entrance"
                               aria-describedby="billing_entranceHelp" v-model="order.address.billing_entrance">
                        <small id="billing_entranceHelp" class="form-text text-muted"></small>
                    </div>
                </div>

                <div class="col-12 col-md-2">
                    <div class="form-group" @click.prevent="setFocus('billing_floor')">
                        <label for="billing_floor">Этаж</label>
                        <input type="text" class="form-control" id="billing_floor" aria-describedby="billing_floorHelp"
                               v-model="order.address.billing_floor">
                        <small id="billing_floorHelp" class="form-text text-muted"></small>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-12 col-md-10 offset-md-1">
                    <div class="form-group" @click.prevent="setFocus('billing_comment')">
                        <label for="billing_comment">Комментарий к заказу</label>
                        <textarea class="form-control" id="billing_comment" rows="5"
                                  v-model="order.address.billing_comment"></textarea>
                    </div>
                </div>
            </div>

        </div>
        <div class="px-4 pb-5 mx-auto">
            <button type="submit" class="btn btn-primary" @click.prevent="validateBeforeSubmit" :disabled="is_disabled">
                <i class="fas " :class="is_disabled ? ' fa-spinner fa-spin' : ' fa-check'"></i>&nbsp;&nbsp;<b>Отправить
                заказ</b>
                <div class="ripple-container"></div>
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['session_cart', 'session_cart_subtotal', 'session_coupon', 'auth_user', 'auth_user_addresses'],
        data() {
            return {
                is_disabled: false,
                decimals: 2,
                new_order_created: false,
                payload: {
                    rowId: '',
                    qty: ''
                },
                user_addresses: {},
                coupon_input_disabled: false,
                coupon_apply_button_disabled: false,
                coupon_destroy_button_disabled: true,

                order: {
                    _ga: null,
                    _ym: null,
                    _sbjs: null,

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
                        billing_index: '',
                        billing_city: '',
                        billing_street: '',
                        billing_house: '',
                        billing_apartment: '',
                        billing_building: '',
                        billing_entrance: '',
                        billing_floor: '',
                        billing_comment: '',
                    },
                    billing_total: 0,
                }
            }
        },
        computed: {
            show_checkout: function () {
                return this.order.cart.length === 0;
            }
        },
        methods: {
            setFocus(el) {
                document.getElementById(el).focus();
            },

            addItem(index, rowId, qty) {
                if (qty >= 10) {
                    return;
                }

                this.payload.rowId = rowId;
                this.payload.qty = qty;

                axios.post('/checkout/add', this.payload)
                    .then(response => {
                        this.refreshCart(Object.values(response.data.cart));
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
                    .then(response => {
                        this.refreshCart(Object.values(response.data.cart));
                        window.cartUpdate();
                    })
            },
            deleteItem(rowId) {
                axios.delete('/checkout/delete/' + rowId)
                    .then(response => {
                        this.refreshCart(Object.values(response.data.cart));
                        window.cartUpdate();
                    })
            },

            discountedPrice(price, discount, coupon) {
                return (price * ((100 - (discount + coupon)) / 100)).toFixed(2);
            },

            calcSubtotal(discounted_price, qty) {
                return (discounted_price * qty).toFixed(2);
            },
            calcTotal() {
                let that = this;
                this.order.billing_total = 0;
                this.order.cart.forEach(function (product, index) {
                    that.order.billing_total += Number(product.subtotal);
                });
            },

            destroyCoupon() {
                axios.get('/coupon/destroy', this.order.coupon)
                    .then(response => {
                        this.coupon_input_disabled = false;
                        this.order.coupon.valid = false;
                        this.order.coupon.discount = 0;
                        this.order.coupon.coupon = '';
                        this.coupon_apply_button_disabled = false;
                        this.coupon_destroy_button_disabled = true;

                        this.refreshCart(Object.values(response.data.cart));
                        window.cartUpdate();
                    })
            },
            validateCoupon() {
                axios.post('/coupon/validate', this.order.coupon)
                    .then(response => {
                        if (response.status === 202) {
                            this.order.coupon.error = response.data.message;
                            return;
                        }
                        this.order.coupon = response.data.coupon;
                        this.coupon_input_disabled = true;
                        this.order.coupon.valid = true;
                        this.order.coupon.success = 'Промокод применён';
                        this.coupon_apply_button_disabled = true;
                        this.coupon_destroy_button_disabled = false;

                        this.refreshCart(Object.values(response.data.cart));
                        window.cartUpdate();
                        window.flash('Промокод успешно применён!');
                    }).catch((e) => {
                    //
                })
            },

            validateBeforeSubmit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.storeOrder();
                    }
                });
            },
            storeOrder() {
                if (!this.is_disabled) {
                    this.is_disabled = true;
                    this.order._sbjs = window.sbjs.get.current

                    axios.post('/order/store', this.order)
                        .then(response => {
                            window.yaCounter35424225.reachGoal('new-order');
                            window.flash('Заказ получен!');
                            this.new_order_created = true;
                            window.cartUpdate();
                            this.is_disabled = false
                        })
                        .catch((error) => {
                            this.is_disabled = false
                        })
                }
            },

            refreshCart(products) {
                products.map((product, index) => {
                    product.discounted_price = Number(this.discountedPrice(product.price, product.options.discount, product.options.coupon));
                    product.subtotal = Number(this.calcSubtotal(product.discounted_price, product.qty));
                });
                this.order.cart = products;
                this.calcTotal();
            },

            setCart() {
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
                    this.coupon_apply_button_disabled = true;
                    this.coupon_destroy_button_disabled = false;
                }

                this.order.cart.map((product, index) => {
                    product.discounted_price = Number(this.discountedPrice(product.price, product.options.discount, product.options.coupon));
                    product.subtotal = Number(this.calcSubtotal(product.discounted_price, product.qty));
                });

                this.calcTotal();

                console.log(this.order.cart)
            }
        },
        mounted() {
            this.setCart();
            if (this.$cookie.get('_ga', {domain: '.doctorproffi.ru'})) {
                this.order._ga = this.$cookie.get('_ga', {domain: '.doctorproffi.ru'})
            }
            if (this.$cookie.get('_ym_uid', {domain: '.doctorproffi.ru'})) {
                this.order._ym = this.$cookie.get('_ym_uid', {domain: '.doctorproffi.ru'})
            }
        }
    }
</script>
