<template>
    <button
            class="btn btn-sm btn-info"
            @click.prevent="saveToBookmark"
           >
        <i class="material-icons">bookmark</i> <span class="font-weight-bold">В ИЗБРАННОЕ</span>
        <div class="ripple-container"></div>
    </button>
</template>

<script>
    export default {
        props: ['endpoint', 'model', 'price_to_show'],
        data() {
            return {
                payload: {
                    discounted_price: null
                },
            }
        },
        methods: {
            saveToBookmark() {
                axios.post(this.endpoint, this.payload)
                    .then( response => {
                        if (response.status === 202) {
                            window.flash('продукт уже в избранном!');
                        } else if (response.status === 200) {
                            window.flash('Сохранён в избранное!');
                        }
                    })
            }
        },
        mounted() {
            this.payload = this.model;
            this.payload.discounted_price = this.price_to_show;
        }
    }
</script>
