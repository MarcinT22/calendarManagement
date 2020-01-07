<template>
    <div>
        <router-link to="/">Home</router-link>
        <router-link :to="{path:'/calendar/'+$auth.user().calendar_id}">Calendar</router-link>
        <router-link to="/register" v-if="!$auth.check()">Register</router-link>
        <router-link to="/login"  v-if="!$auth.check()">Login</router-link>
        <a href="#"  v-if="$auth.check()" @click.prevent="$auth.logout()">Wyloguj</a>
    </div>
</template>

<script>
    export default {
        name: "StartView"
    }
</script>

<style lang="scss">

</style>
