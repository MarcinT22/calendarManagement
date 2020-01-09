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
            <label for="isRoot">Administrator</label>
            <input type="checkbox" id="isRoot"  v-model="roles">
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
                roles:false,
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
                        password:app.password,
                        roles: app.roles
                    },
                    success: function(){
                        app.success = true
                        console.log('dodano')
                    },
                    error: function(r){
                        app.error = true;
                        app.errors = r.response.data.errors;
                    },
                    redirect:'/'
                })
            }
        }

    }
</script>

<style scoped>

</style>
