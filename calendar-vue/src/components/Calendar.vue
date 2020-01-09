<template>
    <div class="calendar">
        Terminarz {{$auth.user().name}}


        <fullcalendar
                :plugins="calendarPlugins"
                :header="calendarHeader"
                :buttonText="calendarButtonText"
                locale="pl"
                :weekends="false"
                :selectable="true"
                :editable="true"
                :events="events"
                @select="select"
                @eventDrop="update"
                @eventResize="update"
                :all-day-slot="false"
                min-time="06:00:00"
                max-time="19:30:00"
                height="auto"
                :business-hours="businessHours"
        />
        <Modal ref="modal"></Modal>
    </div>
</template>

<script>
    require('@fullcalendar/core/main.min.css')
    require('@fullcalendar/daygrid/main.min.css')
    require('@fullcalendar/timegrid/main.min.css')

    import Fullcalendar from '@fullcalendar/vue'
    import DayGrid from '@fullcalendar/daygrid'
    import TimeGrid from '@fullcalendar/timegrid'
    import InteractionPlugin from '@fullcalendar/interaction'
    import ListPlugin from '@fullcalendar/list'
    import axios from 'axios'
    import Modal from '@/components/Modal'

    export default {
        name: "Calendar",
        data: () => ({
            calendarPlugins: [
                TimeGrid,
                DayGrid,
                InteractionPlugin,
                ListPlugin
            ],
            calendarHeader: {
                left: 'title',
                center: 'dayGridMonth timeGridWeek, timeGridDay, listWeek',
                right: 'prev today next'
            },
            calendarButtonText: {
                today: 'Dzisiaj',
                month: 'Miesiąc',
                week: 'Tydzień',
                day: 'Dzień',
                list: 'Lista',

            },
            businessHours: {
                startTime: '08:00',
                endTime: '16:00',
            },
            events: [],

        }),
        components: {
            Fullcalendar,
            Modal
        },
        methods: {
            select(arg) {
                this.$refs.modal.show()
                var title = prompt('Wprowadz tytul')
                var event = {
                    'title': title,
                    'start': arg.start,
                    'end': arg.end,
                    'calendar_id': this.$route.params.id
                }


                axios.post('/event', {
                    title: title,
                    description: 'gfd',
                    start: arg.start,
                    end: arg.end,
                    calendar_id: this.$route.params.id

                }).then((response) => {
                    console.log('dodano')
                    this.getEvents()
                })
                    .catch((e) => {
                        console.error(e)
                    })
            },
            update(arg) {

                const event = {
                    title: arg.event.title,
                    description: 'gfd',
                    start: arg.event.start,
                    end: arg.event.end,
                    calendar_id: arg.event.extendedProps.calendar_id
                }
                axios.put('/event/' + arg.event.id, event)
                    .then((response) => {
                        console.log('update')
                        // this.getEvents()
                    })
                    .catch((e) => {
                        console.error(e)
                    })
            },

            getEvents(){
                axios.get('/calendar/' + this.$route.params.id)
                    .then(response => {
                        // console.log(response.data)
                        // JSON responses are automatically parsed.
                        this.events = response.data
                        console.log(response.data)
                    })
                    .catch(e => {
                        console.log('error')
                    })
            }


        },
        created() {
            this.getEvents()
        }
    }
</script>

<style lang="scss">
    .calendar {
        max-width: 1200px;
        max-height: 500px;

        .fc {
            padding-bottom: 50px;
        }

        .fc-event {
            border: 0;
            padding: 5px;
        }
    }


</style>
