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
        name: "Home",
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

        @media (max-width:1024px)
        {
           margin:0px;
        }

        &__col{
            width:100%;
            max-width:550px;
            padding: 0 15px;

            @media (max-width:1024px)
            {
               padding:0 5px;
            }
        }

    }
</style>

