<template>
    <div>
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
    @import "assets/scss/fonts";
    @import "assets/scss/style";

</style>
