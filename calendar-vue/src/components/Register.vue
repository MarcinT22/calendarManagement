<template>
    <div>
        Register
        <form @submit.prevent="register" method="post">
            <label for="name">Name</label>
            <input type="text" id="name" v-model="name" />
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
        name: "Register",
        data(){
            return {
                name:'',
                email:'',
                password:'',
                error:false,
                errors:{},
                success:false
            }
        },
        methods:{
            register(){
                var app = this
                this.$auth.register({
                    data:{
                        name:app.name,
                        email:app.email,
                        password:app.password
                    },
                    success: function(){
                        app.success = true
                    },
                    error: function(r){
                        app.error = true;
                        app.errors = r.response.data.errors;
                    },
                    redirect:null
                })
            }
        }

    }
</script>

<style scoped>

</style>
