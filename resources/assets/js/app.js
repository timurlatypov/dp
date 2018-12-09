window.Vue = require('vue');

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

Vue.use(VeeValidate);




import VueRecaptcha from 'vue-recaptcha';
Vue.use(VueRecaptcha);

require('./bootstrap');
require('./scripts');
require('moment');

require('./material-kit');
require('./plugins/nouislider.min');
require('./core/bootstrap-material-design.min');
require('./plugins/bootstrap-datetimepicker');


Vue.component('flash', require('./components/Flash.vue'));
Vue.component('search', require('./components/Search.vue'));
Vue.component('search-mobile', require('./components/SearchMobile.vue'));
Vue.component('cart', require('./components/cart/Cart.vue'));
Vue.component('cart-mobile', require('./components/cart/CartMobile.vue'));
Vue.component('cart-modal', require('./components/cart/CartModal.vue'));
Vue.component('add-button', require('./components/cart/AddButton.vue'));
Vue.component('add-favorite', require('./components/favorite/AddFavorite.vue'));
Vue.component('save-bookmark', require('./components/bookmark/SaveBookmark.vue'));
Vue.component('save-bookmark-button', require('./components/bookmark/SaveBookmarkButton.vue'));
Vue.component('editor', require('./components/Editor.vue'));
Vue.component('toggle-switch', require('./components/ToggleSwitch.vue'));
Vue.component('input-field', require('./components/InputField.vue'));
Vue.component('product-image-upload', require('./components/products/ProductImageUpload.vue'));
Vue.component('select-brand-line', require('./components/products/SelectBrandLine.vue'));
Vue.component('order-checkout-form', require('./components/checkout/OrderCheckoutForm.vue'));
Vue.component('order-subcategories', require('./components/OrderSubcategories.vue'));

Vue.component('carousel-editor', require('./components/carousel/CarouselEditor.vue'));
Vue.component('carousel-creator', require('./components/carousel/CarouselCreator.vue'));

Vue.component('coupon-creator', require('./components/coupon/CouponCreator.vue'));

Vue.component('associate-products', require('./components/categories/AssociateProduct.vue'));
Vue.component('callback', require('./components/Callback.vue'));


Vue.component('order-edit-form', require('./components/admin-panel/order/OrderEditForm.vue'));

// Vue.component('compact-picker', require('vue-color').default);
//


const app = new Vue({
    el: '#app',
});