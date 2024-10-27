<template>
    <button 
        type="submit" 
        :class="[
            'tw-inline-flex tw-items-center tw-justify-center tw-gap-1.5 tw-px-2.5 tw-py-1.5 tw-text-xs tw-font-bold tw-rounded-md tw-whitespace-nowrap',
            disabled 
                ? 'tw-bg-gray-100 tw-text-gray-500 tw-cursor-not-allowed' 
                : 'tw-bg-[#FF6B00] hover:tw-bg-[#FF5500] tw-text-white'
        ]"
        @click.prevent="saveToCart" 
        :disabled="disabled"
    >
        <i 
            :class="[
                'fas',
                disabled ? 'fa-thumbs-up' : 'fa-shopping-cart',
                'tw-text-xs tw-inline-block'
            ]"
        ></i>
        <span class="tw-inline-block">{{ disabled ? 'В корзине' : 'В корзину'}}</span>
    </button>
</template>

<script>
export default {
    props: {
        endpoint: { type: String, required: true },
        model: { type: Object, required: true },
        price_to_show: { type: [String, Number], required: true },
    },
    data() {
        return {
            payload: {
                priceToShow: ''
            },
            disabled: false,
        }
    },
    methods: {
        saveToCart() {
            axios.post(this.endpoint, this.payload)
                .then(response => {
                    window.cartUpdate();
                    window.cartModal(this.payload);
                    this.disabled = true;
                })
        }
    },
    mounted() {
        this.payload = this.model;
        this.payload.priceToShow = this.price_to_show;
    }
}
</script>

