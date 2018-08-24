
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window.Vue = require('vue');

// import ru from 'vee-validate/dist/locale/ru';
// import VeeValidate, { Validator } from 'vee-validate';
// VeeValidate.Validator.localize('ru', ru);
// Vue.use(VeeValidate);

require('./bootstrap');
require('./scripts');
require('moment');

require('./material-kit');
require('./plugins/nouislider.min');
require('./core/bootstrap-material-design.min');
require('./plugins/bootstrap-datetimepicker');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('flash', require('./components/Flash.vue'));
Vue.component('search', require('./components/Search.vue'));
Vue.component('search-mobile', require('./components/SearchMobile.vue'));
Vue.component('cart', require('./components/cart/Cart.vue'));
Vue.component('cart-mobile', require('./components/cart/CartMobile.vue'));
Vue.component('cart-modal', require('./components/cart/CartModal.vue'));
Vue.component('add-button', require('./components/cart/AddButton.vue'));
Vue.component('add-favorite', require('./components/favorite/AddFavorite.vue'));
Vue.component('editor', require('./components/Editor.vue'));
Vue.component('toggle-switch', require('./components/ToggleSwitch.vue'));
Vue.component('input-field', require('./components/InputField.vue'));
Vue.component('product-image-upload', require('./components/products/ProductImageUpload.vue'));
Vue.component('select-brand-line', require('./components/products/SelectBrandLine.vue'));
Vue.component('order-checkout-form', require('./components/checkout/OrderCheckoutForm.vue'));
Vue.component('order-subcategories', require('./components/OrderSubcategories.vue'));

Vue.component('associate-products', require('./components/categories/AssociateProduct.vue'));



const app = new Vue({
    el: '#app'
});


// let Inputmask = require('inputmask');
// if (document.getElementById("phone")) {
//     var phone = document.getElementById("phone");
//     var im = new Inputmask("9 (999) 999-99-99");
//     im.mask(phone);
// }