<template>
    <div class="home">
        <div class="home__col">
            <LastEvents></LastEvents>
        </div>
        <div class="home__col">

            <UpcomingEvents></UpcomingEvents>
        </div>
    </div>
</template>

<script>

    import LastEvents from '@/components/LastEvents'
    import UpcomingEvents from '@/components/UpcomingEvents'

    export default {
        name: "StartView",
        components: {
            LastEvents,
            UpcomingEvents
        }
    }
</script>
<style scoped lang="scss">
    .home {
        display: flex;
        flex-direction: row;
        margin:0 -15px;
        &__col{
            width:33.33%;
            padding: 0 15px;
        }

    }
</style>

