<template>
    <div v-if="$auth.check()">
        <router-link to="/">Home</router-link>
        <router-link :to="{path:'/calendar/'+$auth.user().calendar_id}">Calendar</router-link>
        <router-link to="/register" v-if="$auth.check() && $auth.user().roles == 1">Register</router-link>
        <router-link to="/login"  v-if="!$auth.check()">Login</router-link>
        <a href="#"  v-if="$auth.check()" @click.prevent="$auth.logout()">Wyloguj</a>
    </div>
</template>

<script>
    export default {
        name: "Menu"
    }
</script>

<style scoped>

</style>