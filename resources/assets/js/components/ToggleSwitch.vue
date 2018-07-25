<template>
    <div class="togglebutton">
        <label>
            <input type="checkbox" v-model="payload.checked" v-on:change="onChange" :disabled="disabled">
            <span class="toggle"></span>

        </label>
    </div>
</template>

<script>
    export default {
        props: ['toggle', 'endpoint', 'product_id'],
        data () {
            return {
                disabled: false,
                payload: {
                    id: null,
                    checked: false,
                }
            }
        },
        methods: {
            onChange() {
                this.disabled = true;
                console.log(this.payload.checked);

                axios.post(this.endpoint, this.payload)
                    .then(response => {
                        console.log(response.data.data);
                        this.disabled = false;
                    })
            }
        },
        mounted() {
            this.payload.id = this.product_id;
            if (this.toggle === '1' ? this.payload.checked = true : this.payload.checked = false);
        }
    }
</script>