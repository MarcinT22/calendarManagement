<template>
    <div class="block block--calendar">
        <div class="calendar">
            <div class="loading loading--calendar" v-if="isLoading"></div>
            <div class="calendar__legend">
                <div class="calendar__status">
                    <span class="calendar__background"></span> Domyślny
                </div>
                <div class="calendar__status">
                    <span class="calendar__background calendar__background--important"></span> Ważny
                </div>
                <div class="calendar__status">
                    <span class="calendar__background calendar__background--done"></span> Wykonany
                </div>
            </div>
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
                weekday: 'short',
                day: 'numeric',
                month: 'numeric',
                year: 'numeric',
                year: '2-digit'
            },

            events: [],
            event: [],
            isLoading: true

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
                    'calendar_id': this.$route.params.id,
                    'status': this.$refs['eventModal'].$data.status,
                    'backgroundColor': this.setBackgroundColor(this.$refs['eventModal'].$data.status)

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
                    start: arg.event.start,
                    end: arg.event.end,
                }
                axios.put('/event/' + arg.event.id, event)
                    .then((response) => {
                    })
                    .catch((e) => {
                        this.$alertify.error('Nie zaaktualizowano wpisu');
                    })
            },

            clickEvent(arg) {
                this.$refs['eventModal'].show('Edytuj wpis', 'edit')
                this.event = {
                    'id': arg.event.id,
                    'start': arg.event.start,
                    'end': arg.event.end,
                    'calendar_id': arg.event.extendedProps.calendar_id,
                }

                this.$refs['eventModal'].$data.title = arg.event.title
                this.$refs['eventModal'].$data.description = arg.event.extendedProps.description
                this.$refs['eventModal'].$data.status = arg.event.extendedProps.status
                this.$refs['eventModal'].$data.backgroundColor = arg.event.extendedProps.backgroundColor
            },

            edit() {
                this.$refs['eventModal'].$data.isLoading = true;
                const updateEvent = {
                    title: this.$refs['eventModal'].$data.title,
                    description: this.$refs['eventModal'].$data.title,
                    start: this.event.start,
                    end: this.event.end,
                    calendar_id: this.event.calendar_id,
                    status: this.$refs['eventModal'].$data.status,
                    backgroundColor: this.setBackgroundColor(this.$refs['eventModal'].$data.status)
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
                        this.isLoading = false
                    })
                    .catch(e => {
                        this.$alertify.error('Nie można pobrać wydarzeń');
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
            },

            setBackgroundColor(status) {
                if (status == 1) {
                    return '#9a0a0a'
                } else if (status == 2) {
                    return '#0a9a3d'
                } else {
                    return '#0a699a'
                }

            },


        },
        watch:{
          '$route.params.id':function(){
              this.events = []
              this.isLoading = true
                this.getEvents()
          }
        },
        created() {
            this.getEvents()
        },

    }
</script>

<style scoped lang="scss">

    @import "../assets/scss/block";
</style>
<style lang="scss">
    .calendar {
        position: relative;

        &__legend {
            display: flex;
            margin-bottom: 20px;
        }

        &__status {
            display: flex;
            margin-right: 10px;
            align-items: center;
            font-size: 12px;
        }

        &__background {
            width: 10px;
            height: 10px;
            background: #0a699a;
            margin-right:5px;

            &--important {
                background: #9a0a0a;

            }

            &--done {
                background: #0a9a3d;
            }

        }

        .fc {
            padding-bottom: 50px;
        }

        .fc-event {
            border: 0;
            padding: 5px;
            background: #0a699a;
        }

        .fc-day-header {
            color: #333;
            font-size: 12px;
        }

        .fc-toolbar{
            @media (max-width:767px)
            {
                flex-direction: column;
            }
        }

        .fc-center{
            @media (max-width:767px)
            {
                margin:5px 0;
            }
        }


        .fc-toolbar h2 {
            font-size: 18px;


            @media (max-width:1024px)
            {
                font-size:14px;
            }
        }

        .fc-button-primary:focus {
            box-shadow: none !important;
        }

        .fc-button {
            background: #0a699a;
            border: 0;
            font-size: 12px;
            outline: none;

            &:hover {
                opacity: 0.9;
            }

            &:focus {
                background: #0a699a !important;
                opacity: 0.65;
            }

            &-active {
                background: #0a699a !important;
                opacity: 0.65;
            }
        }

        .fc-time-grid .fc-slats td {
            font-size: 16px;

            @media (max-width:1024px)
            {
                font-size:14px;
            }

            @media (max-width:767px)
            {
                font-size:12px;
            }

        }

        .fc-time-grid-event .fc-time {
            font-size: 12px;
            font-weight: bold;
        }

        .fc-time-grid-event .fc-title {
            font-size: 12px;
        }


    }
</style>
