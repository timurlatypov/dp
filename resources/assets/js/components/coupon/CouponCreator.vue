<template>
    <table class="table">
        <thead>
        <tr>
            <th>Скидка</th>
            <th>Многоразовый</th>
            <th><nobr>Действует до</nobr></th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td style="vertical-align: top">
                    <div class="form-group">
                        <label for="brand" class="col-form-label">скидка, %</label>
                        <input id="brand" type="text" class="form-control" name="discount" v-model="coupon.discount" style="width: 150px;" v-validate="'required'">
                    </div>
                    <button class="btn btn-info btn-sm" @click.prevent="store()">Сохранить</button>
                </td>
                <td style="vertical-align: top">
                    <div class="form-group">
                        <div class="form-check form-check-radio">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="reusable" id="exampleRadios1" value="1" v-model="coupon.reusable">
                                Да
                                <span class="circle">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                        <div class="form-check form-check-radio">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="reusable" id="exampleRadios2" value="0" v-model="coupon.reusable" checked>
                                Нет
                                <span class="circle">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                    </div>
                </td>
                <td style="vertical-align: top">
                    <div class="form-group">
                        <label for="expired_at" class="col-form-label">Использовать до</label>
                        <input id="expired_at" type="date" class="form-control" name="expired_at" v-model="coupon.expired_at" v-validate="'required'">
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        props: ['store_coupon_endpoint'],
        data() {
            return {
                coupon: {
                    expired_at: null,
                    reusable: 0,
                    discount: null,
                }
            }
        },
        methods: {
            store() {
                console.log(this.coupon);
                axios.post(this.store_coupon_endpoint, this.coupon)
                    .then(response => {
                        window.flash('Сохранен');
                    });
            }
        }
    }
</script>