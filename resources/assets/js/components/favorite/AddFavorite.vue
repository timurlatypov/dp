<template>
    <a
            class="btn btn-fab btn-link"
            data-toggle="tooltip"
            data-placement="top"
            @click.prevent="saveToFavorite"
            title="Сохранить любимый продукт">
        <i class="material-icons text-danger">favorite_border</i>
        <div class="ripple-container"></div>
    </a>
</template>

<script>
    export default {
        props: ['endpoint'],
        methods: {
            saveToFavorite() {
                axios.get(this.endpoint)
                    .then( response => {
                        if (response.status === 202) {
                            window.flash('Данный продукт уже сохранен как Любимый!');
                        } else if (response.status === 200) {
                            window.flash('Продукт сохранен как Любимый!');
                        }
                    } )
            }
        }
    }
</script>
