<template>
    <div>
        <div class="form-group pb-3">
            <label for="brand_id"><b>Бренд</b><span class="text-danger"> *</span></label>
            <select class="custom-select" name="brand_id" id="brand_id" v-model="selected_brand" v-on:change="checkBrandLines" aria-describedby="brandHelp">
                <option :value="null">Выбрать бренд</option>
                <option v-for="brand in brands" :value="brand.id">{{ brand.name }}</option>
            </select>
            <small id="brandHelp" class="form-text text-danger">{{ error }}</small>
        </div>

        <div class="form-group pb-3">
            <label for="line_id"><b>Линия</b></label>
            <select class="custom-select" name="line_id" id="line_id" v-model="selected_line">
                <option :value="null">Выбрать линию</option>
                <option v-for="line in lines" :value="line.id">{{ line.name }}</option>
            </select>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['brands_prop', 'error', 'selected_brand_prop', 'selected_line_prop', 'lines_endpoint'],
        data () {
            return {
                brands: null,
                lines: null,
                selected_brand: null,
                selected_line: null,
                payload: {
                    id: null
                }
            }
        },
        methods: {
            onChange() {
                console.log('changed');
            },
            checkBrandLines() {
                this.payload.id = this.selected_brand;
                axios.post(this.lines_endpoint, this.payload)
                    .then(response => {
                        this.lines = response.data.data;
                    })
            }
        },
        mounted() {
            this.brands = this.brands_prop;
            this.selected_brand = this.selected_brand_prop;
            this.selected_line = this.selected_line_prop;

            if (this.selected_line) {
                this.checkBrandLines();
            }
        }
    }
</script>