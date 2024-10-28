import Vue from "vue";

window.Vue = require('vue').default;

import Alpine from 'alpinejs'

import VueYandexMetrika from 'vue-yandex-metrika';

let VueCookie = require('vue-cookie');
Vue.use(VueCookie);

import ru from 'vee-validate/dist/locale/ru';
import VeeValidate, { Validator } from 'vee-validate';
VeeValidate.Validator.localize('ru', ru);

const dictionary = {
    ru: {
        attributes: {
            name: 'Имя',
            surname: 'Фамилия',
            phone: 'Телефон',
            email: 'Email',

            billing_city: 'Город',
            billing_street: 'Улица',
            billing_house: 'Дом',
            billing_apartment: 'Квартира/Офис',
        }
    }
};
Validator.localize(dictionary);

Vue.use(VeeValidate, {
    events: 'change'
});

import VueRecaptcha from 'vue-recaptcha';
Vue.use(VueRecaptcha);

require('./bootstrap');
require('./scripts');
require('moment');

require('./material-kit');
require('./plugins/nouislider.min');
require('./core/bootstrap-material-design.min');
require('./plugins/bootstrap-datetimepicker');


Vue.component('flash', require('./components/Flash.vue').default);
Vue.component('search', require('./components/Search.vue').default);
Vue.component('search-mobile', require('./components/SearchMobile.vue').default);
Vue.component('cart', require('./components/cart/Cart.vue').default);
Vue.component('cart-mobile', require('./components/cart/CartMobile.vue').default);
Vue.component('cart-modal', require('./components/cart/CartModal.vue').default);
Vue.component('add-button', require('./components/cart/AddButton.vue').default);
Vue.component('add-favorite', require('./components/favorite/AddFavorite.vue').default);
Vue.component('save-bookmark', require('./components/bookmark/SaveBookmark.vue').default);
Vue.component('save-bookmark-button', require('./components/bookmark/SaveBookmarkButton.vue').default);
Vue.component('editor', require('./components/Editor.vue').default);
Vue.component('toggle-switch', require('./components/ToggleSwitch.vue').default);
Vue.component('input-field', require('./components/InputField.vue').default);
Vue.component('product-image-upload', require('./components/products/ProductImageUpload.vue').default);
Vue.component('select-brand-line', require('./components/products/SelectBrandLine.vue').default);
Vue.component('order-checkout-form', require('./components/checkout/OrderCheckoutForm.vue').default);
Vue.component('order-subcategories', require('./components/OrderSubcategories.vue').default);
Vue.component('carousel-editor', require('./components/carousel/CarouselEditor.vue').default);
Vue.component('carousel-creator', require('./components/carousel/CarouselCreator.vue').default);
Vue.component('coupon-creator', require('./components/coupon/CouponCreator.vue').default);
Vue.component('associate-products', require('./components/categories/AssociateProduct.vue').default);

Vue.component('register', require('./components/Register').default);
Vue.component('callback', require('./components/Callback.vue').default);

Vue.component('order-edit-form', require('./components/admin-panel/order/OrderEditForm.vue').default);
Vue.component('order-create-form', require('./components/admin-panel/order/OrderCreateForm.vue').default);

Vue.component('TypeAhead', require('./components/delivery/TypeAhead').default);
Vue.component('delivery-calculator', require('./components/delivery/Calculator.vue').default);
Vue.component('mobile-menu', require('./components/MobileMenu.vue').default);

Vue.use(VueYandexMetrika, {
    id: 35424225,
})

const app = new Vue({
    el: '#app',
});
