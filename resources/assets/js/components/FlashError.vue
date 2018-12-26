<template>
    <div class="alert alert-danger" v-show="show">
        <div class="container">
            <div class="alert-icon">
                <i class="material-icons">info_outline</i>
            </div>
            <b v-html="body"></b>
        </div>
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
            window.events.$on('flash-error', message => {
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