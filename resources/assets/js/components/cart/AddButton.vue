<template>
    <button type="submit" class="btn btn-default btn-sm" @click.prevent="saveToCart" :disabled="disabled">
        <i class="material-icons pb-1" v-html="disabled ? 'thumb_up' : 'shopping_cart'"></i> {{ disabled ? 'В корзине' : 'В корзину'}}
        <div class="ripple-container"></div>
    </button>
</template>

<script>
    export default {
        props: ['endpoint', 'id', 'name', 'price', 'cart'],
        data() {
            return {
                data: {
                    id: '',
                    name: '',
                    quantity: 1,
                    price: ''
                },
                disabled: false,
            }
        },
        methods: {
            saveToCart() {
                window.flash('true');
                axios.post(this.endpoint, this.data)
                    .then( response => {
                        window.flash('added');
//                        console.log(response.data);
                        this.disabled = true;
                    } )
                console.log(this.cart);

                let jsonCart = JSON.stringify(this.cart);

                console.log(jsonCart);

                let objectCart = JSON.parse(jsonCart);

                console.log(objectCart);
            }
        },
        mounted() {
            this.data.id = this.id;
            this.data.name = this.name;
            this.data.price = this.price;
        }
    }
</script>
