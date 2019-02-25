<template>
    <div>
        <div class="modal" id="requestCallback" tabindex="-1" role="dialog" aria-labelledby="requestCallbackLabel" aria-hidden="true">
            <form @submit.prevent="validateBeforeSubmit">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="requestCallbackLabel">Обратный звонок<br>Консультация косметолога</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="name">Меня зовут <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" v-model="data.name" v-validate="'required|alpha'">
                                <small v-show="errors.has('name')" class="text-danger">{{ errors.first('name') }}</small>
                            </div>

                            <div class="form-group">
                                <label for="phone">Номер телефона <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" id="phone" name="phone" v-model="data.phone" v-validate="'required'">
                                <small v-show="errors.has('phone')" class="text-danger">{{ errors.first('phone') }}</small>
                            </div>

                            <div class="form-group">
                                <label for="comment">Комментарий</label>
                                <textarea class="form-control" v-model="data.comment" name="comment"></textarea>
                            </div>

                            <div class="form-group">
                                <vue-recaptcha @verify="markRecaptchaAsVerified" sitekey="6LdEumAUAAAAALLtFd8e4ahkX7ckssjFvkd4iQbC"></vue-recaptcha>
                                <small v-show="recaptchaError" class="text-danger">{{ recaptchaMessage }}</small>
                            </div>

                            <div class="form-group" v-show="success">
                                <div class="alert alert-success" style="position: relative" id="alert-success" role="alert">
                                    <strong>Мы получили Ваше сообщение</strong><br>В ближайшее время мы Вам позвоним!
                                    <button type="button" class="close" @click="hideSuccess">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>

                            <div class="form-group" v-show="error">
                                <div class="alert alert-danger alert-dismissible fade show" id="alert-error" role="alert">
                                    <strong>Что-то пошло не так!</strong><br>Попробуйте отправить еще раз!
                                    <button type="button" class="close" @click="hideError">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="submit" :class="sending ? 'btn shadow btn-secondary' : 'btn btn-private shadow inverse'" :disabled="sending">
                                <span v-if="sending"><i class="fa fa-spin fa-spinner color-white"></i>&nbsp;&nbsp;Отправляем</span>
                                <span v-else><i class="fa fa-paper-plane color-white"></i>&nbsp;&nbsp;Заказать</span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
</template>

<script>
    import VueRecaptcha from 'vue-recaptcha';
    Vue.component('vue-recaptcha', VueRecaptcha);

    export default {
        props: {
            endpoint: {
                type: String
            }
        },
        data () {
            return {
                loginForm: {
                    recaptchaVerified: false,
                    pleaseTickRecaptchaMessage: ''
                },
                data: {
                    name: null,
                    phone: null,
                    comment: null
                },
                success: false,
                error: false,
                sending: false,
                recaptchaError: false,
                recaptchaVerified: false,
                recaptchaMessage: 'Необходимо подтвердить reCaptcha'

            }
        },
        methods: {
            hideSuccess() {
                this.success = false;
            },
            hideError() {
                this.error = false;
            },
            validateBeforeSubmit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.checkIfRecaptchaVerified();
                    }
                });
            },
            submitForm() {
                this.sending = true;

                axios.post(this.endpoint, this.data)
                    .then((response) => {
                        this.success= true;
                        this.sending = false;
                    }).catch((error) => {
                    this.error= true;
                    this.sending = false;
                })
            },
            markRecaptchaAsVerified(response) {
                this.recaptchaError = false;
                this.recaptchaVerified = true;
            },
            checkIfRecaptchaVerified() {
                if (!this.recaptchaVerified) {
                    this.recaptchaError = true;
                    return true; // prevent form from submitting
                }
                this.submitForm();
            }
        }
    }
</script>