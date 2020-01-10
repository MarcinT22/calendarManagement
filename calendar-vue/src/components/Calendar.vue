<template>
    <div class="block">
        <div class="calendar">
            <div class="loading loading--calendar" v-if="isLoading"></div>
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
                    @eventClick="clickEvent"
                    :all-day-slot="false"
                    min-time="07:00:00"
                    max-time="17:30:00"
                    height="auto"
                    :business-hours="businessHours"
                    slot-duration="00:15:00"
                    :slot-label-format="slotLabelFormat"
                    :column-header-format="columnHeaderFormat"


            />
            <EventModal ref="eventModal" :save="save" :edit="edit" :delete="deleteEvent"></EventModal>
        </div>
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
    import EventModal from '@/components/EventModal'

    import Vue from 'vue';
    import VueAlertify from 'vue-alertify';

    Vue.use(VueAlertify);

    export default {
        name: "Calendar",
        data: () => ({
            calendarPlugins: [
                TimeGrid,
                DayGrid,
                InteractionPlugin,
                ListPlugin,

            ],
            calendarHeader: {
                left: 'prev today next',
                center: 'dayGridMonth timeGridWeek, timeGridDay',
                right: 'title'
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
            slotLabelFormat: {
                hour: 'numeric',
                minute: '2-digit',
                omitZeroMinute: false,
                meridiem: 'short',


            },
            columnHeaderFormat: {
                weekday: 'long',
                day:'numeric',
                month:'numeric',
                year:'numeric',
                year:'2-digit'
            },

            events: [],
            event: [],
            isLoading:true

        }),
        components: {
            Fullcalendar,
            EventModal
        },
        methods: {

            select(arg) {
                this.$refs['eventModal'].show('Nowy wpis', 'new')

                this.event = {
                    'start': arg.start,
                    'end': arg.end,
                }

            },

            save() {
                this.$refs['eventModal'].$data.isLoading = true;
                axios.post('/event', {
                    'title': this.$refs['eventModal'].$data.title,
                    'description': this.$refs['eventModal'].$data.description,
                    'start': this.event.start,
                    'end': this.event.end,
                    'calendar_id': this.$route.params.id

                }).then((response) => {
                    this.getEvents()
                    setTimeout(() => {
                        this.$refs['eventModal'].$data.isLoading = false;
                        this.$alertify.success('Pomyślnie dodano wpis');
                        this.$refs['eventModal'].close()
                    }, 500);


                })
                    .catch((e) => {
                        this.$alertify.error('Nie zapisano wpisu');
                        this.$refs['eventModal'].$data.isLoading = false;
                    })
            },

            update(arg) {

                const event = {
                    title: arg.event.title,
                    description: arg.event.description,
                    start: arg.event.start,
                    end: arg.event.end,
                    calendar_id: arg.event.extendedProps.calendar_id
                }
                axios.put('/event/' + arg.event.id, event)
                    .then((response) => {
                    })
                    .catch((e) => {
                        this.$alertify.error(e);
                    })
            },

            clickEvent(arg) {
                this.$refs['eventModal'].show('Edytuj wpis', 'edit')
                this.event = {
                    'id': arg.event.id,
                    'start': arg.event.start,
                    'end': arg.event.end,
                    'calendar_id': arg.event.extendedProps.calendar_id
                }

                this.$refs['eventModal'].$data.title = arg.event.title
                this.$refs['eventModal'].$data.description = arg.event.extendedProps.description
            },

            edit() {
                this.$refs['eventModal'].$data.isLoading = true;
                const updateEvent = {
                    title: this.$refs['eventModal'].$data.title,
                    description: this.$refs['eventModal'].$data.title,
                    start: this.event.start,
                    end: this.event.end,
                    calendar_id: this.event.calendar_id
                }
                axios.put('/event/' + this.event.id, updateEvent)
                    .then((response) => {
                        this.getEvents()
                        setTimeout(() => {
                            this.$refs['eventModal'].$data.isLoading = false;
                            this.$alertify.success('Pomyślnie zaaktualizowano wpis');
                            this.$refs['eventModal'].close()
                        }, 500);


                    })
                    .catch((e) => {
                        this.$alertify.error('Nie zapisano wpisu');
                        this.$refs['eventModal'].$data.isLoading = false;
                    })
            },


            getEvents() {
                axios.get('/calendar/' + this.$route.params.id)
                    .then(response => {
                        this.events = response.data
                        this.isLoading=false
                    })
                    .catch(e => {
                        this.$alertify.error(e);
                    })
            },

            deleteEvent() {
                this.$refs['eventModal'].$data.isLoading = true;
                axios.delete('/event/' + this.event.id)
                    .then((response) => {
                        this.getEvents()
                        setTimeout(() => {
                            this.$alertify.success('Usunięto wpis');
                            this.$refs['eventModal'].close()
                            this.$refs['eventModal'].$data.isLoading = false;
                        }, 500);

                    })
                    .catch((e) => {
                        this.$alertify.error('Nie usunięto wpisu');
                        this.$refs['eventModal'].$data.isLoading = false;
                    })
            }


        },
        created() {
            this.getEvents()
        }
    }
</script>

<style scoped lang="scss">

    @import "../assets/scss/block";
</style>
<style lang="scss">
    .calendar {
        position: relative;
        .fc {
            padding-bottom: 50px;
        }

        .fc-event {
            border: 0;
            padding: 5px;
            background:#0a699a;
        }

        .fc-day-header{
            color:#333;
            font-size:12px;
        }
        .fc-toolbar h2{
            font-size:18px;
        }

        .fc-button-primary:focus{
            box-shadow: none !important;
        }

        .fc-button{
            background:#0a699a;
            border:0;
            font-size:12px;
            outline:none;

            &:hover{
                opacity:0.9;
            }

            &:focus{
                background:#0a699a !important;
                opacity:0.65;
            }

            &-active{
                background:#0a699a !important;
                opacity:0.65;
            }
        }
        .fc-time-grid .fc-slats td{
            font-size:16px;

        }

        .fc-time-grid-event .fc-time{
            font-size:12px;
            font-weight: bold;
        }
        .fc-time-grid-event .fc-title{
            font-size:12px;
        }


    }
</style>
