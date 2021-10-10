<template>
  <div>
    <h4 class="title mt-2 mb-2 text-muted">Клиент</h4>

    <div class="container-fluid px-0 pb-3">
      <div class="row">
        <div class="col-12 col-xs-6 col-md-8 px-0">
          <div class="container-fluid">
            <div class="row pb-1">
              <div class="col-12 col-md-6">
                <div class="form-group" @click.prevent="setFocus('name')">
                  <label for="name">Имя <span class="text-danger">*</span></label>
                  <input type="text" name="name" class="form-control" id="name" v-model="order.user.name"
                         v-validate="'required'">
                  <small v-show="errors.has('name')" class="text-danger">{{ errors.first('name') }}</small>
                </div>
              </div>

              <div class="col-12 col-md-6">
                <div class="form-group" @click.prevent="setFocus('surname')">
                  <label for="surname">Фамилия <span class="text-danger">*</span></label>
                  <input type="text" name="surname" class="form-control" id="surname" v-model="order.user.surname"
                         v-validate="'required'">
                  <small v-show="errors.has('surname')" class="text-danger">{{ errors.first('surname') }}</small>
                </div>
              </div>
            </div>
            <div class="row pb-1">
              <div class="col-12 col-md-6">
                <div class="form-group" @click.prevent="setFocus('phone')">
                  <label for="phone">Телефон <span class="text-danger">*</span></label>
                  <input id="phone" type="tel" name="phone" class="form-control" v-model="order.user.phone"
                         v-validate="'required'">
                  <small v-show="errors.has('phone')" class="text-danger">{{ errors.first('phone') }}</small>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="form-group" @click.prevent="setFocus('email')">
                  <label for="email">Email <span class="text-danger">*</span></label>
                  <input type="email" name="email" class="form-control" id="email" v-model="order.user.email"
                         v-validate="'required|email'">
                  <small v-show="errors.has('email')" class="text-danger">{{ errors.first('email') }}</small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <h4 class="title mt-2 pb-2 mb-2 text-muted">Адрес доставки</h4>

    <div class="container-fluid px-0 pb-3">
      <div class="row">
        <div class="col-12 col-xs-6 col-md-8 px-0">

          <div class="container-fluid">
            <div class="row pb-1">

              <div class="col-12 col-md-2">
                <div class="form-group" @click.prevent="setFocus('billing_index')">
                  <label for="billing_index">Индекс</label>
                  <input type="text" name="billing_index" class="form-control" id="billing_index"
                         v-model="order.address.billing_index">
                  <small v-show="errors.has('billing_index')" class="text-danger">{{
                      errors.first('billing_index')
                    }}</small>
                </div>
              </div>
              <div class="col-12 col-md-5">
                <div class="form-group" @click.prevent="setFocus('billing_city')">
                  <label for="billing_city">Город <span class="text-danger">*</span></label>
                  <input type="text" name="billing_city" class="form-control" id="billing_city"
                         v-model="order.address.billing_city" v-validate="'required'">
                  <small v-show="errors.has('billing_city')" class="text-danger">{{
                      errors.first('billing_city')
                    }}</small>
                </div>
              </div>
              <div class="col-12 col-md-5">
                <div class="form-group" @click.prevent="setFocus('billing_street')">
                  <label for="billing_street">Улица <span class="text-danger">*</span></label>
                  <input type="text" name="billing_street" class="form-control" id="billing_street"
                         v-model="order.address.billing_street" v-validate="'required'">
                  <small v-show="errors.has('billing_street')" class="text-danger">{{
                      errors.first('billing_street')
                    }}</small>
                </div>
              </div>

            </div>

            <div class="row pb-1">
              <div class="col-12 col-md-2">
                <div class="form-group" @click.prevent="setFocus('billing_house')">
                  <label for="billing_house">Дом <span class="text-danger">*</span></label>
                  <input type="text" name="billing_house" class="form-control" id="billing_house"
                         v-model="order.address.billing_house" v-validate="'required'">
                  <small v-show="errors.has('billing_house')" class="text-danger">{{
                      errors.first('billing_house')
                    }}</small>
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
                      errors.first('billing_building')
                    }}</small>
                </div>
              </div>

              <div class="col-12 col-md-2">
                <div class="form-group" @click.prevent="setFocus('billing_apartment')">
                  <label for="billing_apartment">Кв / Офис <span class="text-danger">*</span></label>
                  <input type="text" name="billing_apartment" class="form-control" id="billing_apartment"
                         v-model="order.address.billing_apartment" v-validate="'required'">
                  <small v-show="errors.has('billing_apartment')"
                         class="text-danger">{{ errors.first('billing_apartment') }}</small>
                </div>
              </div>

              <div class="col-12 col-md-2">
                <div class="form-group" @click.prevent="setFocus('billing_entrance')">
                  <label for="billing_entrance">Подъезд</label>
                  <input type="text" class="form-control" id="billing_entrance" aria-describedby="billing_entranceHelp"
                         v-model="order.address.billing_entrance">
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
              <div class="col-12">
                <div class="form-group" @click.prevent="setFocus('billing_comment')">
                  <label for="billing_comment">Комментарий к заказу</label>
                  <textarea class="form-control" id="billing_comment" rows="2"
                            v-model="order.address.billing_comment"></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <h4 class="title my-0 text-muted">Содержимое заказа</h4>
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
          <th class="th-description text-center">Скидка</th>
          <th class="th-description text-center">Промокод</th>
          <th>
            <nobr>Цена со скидкой</nobr>
          </th>
          <th>Кол-во</th>
          <th class="">Сумма</th>
          <th class="text-center" style="width: 60px;">Удалить</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(product, index) in order.cart">
          <td>
            <div class="img-container"><img :src="'/storage/'+product.options.image"></div>
          </td>
          <td class="td-name">
            <span class="font-weight-bold" href="#">{{ product.name }}</span>
            <br><small>{{ product.options.title_rus }}</small>
            <br><small class="text-uppercase">{{ product.options.brand }}</small>
          </td>

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
                  v-model="order.cart[index].options.discount"
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
                  v-model="order.cart[index].options.coupon"
                  type="number"
                  min="0"
                  oninput="validity.valid||(value='');">
            </div>
          </td>

          <td class="td-actions font-weight-bold">
            <button type="button" class="btn btn-danger btn-simple mr-2" @click.prevent="refreshDiscountedPrice(index)">
              <i class="material-icons">refresh</i>
            </button>
            {{ product.discounted_price | formatDecimals }}&nbsp;&#x20BD;
          </td>

          <td class="td-actions text-center">
            <ul role="navigation" class="pagination my-auto mx-auto">
              <li class="page-item">
                <button class="page-link" @click.prevent="removeItem(index, product.discounted_price, product.qty)">-
                </button>
              </li>
              <li class="page-item active">
                <span class="page-link"><strong>{{ product.qty }}</strong></span>
              </li>
              <li class="page-item">
                <button class="page-link" @click.prevent="addItem(index, product.discounted_price, product.qty)">+
                </button>
              </li>
            </ul>
          </td>

          <td class="td-number font-weight-bold">{{ product.subtotal | formatDecimals }}&nbsp;&#x20BD;</td>

          <td class="td-actions text-center">
            <button type="button" class="btn btn-simple" @click.prevent="deleteItem(index)">
              <i class="material-icons">close</i>
            </button>
          </td>
        </tr>
        <tr>
          <td colspan="8" class="td-number font-weight-bold" style="vertical-align: top">
            <div class="container px-0"></div>
            <div class="row mx-0">
              <div class="col-12 col-sm-4">
                <h4 class="title mt-4 mb-0">Сумма без скидок:</h4>

                <div class="input-group" style="max-width: 120px;">
                  <div class="input-group-prepend">
                                          <span class="input-group-text pl-0 pr-1">
                                              <i class="fa fa-ruble-sign fa-sm"></i>
                                          </span>
                  </div>
                  <input
                      style="padding-left: 6px;"
                      class="form-control font-weight-bold"
                      :value="order.billing_subtotal_raw"
                      type="number"
                      min="0"
                      readonly>
                </div>
              </div>
              <div class="col-12 col-sm-4">
                <h4 class="title mt-4 mb-0">Размер скидки:</h4>

                <div class="input-group" style="max-width: 120px;">
                  <div class="input-group-prepend">
                                          <span class="input-group-text pl-0 pr-1">
                                              <i class="fa fa-ruble-sign fa-sm"></i>
                                          </span>
                  </div>
                  <input
                      style="padding-left: 6px;"
                      class="form-control font-weight-bold"
                      :value="order.billing_diff"
                      type="number"
                      min="0"
                      readonly>
                </div>
              </div>
              <div class="col-12 col-sm-4">
                <h4 class="title mt-4 mb-0">Сумма со скидкой:</h4>

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
    </div>
    <div class="text-right">
      <a href="#" class="btn btn-success font-weight-bold" @click.prevent="createOrder">Создать заказ</a>
    </div>
  </div>
