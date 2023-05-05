<template>
  <div class="menu" @click="closeMenu()">
    <ul>
      <li>
        <router-link to="/"> <i class="fas fa-home"></i>Home </router-link>
      </li>
      <li>
        <router-link :to="{ path: '/calendar/' + $auth.user().id }">
          <i class="far fa-calendar-alt"></i>Mój kalendarz
        </router-link>
      </li>
      <li v-if="$auth.user().roles == 1">
        <router-link to="/users">
          <i class="fas fa-user"></i>Użytkownicy
        </router-link>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: "Menu",
  methods: {
    closeMenu() {
      if (screen.width <= 1024) {
        let dashboard = document.getElementById("dashboard");
        dashboard.classList.toggle("dashboard--full");
      }
    }
  }
};
</script>

<style scoped lang="scss">
@import "../assets/scss/colors";
.menu {
  padding-top: 20px;
  ul {
    list-style-type: none;
    padding: 0;
    margin: 0;

    li {
      margin: 5px 0;

      a {
        font-size: 14px;
        text-decoration: none;
        color: #fff;
        transition: color 0.3s;
        font-weight: 500;
        display: block;
        padding: 10px;
        border-radius: 5px;
        transition: background 0.3s ease-in-out;

        @media (max-width: 1024px) {
          font-size: 16px;
        }

        &.is-active {
          background: $activeMenu;
        }

        &:hover {
          background: $activeMenu;
        }

        i {
          margin-right: 10px;
          font-size: 16px;
          width: 20px;

          @media (max-width: 1024px) {
            width: 30px;
            font-size: 18px;
          }
        }
      }
    }
  }
}
</style>
