<template>
  <div class="top">
    <div class="top__bars" @click="fullDashboard">
      <i class="fas fa-bars"></i>
    </div>
    <div class="top__nav">
      <div class="top__user">
        <i class="fas fa-user"></i> {{ $auth.user().name }}
      </div>
      <a href="#" @click.prevent="logout" class="top__logout">
        Wyloguj <i class="fas fa-power-off"></i>
      </a>
    </div>
  </div>
</template>

<script>
export default {
  name: "Top",
  methods: {
    logout() {
      this.$auth.logout({
        redirect: "/login"
      });
    },
    fullDashboard() {
      let dashboard = document.getElementById("dashboard");
      dashboard.classList.toggle("dashboard--full");
    }
  }
};
</script>

<style scoped lang="scss">
@import "../assets/scss/colors.scss";
.top {
  display: flex;
  align-items: center;
  padding: 8px 15px;
  box-shadow: 0 0 5px rgba(100, 100, 100, 0.1);
  background: #fff;
  margin-left: -10px;
  padding-left: 25px;

  &__bars {
    cursor: pointer;
    font-size: 20px;
    color: $black;
    transition: color 0.3s;
    -webkit-tap-highlight-color: none;
    &:hover {
      color: $blue;
    }
  }

  &__nav {
    width: 100%;
    display: flex;
    justify-content: flex-end;
  }

  &__user {
    margin-right: 20px;
    font-size: 14px;
    display: flex;
    align-items: center;
    color: $black;
    font-weight: 400;

    @media (max-width: 1024px) {
      font-size: 12px;
      margin-right: 15px;
    }

    i {
      font-size: 17px;
      margin-right: 5px;
      color: $black;
      @media (max-width: 1024px) {
        font-size: 15px;
      }
    }
  }

  &__logout {
    text-decoration: none;
    color: inherit;
    font-size: 14px;
    display: flex;
    align-items: center;
    transition: color 0.3s;
    color: $black;
    font-weight: 400;

    @media (max-width: 1024px) {
      font-size: 12px;
    }

    @media (max-width: 767px) {
      font-size: 0;
    }

    &:hover {
      color: $red;
    }

    i {
      font-size: 17px;
      margin-left: 5px;
      color: #aa192f;

      @media (max-width: 1024px) {
        font-size: 15px;
      }
    }
  }
}
</style>
