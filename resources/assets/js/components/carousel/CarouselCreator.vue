<template>
    <div>

        <h4 class="title">Live preview</h4>
        <div class="d-flex my-2 p-2 rounded"
             style="border: 1px solid lightgrey; height: 300px; background-position: center center; background-size: contain; background-repeat: no-repeat;"
             :style="'background-color: #' + banner.hex + '; background-image: url(\'/storage/carousel/'+ banner.image_path +'\');'">
            <div class="p-2 w-100 align-self-center">
                <h4 class="title my-1" :style="'color: #' + banner.title_hex + ';'" v-html="banner.title"></h4>
                <p :style="'color: #' + banner.body_hex + ';'" v-html="banner.body"></p>
                <h6>{{banner.brand}}</h6>
                <button class="btn btn-info btn-sm" v-if="banner.button">{{ banner.button }}</button>
            </div>
        </div>

        <div class="card w-75 mx-auto p-5">
            <h4 class="title my-0">Banner parameters</h4>


            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label for="title" class="col-form-label">TITLE</label>
                        <input id="title" type="text" class="form-control" name="title" v-model="banner.title">
                    </div>
                    <div class="col">
                        <label for="title_hex" class="col-form-label">TITLE HEX</label>
                        <input id="title_hex" type="text" class="form-control" name="title_hex" v-model="banner.title_hex" maxlength="6">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label for="body" class="col-form-label">BODY</label>
                        <input id="body" type="text" class="form-control" name="body" v-model="banner.body">
                    </div>
                    <div class="col">
                        <label for="body_hex" class="col-form-label">BODY HEX</label>
                        <input id="body_hex" type="text" class="form-control" name="body_hex" v-model="banner.body_hex" maxlength="6">
                    </div>
                </div>
            </div>


            <div class="panel py-2">
                <div class="row">
                    <div class="col">
                        <label for="image_path" class="col-form-label">BACKGROUND IMAGE</label>
                        <input type="file" id="image_path" accept="image/*" @change="onChange" class="form-control">
                        <input type="text" name="image_path" :value="banner.image_path" hidden>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="color" class="col-form-label py-1">BACKGROUND HEX</label>
                            <input id="color" type="text" class="form-control" name="color" v-model="banner.hex" maxlength="6">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label for="button" class="col-form-label">BUTTON TITLE</label>
                        <input id="button" type="text" class="form-control" name="brand" v-model="banner.button">
                    </div>
                    <div class="col">
                        <label for="link" class="col-form-label">BUTTON LINK</label>
                        <input id="link" type="text" class="form-control" name="link" v-model="banner.link">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="brand" class="col-form-label">BRAND</label>
                <input id="brand" type="text" class="form-control" name="brand" v-model="banner.brand">
            </div>

            <div class="form-group">
                <label for="expired_at" class="col-form-label">EXPIRED AT</label>
                <input id="expired_at" type="date" class="form-control" name="expired_at" v-model="banner.expired_at">
            </div>

            <button class="btn btn-info btn-sm" @click.prevent="store()">Сохранить</button>

        </div>

        <!--<chrome-picker v-model="banner.color" />-->
    </div>
</template>

<script>
    // import { Chrome } from 'vue-color';

    export default {
        props: ['store_path', 'store_banner_endpoint', 'store_image_endpoint'],
        // components: {
        //     'chrome-picker': Chrome,
        // },
        data() {
            return {
                banner: {
                    hex: null,
                    // color: {},
                    image_path: 'default.jpg',
                    order_id: null,
                    link: null,
                    title: null,
                    title_hex: null,
                    body: null,
                    body_hex: null,
                    brand: null,
                    button: null,
                    live: false,
                    expired_at: null
                }
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

                axios.post(this.store_image_endpoint, data)
                    .then(response => {
                        console.log(response.data);
                        this.banner.image_path = response.data.data;
                    });
            },
            store() {
                axios.post(this.store_banner_endpoint, this.banner)
                    .then(response => {
                        console.log(response.data);
                        window.flash('Сохранен');
                    });
            }
        }
    }
</script>