<template>
    <div class="modal" :class="{'modal--show':isShow}">
        <div class="modal__container">
            <div class="modal__block">
                <div class="modal__header">
                    <i class="fas fa-thumbtack"></i> {{header}}
                    <a href="#" @click.prevent="close" title="Zamknij" class="modal__close">
                        <i class="fas fa-times"></i>
                    </a>
                </div>

                <div class="modal__content">
                    <form @submit.prevent="" method="post" class="modal__form">
                        <div class="modal__field">
                            <label for="title" class="modal__label">Tytuł:</label>
                            <input type="text" class="modal__input" v-model="title" id="title">
                        </div>
                        <div class="modal__field">
                            <label for="description" class="modal__label">Opis:</label>
                            <textarea class="modal__textarea" id="description" v-model="description"></textarea>
                        </div>
                        <div class="modal__bottom">
                            <div class="modal__loading" v-if="isLoading"></div>
                            <template v-if="method=='new'">
                                <button type="submit" class="modal__button" v-if="!isLoading" @click="this.save">
                                    Zapisz
                                </button>
                            </template>
                            <template v-if="method=='edit'">
                                <button type="submit" class="modal__button" v-if="!isLoading" @click="this.edit">Zaaktualizuj
                                </button>
                            </template>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        name: "AddEventModal",
        props: ['save','edit','event'],
        data() {
            return {
                header: '',
                isShow: false,
                title: '',
                description: '',
                isLoading: false,
                method: '',
            }
        },
        methods: {
            close() {
                this.isShow = !this.isShow
                this.title = ''
                this.description = ''
            },
            show(header, method) {
                this.isShow = !this.isShow
                this.header = header
                this.method = method

            }
        }
    }
</script>

<style scoped lang="scss">
    @import '../assets/scss/fontawesome';
    @import '../assets/scss/form';
    @import "../assets/scss/modal";

</style>
