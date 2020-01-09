<template>
    <div  :class="{'login-background':!$auth.check() }">
        <Menu></Menu>
        <router-view></router-view>
    </div>
</template>

<script>

    import Menu from "./components/Menu";
    export default {
        name: 'App',
        components: {Menu},
    }
</script>

<style  lang="scss">
   html,body{
       padding:0;
       margin:0;
   }
</style>
<style lang="scss">
    @import "assets/scss/style";

</style>
