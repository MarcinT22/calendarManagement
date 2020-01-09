<template>
    <div>
       Home
        {{this.$auth.user().is_admin}}
    </div>
</template>

<script>

    export default {
        name: "StartView"
    }
</script>

<style lang="scss">

</style>
