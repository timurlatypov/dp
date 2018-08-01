<template>
    <div class="card">

        <div class="px-4 py-3 mx-auto">
            <h3 class="title">Ваш заказ</h3>
        </div>

        <div class="table-responsive px-5">

            <table class="table table-shopping">

                <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;"></th>
                        <th>Товары</th>
                        <th class="th-description">Цена</th>
                        <th class="th-description">Количество</th>
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
                            <a href="#pablo">{{ product.name }}</a>
                            <br><small class="text-uppercase">{{ product.options.brand }}</small>
                        </td>

                        <td>{{ product.price }}</td>

                        <td class="td-actions">
                            <ul role="navigation" class="pagination my-0">
                                <li class="page-item">
                                    <button class="page-link" @click.prevent="removeItem(index)">-</button>
                                </li>
                                <li class="page-item active">
                                    <span class="page-link">{{ product.qty }}</span>
                                </li>
                                <li class="page-item">
                                    <button class="page-link" @click.prevent="addItem(index)">+</button>
                                </li>
                            </ul>
                        </td>

                        <td class="td-number">{{ product.subtotal }}</td>

                        <td class="td-actions text-center">
                            <button type="button" class="btn btn-simple" @click.prevent="deleteItem(index)">
                                <i class="material-icons">close</i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3" rowspan="4" style="vertical-align: top">

                            <div class="card p-2 mx-auto" style="width: 300px;">
                                <div class="card-body text-center">
                                    <h4 class="title my-1">Промокод</h4>
                                    <div class="form-group mx-auto" :class="order.coupon.valid ? ' has-success' : ''" style="width: 150px;">
                                        <input class="form-control font-weight-bold text-center" type="text" v-model="order.coupon.coupon" v-on:change="validateCoupon" :disabled="coupon_input_disabled" placeholder="Промокод">
                                        <small class="form-text text-danger" v-if="!order.coupon.valid">{{ order.coupon.error }}</small>
                                        <small class="form-text text-success" v-if="order.coupon.valid">{{ order.coupon.success }}</small>
                                    </div>
                                </div>

                            </div>

                        </td>
                        <td>Общая сумма</td>
                        <td>{{ order.billing_subtotal    }}</td>
                        <td></td>
                    </tr>

                    <tr>
                        <td>Промокод</td>
                        <td>{{ total }}</td>
                        <td></td>
                    </tr>

                    <tr>
                        <td>Доставка</td>
                        <td>{{ total }}</td>
                        <td></td>
                    </tr>

                    <tr>
                        <td>Итого</td>
                        <td>{{ total }}</td>
                        <td></td>
                    </tr>

                </tbody>
            </table>
        </div>


        <div class="px-4 py-3 mx-auto">
            <h3 class="title">Покупатель</h3>
        </div>

        <div class="container">
            <div class="row pb-3">
                <div class="col-12 col-md-5 offset-md-1">
                    <div class="form-group">
                        <label for="name">Имя</label>
                        <input type="text" class="form-control" id="name" aria-describedby="nameHelp" v-model="order.user.name">
                        <small id="nameHelp" class="form-text text-muted"></small>
                    </div>
                </div>
                <div class="col-12 col-md-5">
                    <div class="form-group">
                        <label for="surname">Фамилия</label>
                        <input type="text" class="form-control" id="surname" aria-describedby="surnameHelp" v-model="order.user.surname">
                        <small id="surnameHelp" class="form-text text-muted"></small>
                    </div>
                </div>
            </div>

            <div class="row pb-3">
                <div class="col-12 col-md-5 offset-md-1">
                    <div class="form-group">
                        <label for="phone">Телефон</label>
                        <input type="text" class="form-control" id="phone" aria-describedby="phoneHelp" v-model="order.user.phone">
                        <small id="phoneHelp" class="form-text text-muted"></small>
                    </div>
                </div>
                <div class="col-12 col-md-5">
                    <div class="form-group">
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

        <div class="px-4 pb-5 mx-auto" v-if="this.auth_user_addresses">
            <div class="dropdown show">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Мои адреса
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="#" v-for="address, index in user_addresses" @click.prevent="applySavedAddress(index)">{{ address.address_name }}</a>
                </div>
            </div>
        </div>

        <div class="container pb-5">

            <div class="row pb-3">
                <div class="col-12 col-md-5 offset-md-1">
                    <div class="form-group">
                        <label for="billing_city">Город</label>
                        <input type="text" class="form-control" id="billing_city" aria-describedby="billing_cityHelp" v-model="order.address.billing_city">
                        <small id="billing_cityHelp" class="form-text text-muted"></small>
                    </div>
                </div>
                <div class="col-12 col-md-5">
                    <div class="form-group">
                        <label for="billing_street">Улица</label>
                        <input type="text" class="form-control" id="billing_street" aria-describedby="billing_streetHelp" v-model="order.address.billing_street">
                        <small id="billing_streetHelp" class="form-text text-muted"></small>
                    </div>
                </div>
            </div>

            <div class="row pb-3">
                <div class="col-12 col-md-2 offset-md-1">
                    <div class="form-group">
                        <label for="billing_house">Дом</label>
                        <input type="text" class="form-control" id="billing_house" aria-describedby="billing_houseHelp" v-model="order.address.billing_house">
                        <small id="billing_houseHelp" class="form-text text-muted"></small>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="billing_apartment">Квартира</label>
                        <input type="text" class="form-control" id="billing_apartment" aria-describedby="billing_apartmentHelp" v-model="order.address.billing_apartment">
                        <small id="billing_apartmentHelp" class="form-text text-muted"></small>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="billing_entrance">Подъезд</label>
                        <input type="text" class="form-control" id="billing_entrance" aria-describedby="billing_entranceHelp" v-model="order.address.billing_entrance">
                        <small id="billing_entranceHelp" class="form-text text-muted"></small>
                    </div>
                </div>

                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <label for="billing_floor">Этаж</label>
                        <input type="text" class="form-control" id="billing_floor" aria-describedby="billing_floorHelp" v-model="order.address.billing_floor">
                        <small id="billing_floorHelp" class="form-text text-muted"></small>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-10 offset-md-1">
                    <div class="form-group">
                        <label for="billing_comment">Комментарий к заказу</label>
                        <textarea class="form-control" id="billing_comment" rows="auto" v-model="order.address.billing_comment"></textarea>
                    </div>
                </div>
            </div>

        </div>

        <div class="px-4 py-5 mx-auto">
            <button type="submit" class="btn btn-default" @click.prevent="storeOrder">
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
                total: '',
                success: false,
                payload: {
                    rowId: '',
                    qty: ''
                },
                user_addresses: {},

                coupon_input_disabled: false,

                order: {
                    cart: {},
                    coupon: {
                        coupon: '',
                        error: '',
                        valid: false
                    },
                    user: {},
                    address: {
                        billing_city: '',
                        billing_street: '',
                        billing_house: '',
                        billing_apartment: '',
                        billing_entrance: '',
                        billing_floor: '',
                        billing_comment: '',
                    },
                    billing_subtotal: '',
                    billing_total: ''
                }
            }
        },

        methods: {
            addItem(index) {
                if (this.order.cart[index].qty >= 5) {
                    return
                }

                this.payload.rowId = index;
                this.payload.qty = this.order.cart[index].qty;

                axios.post('/checkout/add', this.payload)
                    .then( response => {
                        this.order.cart = response.data.cart;
                        this.order.billing_subtotal = response.data.subtotal;
                    })

            },
            removeItem(index) {
                if (this.order.cart[index].qty === 1) {
                    return
                }

                this.payload.rowId = index;
                this.payload.qty = this.order.cart[index].qty;

                axios.post('/checkout/remove', this.payload)
                    .then( response => {
                        this.order.cart = response.data.cart;
                        this.order.billing_subtotal = response.data.subtotal;
                    })

            },
            deleteItem(index) {
                axios.delete('/checkout/delete/'+index)
                    .then( response => {
                        this.order.cart = response.data.cart;
                        this.order.billing_subtotal = response.data.subtotal;
                        window.cartUpdate();
                    })
            },
            validateCoupon() {
                axios.post('/coupon/validate', this.coupon)
                    .then( response => {

                        if( response.status === 202) {
                            this.order.coupon.error = response.data.message;
                            return;
                        }

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
                        console.log(response);
                    })
            }
        },
        mounted() {
            this.order.billing_subtotal = this.session_cart_subtotal;

            if (this.auth_user) {
                this.order.user = this.auth_user;
            }

            if (this.auth_user_addresses) {
                this.user_addresses = this.auth_user_addresses;
            }

            if (this.session_cart) {
                this.order.cart = this.session_cart;
                console.log(this.order.cart);
            }

            if (this.session_coupon) {
                this.order.coupon = this.session_coupon;
                this.coupon_input_disabled = true;
                this.order.coupon.valid = true;
                this.order.coupon.success = 'Промокод применён';
            }
        }
    }
</script>