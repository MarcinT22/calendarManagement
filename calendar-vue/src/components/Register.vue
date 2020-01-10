<template>
    <div class="block">
        <h2>
            Dodaj nowego użytkownika
        </h2>

        <form @submit.prevent="register" method="post" class="form">
            <div class="form__field">
                <label for="name">Nazwa:</label>
                <input type="text" id="name" v-model="name" class="form__input" />
            </div>
            <div class="form__field">
                <label for="email">E-mail:</label>
                <input type="email" id="email" v-model="email" class="form__input"/>
            </div>
            <div class="form__field">
                <label for="password">Hasło:</label>
                <input type="password" id="password" v-model="password" class="form__input"/>
            </div>
            <div class="form__field">
                <label for="isRoot">Administrator</label>
                <input type="checkbox" id="isRoot" v-model="roles">

            </div>
            <div class="block__loading" v-if="isLoading"></div>
            <button type="submit" v-if="!isLoading" class="form__button form__button--add">Dodaj<i class="fas fa-user-plus"></i> </button>
        </form>


    </div>
</template>

<script>
    import Vue from 'vue';
    import VueAlertify from 'vue-alertify';

    Vue.use(VueAlertify);
    export default {
        name: "Register",
        data() {
            return {
                name: '',
                email: '',
                password: '',
                roles: false,
                error: false,
                errors: {},
                success: false,
                isLoading:false,
            }
        },
        methods: {
            register() {
                this.isLoading=true
                var app = this
                this.$auth.register({
                    data: {
                        name: app.name,
                        email: app.email,
                        password: app.password,
                        roles: app.roles
                    },
                    success: function () {
                        app.success = true
                        this.$alertify.success('Dodano użytkownika')
                        this.isLoading=false

                    },
                    error: function (r) {
                        app.error = true;
                        app.errors = r.response.data.errors;
                        this.$alertify.error('Użytkownik nie został dodany')
                        this.isLoading=false
                    },
                    redirect: '/'
                })
            }
        }

    }
</script>

<style scoped lang="scss">
    @import "../assets/scss/block";
</style>
