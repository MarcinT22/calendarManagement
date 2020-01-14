<template>
    <div class="block">
        <div class="block__actions">
            <router-link to="/register" class="block__button block__button--add">
                <i class="fas fa-user-plus"></i> Nowy użytkownik
            </router-link>
        </div>

    </div>
</template>

<script>
    export default {
        name: "Users"
    }
</script>

<style scoped lang="scss">
    @import '../assets/scss/block'
</style>