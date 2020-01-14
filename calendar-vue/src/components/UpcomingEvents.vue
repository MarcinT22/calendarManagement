<template>
    <div class="block">
        <h2>
            <i data-v-9bcc0be2="" class="far fa-calendar-alt"></i>
            <i class="fas fa-forward"></i>
            Nadchodzące wydarzenia
        </h2>
        <div class="loading loading--center" v-if="isLoading"></div>
        <div>
            <div v-for="event in upcomingEvents" class="block__last" v-if="!isLoading" >
                <div class="block__time">
                    <i class="far fa-clock"></i> {{formatDate(event.start)}}
                    <div class="block__status block__status--important" v-if="event.status==1">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div class="block__status block__status--done" v-if="event.status==2">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
                <h3>
                    {{ event.title.substring(0,50)+".." }}
                </h3>
                <div class="block__description">
                    {{ event.description.substring(0,135)+".." }}
                </div>


            </div>
        </div>

    </div>
</template>

<script>
    import axios from 'axios'
    import moment from 'moment'

    export default {
        name: "UpcomingEvents",
        data() {
            return {
                upcomingEvents: [],
                isLoading: true
            }
        },
        created() {
            axios.get('/future/events/' + this.$auth.user().calendar_id + '/' + 5)
                .then(response => {
                    this.upcomingEvents = response.data;
                    this.isLoading = false

                })
                .catch(e => {
                    alert('error')
                })
        },
        methods: {
            formatDate(date) {
                return moment(String(date)).format('DD.MM.YY HH:mm')
            }
        }
    }
</script>

<style lang="scss" scoped>
    @import '../assets/scss/block';

    .home {
        max-width: 500px;
    }
</style>