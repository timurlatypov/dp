<template>
    <div class="tw-relative tw-inline-block">
        <!-- Cart Icon Button -->
        <button 
            @click="handleClick"
            class="tw-flex tw-items-center tw-text-gray-700 hover:tw-text-gray-900 tw-px-2 tw-py-1.5 tw-rounded-md tw-text-sm tw-font-medium tw-whitespace-nowrap"
        >
            <i class="material-icons tw-text-lg">shopping_cart</i>
            <span 
                v-if="count" 
                class="tw-absolute tw-top-0 tw-right-0 tw-inline-flex tw-items-center tw-justify-center tw-px-1.5 tw-py-0.5 tw-text-xs tw-font-bold tw-leading-none tw-text-white tw-bg-red-500 tw-rounded-full"
            >
                {{ count }}
            </span>
        </button>

        <!-- Dropdown Menu - Only show if dropdownEnabled -->
        <div 
            v-if="dropdownEnabled && isOpen"
            class="tw-absolute tw-right-0 tw-mt-2 tw-w-72 tw-bg-white tw-rounded-md tw-shadow-lg tw-ring-1 tw-ring-black tw-ring-opacity-5 tw-z-50"
        >
            <!-- Empty Cart -->
            <div v-if="!count" class="tw-px-4 tw-py-3 tw-text-sm tw-text-gray-700">
                В корзине пусто
            </div>

            <!-- Cart with Items -->
            <div v-else class="tw-p-4">
                <!-- Cart Header -->
                <p class="tw-text-sm tw-text-gray-700 tw-mb-3 tw-whitespace-nowrap">
                    Всего наименований: {{ count }}
                </p>

                <!-- Cart Items -->
                <div class="tw-space-y-3 tw-mb-4">
                    <div 
                        v-for="item in items" 
                        class="tw-flex tw-items-center tw-space-x-3 tw-py-2 tw-border-b tw-border-gray-100 tw-last:border-0"
                    >
                        <img 
                            :src="'/storage/'+item.options['image']" 
                            class="tw-w-10 tw-h-10 tw-object-cover tw-rounded"
                            alt=""
                        >
                        <div class="tw-flex-1 tw-min-w-0">
                            <p class="tw-text-sm tw-font-medium tw-text-gray-900 tw-truncate">
                                {{ item.name }}
                            </p>
                            <div class="tw-flex tw-justify-between tw-text-sm tw-text-gray-500">
                                <span>{{ item.qty }} ед.</span>
                                <span>{{ item.price }} ₽</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Checkout Button -->
                <div class="tw-text-right">
                    <a 
                        href="/checkout" 
                        class="tw-inline-flex tw-items-center tw-px-2.5 tw-py-1.5 tw-text-xs tw-font-medium tw-text-white hover:tw-text-white tw-bg-orange-500 tw-rounded-md"
                    >
                        Оформить заказ
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        cart_items: {
            type: [Object, String],
            required: true
        },
        cart_count: {
            type: [String, Number],
            required: true
        },
        dropdownEnabled: {
            type: Boolean,
            default: true
        }
    },
    data() {
        return {
            items: '',
            count: '',
            isOpen: false
        }
    },
    created() {
        window.events.$on('cartUpdate', () => {
            this.cartUpdate();
        });
        // Close dropdown when clicking outside
        document.addEventListener('click', this.handleClickOutside);
    },
    destroyed() {
        document.removeEventListener('click', this.handleClickOutside);
    },
    methods: {
        handleClick() {
            if (this.dropdownEnabled) {
                this.isOpen = !this.isOpen;
            } else {
                window.location.href = '/checkout';
            }
        },
        cartUpdate() {
            axios.get('/cart/refresh')
                .then(response => {
                    this.items = response.data.cart_items;
                    this.count = response.data.cart_count;
                })
        },
        handleClickOutside(event) {
            if (!this.$el.contains(event.target)) {
                this.isOpen = false;
            }
        }
    },
    mounted() {
        window.sbjs.init();
        this.items = this.cart_items;
        this.count = this.cart_count;
    }
}
</script>
