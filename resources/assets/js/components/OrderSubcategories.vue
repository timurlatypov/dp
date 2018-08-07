<template>
    <div>
        <form @submit.prevent="">

            <draggable :list="subcategories" :options="{}" @start="drag=true" @end="drag=false" @change="update">

                <div v-for="subcategory, index in subcategories">
                    <div class="d-flex my-1 rounded" style="border: 1px solid lightgrey">
                        <div class="my-auto ml-2 p-2">{{ subcategory.order_id }} - {{ subcategory.name }}</div>
                    </div>
                </div>

            </draggable>
            <button type="submit" class="btn btn-primary mt-2">Сохранить</button>

        </form>
    </div>
</template>

<script>
    import draggable from 'vuedraggable'

    export default {
        components: {
            draggable
        },
        props: ['data'],
        data() {
            return {
                subcategories: [],
                message: null,
                payload: {
                    index: null,
                    id: null
                }
            }
        },
        methods: {
            toggleModal(id, surname, full_name, index) {
                this.payload.index = index;
                this.payload.id = id;
                this.payload.surname = surname;
                this.payload.full_name = full_name;
                $('#deleteSpecialistModal').modal('show')
            },
            deleteId(id, index) {
                axios.delete('/admin/specialists/delete/'+id)
                    .then((response) => {
                        this.specialists.splice(index, 1);
                        this.update();
                        this.submit();
                        this.hideAlert();
                        $('#deleteSpecialistModal').modal('hide')
                    }).catch((error) => {
                    // set error messages
                })
            },

            submit() {
                axios.patch('/admin/specialists/update', this.specialists)
                    .then((response) => {
                        // set success message
                    }).catch((error) => {
                    // set error messages
                })
            },

            update(e) {
                this.subcategories.map((subcategory, index) => {
                    subcategory.order_id = index + 1
                })
            },

            hideAlert() {
                setTimeout(() => {
                    this.message = ''
                }, 2000)
            }
        },
        mounted () {
            this.subcategories = this.data;
            console.log(this.subcategories);
        }
    }
</script>