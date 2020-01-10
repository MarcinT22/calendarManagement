<template>
    <div class="login login--background">
        <div class="login__content">
            <div class="login__user">
                <i class="fas fa-user"></i>
            </div>
            <h1>
                Logowanie
            </h1>
            <form @submit.prevent="login" method="post" class="form">
                <div class="form__field">
                    <i class="fas fa-user form__icon"></i><input type="email" id="email" v-model="email" class="form__input form__input--icon" placeholder="E-mail"/>
                </div>
                <div class="form__field">
                    <i class="fas fa-lock form__icon"></i><input type="password" id="password" v-model="password" class="form__input form__input--icon" placeholder="Hasło"/>
                </div>
                <div class="form__error" v-if="error">
                    {{errorMessage}}
                </div>
                <button type="submit" v-if="!isLoading" class="form__button">Zaloguj</button>
                <div class="loading" v-if="isLoading"></div>
            </form>
        </div>
    </div>
</template>

<script>

    export default {
        name: "Login",
        data() {
            return {
                email: null,
                password: null,
                error: false,
                errorMessage:'',
                isLoading:false
            }
        },

        methods: {
            login() {
                this.isLoading = true;
                this.error = false;
                var app = this
                this.$auth.login({
                    params: {
                        email: app.email,
                        password: app.password
                    },
                    success: function () {
                        app.error = false;
                    },
                    error: function (r) {
                        this.isLoading = false;
                        app.error = true;
                        app.errors = r.response.data.errors;
                        this.errorMessage = r.response.data.message
                    },
                    rememberMe: true,
                    redirect: '/',
                    fetchUser: true
                })
            }
        },

    }
</script>
<style lang="scss" scoped>
    @import "../assets/scss/login";
    @import "../assets/scss/form";

</style>

