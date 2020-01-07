<template>
    <div>
        Login
        <form @submit.prevent="login" method="post">
            <label for="email">E-mail</label>
            <input type="email" id="email" v-model="email" />
            <label for="password">Password</label>
            <input type="password" id="password" v-model="password" />
            <button type="submit">Submit</button>
        </form>
    </div>
</template>

<script>

    export default {
        name: "Login",
        data(){
            return{
                email:null,
                password:null,
                error:false,

            }
        },

        methods:{
            login(){

                var app = this
                this.$auth.login({
                    params:{
                        email:app.email,
                        password: app.password
                    },
                    success:function(){},
                    error: function(r){
                        app.error = true;
                        app.errors = r.response.data.errors;
                        console.log(r.response)
                    },
                    rememberMe:true,
                    redirect:'/',
                    fetchUser:true
                })
            }
        },

    }
</script>

<style scoped>

</style>
