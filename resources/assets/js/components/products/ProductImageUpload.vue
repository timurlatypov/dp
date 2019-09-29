<template>
    <div class="panel">
        <div class="text-center pb-3"><img :src="have_saved_image ? '/storage/products/' + slug + '/' + image_path : image" width="200" height="200" style="border: 1px solid lightgrey;"></div>
        <input type="file" accept="image/*" @change="onChange" class="form-control">
        <input type="text" :name="input_name" :value="image_path" hidden>
        <div><b>{{ description }}</b></div>
    </div>
</template>

<script>
    export default {
        props: [
            'saved_image_path',
            'handle_errors',
            'store_path',
            'input_name',
            'slug',
            'description',
            'endpoint'
        ],
        data() {
            return {
                image: '/storage/products/default.jpg',
                image_path: '',
                have_saved_image: false
            }
        },
        methods: {
            onChange(e) {
                if (! e.target.files.length) return;

                let image = e.target.files[0];

                let reader = new FileReader();

                reader.readAsDataURL(image);

                reader.onload = e => {
                    this.image = e.target.result;
                }

                this.persist(image);
            },
            persist(image) {
                let data = new FormData();

                data.append('image', image);
                data.append('path', this.store_path);

                axios.post(this.endpoint, data)
                    .then(response => {
                        console.log(response.data);
                        this.image_path = response.data.data;
                        if (this.saved_image) {
                            this.image_path = response.data.data;
                        }
                    });
            }
        },
        mounted(){
            console.log(this.handle_errors);
            console.log(this.saved_image_path);

            if(this.handle_errors && !this.saved_image_path) {
                this.image_path = this.handle_errors;
                this.have_saved_image = true;

            } else if (!this.handle_errors && this.saved_image_path) {
                this.image_path = this.saved_image_path;
                this.have_saved_image = true;
            } else if (this.handle_errors && this.saved_image_path) {
                if (this.handle_errors === this.saved_image_path) {
                    this.image_path = this.saved_image_path;
                    this.have_saved_image = true;
                } else {
                    this.image_path = this.handle_errors;
                    this.have_saved_image = true;
                }

            } else {
                this.have_saved_image = false;
            }
        }
    }
</script>