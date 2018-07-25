<template>
    <div class="input-group" :class="success ? ' has-success' : ''" style="max-width: 70px;">
        <div class="input-group-prepend">
          <span class="input-group-text pl-0 pr-1">
              <i :class="[fontawesome, success ? ' text-success' : '']"></i>
          </span>
        </div>
        <input class="form-control font-weight-bold" type="text" v-model="payload.value" v-on:change="onChange" :disabled="disabled" :placeholder="placeholder">
    </div>
</template>

<script>
    export default {
        props: ['value', 'endpoint', 'product_id', 'fontawesome', 'placeholder'],
        data () {
            return {
                disabled: false,
                success: false,
                payload: {
                    id: null,
                    value: '',
                }
            }
        },
        methods: {
            onChange() {
                this.disabled = true;
                axios.post(this.endpoint, this.payload)
                    .then(response => {
                        this.disabled = false;
                        this.success = true;
                        setTimeout( () => {
                            this.success = false;
                        }, 2000);
                    })
            }
        },
        mounted() {
            this.payload.id = this.product_id;
            if (this.value ? this.payload.value = this.value : this.payload.value = '');
        }
    }
</script>