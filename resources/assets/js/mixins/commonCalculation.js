export const commonCalculation = {
    methods: {
        addItem(index, discounted_price, qty) {
            if (qty >= 10) {
                return;
            }
            this.order.cart[index].qty++;
            this.order.cart[index].subtotal = this.calcSubtotal(discounted_price, this.order.cart[index].qty)
            this.order.cart[index].total = this.calcOriginalTotal(this.order.cart[index].price, this.order.cart[index].qty)

            this.calcTotal();
        },
        removeItem(index, discounted_price, qty) {
            if (qty === 1) {
                return;
            }
            this.order.cart[index].qty--;
            this.order.cart[index].subtotal = this.calcSubtotal(discounted_price, this.order.cart[index].qty)
            this.order.cart[index].total = this.calcOriginalTotal(this.order.cart[index].price, this.order.cart[index].qty)

            this.calcTotal();
        },

        deleteItem(index) {
            this.order.cart.splice(index, 1);

            this.calcTotal();
        },

        discountedPrice(price, discount, coupon) {
            let couponDiscount = 0
            if (coupon && coupon > 0) {
                couponDiscount = coupon
            }
            return Number(price * ((100 - (discount + couponDiscount)) / 100))
        },

        calcOriginalTotal(price, qty) {
            return Number(price * qty).toFixed(2);
        },

        calcSubtotal(discounted_price, qty) {
            return Number(discounted_price * qty).toFixed(2)
        },

        calcTotal() {
            let that = this;
            this.order.billing_subtotal_raw = 0;
            this.order.billing_subtotal = 0;
            this.order.billing_diff = 0;

            this.order.cart.forEach(function (product) {
                that.order.billing_subtotal += Number(product.subtotal);
                that.order.billing_subtotal_raw += Number(product.total);
            });

            this.order.billing_subtotal_raw = Number(this.order.billing_subtotal_raw).toFixed(2);
            this.order.billing_subtotal = Number(this.order.billing_subtotal).toFixed(2);

            this.order.billing_diff = Number(this.order.billing_subtotal_raw) - Number(this.order.billing_subtotal);
            this.order.billing_diff = Number(this.order.billing_diff).toFixed(2);

            this.order.billing_total = Number(this.order.billing_subtotal) + Number(this.order.billing_delivery);
            this.order.billing_total = Number(this.order.billing_total).toFixed(2);
        },
    }
}