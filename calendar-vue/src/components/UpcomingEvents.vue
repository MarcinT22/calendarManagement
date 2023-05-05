<template>
  <div class="block">
    <h2>
      <i class="fas fa-forward"></i>
      Nadchodzące wydarzenia
    </h2>
    <div class="loading loading--center" v-if="isLoading"></div>
    <div class="block__content" v-else>
      <div
        v-for="event in upcomingEvents"
        class="block__last"
        v-if="!isLoading"
      >
        <div class="block__time">
          <i class="far fa-clock"></i> {{ formatDate(event.start) }}
          <div
            class="block__status block__status--important"
            v-if="event.status == 1"
          >
            <i class="fas fa-exclamation-circle"></i>
          </div>
          <div
            class="block__status block__status--done"
            v-if="event.status == 2"
          >
            <i class="fas fa-check-circle"></i>
          </div>
        </div>
        <h3>
          {{ event.title.substring(0, 50) + ".." }}
        </h3>
        <div class="block__description">
          {{ event.description.substring(0, 135) + ".." }}
        </div>
      </div>
      <div class="block__empty" v-if="empty">
        Brak
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import moment from "moment";
import Vue from "vue";
import VueAlertify from "vue-alertify";

Vue.use(VueAlertify);

export default {
  name: "UpcomingEvents",
  data() {
    return {
      upcomingEvents: [],
      isLoading: true,
      empty: false
    };
  },
  created() {
    axios
      .get("/future/events/" + this.$auth.user().id + "/" + 5)
      .then(response => {
        this.upcomingEvents = response.data;
        this.isLoading = false;
        if (this.upcomingEvents.length == 0) {
          this.empty = true;
        }
      })
      .catch(e => {
        this.$alertify.error("Nie można wczytać danych");
      });
  },
  methods: {
    formatDate(date) {
      return moment(String(date)).format("DD.MM.YY HH:mm");
    }
  }
};
</script>

<style lang="scss" scoped>
@import "../assets/scss/block";

.home {
  max-width: 500px;
}
</style>
