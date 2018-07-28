<template>
    <div class="alert alert-success alert-style text-center p-3" role="alert" v-show="show">
        <b v-html="body"></b>
    </div>
</template>

<script>
    export default {
        props: ['message'],
        data() {
            return {
                body: '',
                show: false
            }
        },
        created() {
            if (this.message) {
                this.flash(this.message);
            }

            window.events.$on('flash', message => {
                this.flash(message);
            })

        },
        methods: {
            flash(message) {
                this.body = message;
                this.show = true;
                this.hide();
            },

            hide() {
                setTimeout( ()=> {
                    this.show = false;
                }, 5000);
            }
        }
    }
</script>

<style>
    .alert-style {
        position: fixed;
        width: 100%;
        top: 0;
        z-index: 1100;
    }
</style>