</template>

<script>
import {productautocomplete} from "../../../helpers/autocomplete"
import {priceFilters} from '../../../filters/priceFilters'
import {commonCalculation} from "../../../mixins/commonCalculation";

export default {
  mixins: [
      priceFilters,
      commonCalculation
  ],
  data() {
    return {
      decimals: 2,

      order: {
        user: {
          name: null,
          surname: null,
          phone: null,
          email: null
        },
        cart: [],
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
        billing_subtotal_raw: 0,
        billing_subtotal: 0,
        billing_diff: 0,
        billing_delivery: 0,
        billing_total: 0,
      }
    }
  },
  methods: {
    setFocus(el) {
      document.getElementById(el).focus();
    },

    refreshDiscountedPrice(index) {
      this.order.cart[index].discounted_price = Number(this.discountedPrice(Number(this.order.cart[index].price), Number(this.order.cart[index].options.discount), Number(this.order.cart[index].options.coupon)))
      this.order.cart[index].subtotal = Number(this.calcSubtotal(Number(this.order.cart[index].discounted_price), Number(this.order.cart[index].qty)));
      this.order.cart[index].total = Number(this.calcOriginalTotal(Number(this.order.cart[index].price), Number(this.order.cart[index].qty)));

      this.calcTotal();
    },

    setCart() {
      this.calcTotal();
    },

    add(selection) {
      let discounted_price = this.discountedPrice(selection.price, selection.discount)
      let total = this.calcOriginalTotal(selection.price, 1)
      let subtotal = this.calcSubtotal(discounted_price, 1)

      let item = {
        id: selection.id,
        name: selection.title_eng,
        qty: 1,
        price: selection.price,
        options: {
          title_rus: selection.title_rus,
          discount: selection.discount,
          coupon: 0,
          product_slug: selection.slug,
          brand: selection.brand.name,
          brand_id: selection.brand.id,
          brand_slug: selection.brand.slug,
          image: selection.thumb_path
        },
        tax: null,
        total: total,
        subtotal: subtotal,
        biggest_discount: selection.discount,
        discounted_price: discounted_price
      }

      this.order.cart.push(item);
      this.calcTotal()
    },

    async createOrder() {
      let payload = {
        user_id: null,
        user: this.order.user,
        address: this.order.address,
        details: JSON.stringify(this.order.cart),
        billing_total: this.order.billing_total,
        billing_delivery: this.order.billing_delivery,
        billing_subtotal: this.order.billing_subtotal,
      }
      await axios.post('/admin-panel/orders/store', payload)
          .then((response) => {
            console.log(response)
            window.location = `/admin-panel/orders`;
          })
          .catch((error) => {
            //
          })
    }
  },
  mounted() {
    productautocomplete('#selection', {
      hitsPerPage: 10
    })
        .on('autocomplete:selected', (e, selection) => {
          this.add(selection);
        })

    this.setCart();
  }
}
</script>
