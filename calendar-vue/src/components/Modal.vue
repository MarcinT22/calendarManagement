<template>
    <div class="modal" :class="{'modal--show':isShow}">
        <div class="modal__container">
            <div class="modal__block">
                <div class="modal__header">
                    <i class="fas fa-thumbtack"></i> Nowy wpis
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
                            <textarea class="modal__textarea" id="description"  v-model="description"></textarea>
                        </div>
                        <div class="modal__buttons">
                            <button type="submit" class="modal__button" @click="this.save">Zapisz</button>
                            <button type="submit" @click="close" class="modal__button">Zamknij</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Modal",
        props:['save'],
        data(){
            return{
                isShow:false,
                title:'',
                description:'',

            }
        },
        methods:{
            close(){
                this.isShow=!this.isShow
            },
            show(){
                this.isShow=!this.isShow
            }
        }
    }
</script>

<style scoped lang="scss">
    @import '../assets/scss/fontawesome';
    @import '../assets/scss/form';
    @import '../assets/scss/fonts';

    .modal {
        position: fixed;
        background: rgba(0, 0, 0, 0.5);
        left: 0;
        top: 0;
        right: 0;
        bottom: 0;
        z-index: 99;
        opacity:0;
        visibility: hidden;
        transition:opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;

        &--show{
            opacity:1;
            visibility: visible;
        }

        &__container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
        }

        &__block {
            width: 100%;
            max-width: 600px;
            box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        &__header {
            background: #040e2f;
            font-size: 14px;
            color: #fff;
            padding: 10px;
            font-weight: 600;
            display: flex;
            padding-right: 30px;
            align-items: center;
            position: relative;

            i {
                margin-right: 10px;
            }

        }

        &__close {
            position: absolute;
            right: 5px;
            color: #fff;
            font-size: 18px;
            transition: color 0.3s;

            &:hover {
                color: #ab2626;
            }
        }

        &__content {
            background: #fff;
            box-sizing: border-box;
            padding: 15px;

        }

        &__field {
            display: flex;
            margin-bottom: 10px;
        }

        &__label {
            font-size: 14px;
            color: #000;
            margin-right: 10px;
            display: block;
            min-width: 50px;
            margin-top: 5px;
        }

        &__input {
            width: 100%;
            box-sizing: border-box;
            padding: 7px;
            outline: none;
            border: 1px solid #cdcdcd;
            color: #000;
            font-size: 14px;
        }

        &__textarea {
            width: 100%;
            box-sizing: border-box;
            padding: 7px;
            outline: none;
            border: 1px solid #cdcdcd;
            resize: none;
            min-height: 200px;
            font-family: 'Open Sans', sans-serif;
            color: #000;
            font-size: 14px;
        }


        &__buttons{
            display: flex;
            justify-content: flex-end;
            padding-top:10px;

            button{
                outline:none;
                cursor: pointer;
                background: #ab2626;
                 color:#fff;
                transition:background 0.3s ease-in-out;
                font-family: 'Open Sans', sans-serif;
                border:0;
                padding:5px 10px;
                font-size:14px;
                margin-left:10px;
                &:hover{
                    background: #1d0135;
                }
            }
        }
    }
</style>
