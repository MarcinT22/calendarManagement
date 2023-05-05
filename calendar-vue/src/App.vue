<template>
  <div>
    <template v-if="$auth.check()">
      <div class="dashboard" id="dashboard">
        <div class="dashboard__left">
          <div class="dashboard__close" @click="closeMenu">
            <i class="fas fa-times"></i>
          </div>
          <div class="dashboard__header">
            <h1>
              <router-link to="/">
                <i class="far fa-calendar-alt"></i>
                e-calendar
              </router-link>
            </h1>
          </div>
          <Menu ref="menu"></Menu>
        </div>
        <div class="dashboard__container">
          <Top></Top>
          <div class="dashboard__content">
            <router-view></router-view>
          </div>
        </div>
      </div>
    </template>
    <template v-else>
      <router-view></router-view>
    </template>
  </div>
</template>

<script>
import Menu from "./components/Menu";
import Top from "./components/Top";

export default {
  name: "App",
  components: { Menu, Top },
  methods: {
    closeMenu() {
      let dashboard = document.getElementById("dashboard");
      dashboard.classList.toggle("dashboard--full");
    }
  }
};
</script>

<style lang="scss">
html,
body {
  padding: 0;
  margin: 0;
}
</style>
<style lang="scss">
@import "assets/scss/fonts";
@import "assets/scss/fontawesome";
@import "assets/scss/style";
@import "assets/scss/dashboard";
</style>
