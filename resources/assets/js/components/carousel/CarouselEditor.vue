<template>
    <div>
        <draggable :list="banners" :options="{}" @start="drag=true" @end="drag=false" @change="update">
            <div v-for="banner, index in banners">
                <div class="d-flex my-2 rounded" :style="'border: 1px solid lightgrey; background-color: #'+banner.hex+'; background-image: url(\'/storage/carousel/'+ banner.image_path +'\'); background-position: center center; background-size: contain; background-repeat: no-repeat;'">
                    <div class="my-auto ml-2 p-2">
                        <small><nobr>ORDER: {{ banner.order_id }}</nobr></small><br>
                        <small><nobr>EXPIRE: {{ banner.expired_at_diff }}</nobr></small><br>
                        <toggle-switch :toggle="String(banner.live)" :endpoint="live_toggle_endpoint" :product_id="banner.id"></toggle-switch>
                    </div>
                    <div class="p-2 w-100 font-weight-bold">
                        <h4 class="title" v-html="banner.title"></h4><br>
                        <h6>{{banner.brand}}</h6>
                        <button class="btn btn-info btn-sm">{{ banner.button }}</button>
                    </div>
                    <div class="my-auto mr-2 p-2 rounded text-center" data-toggle="tooltip" data-placement="top" title="Редактировать"><a :href="'/banner/' + banner.id +'/edit'"><i class="fa fa-edit"></i></a></div>
                    <div class="my-auto mr-2 p-2 rounded text-center" data-toggle="tooltip" data-placement="top" title="Удалить"><i class="fa fa-trash text-danger"></i></div>
                </div>
            </div>
        </draggable>
    </div>
</template>

<script>
    import draggable from 'vuedraggable'

    export default {
        components: {
            draggable
        },
        props: ['data', 'update_endpoint', 'live_toggle_endpoint'],
        data() {
            return {
                banners: []
            }
        },
        methods: {
            submit() {
                axios.patch(this.update_endpoint, this.banners)
                    .then((response) => {
                        window.flash('Новый порядок сохранён!')
                    }).catch((error) => {
                    // set error messages
                })
            },
            update(e) {
                this.banners.map((banner, index) => {
                    banner.order_id = index + 1
                })
                this.submit();
            },
        },
        mounted () {
            this.banners = this.data;
        }
    }
</script>