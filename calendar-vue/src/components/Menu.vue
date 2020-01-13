<template>
    <div class="menu">
        <ul>
            <li>
                <router-link to="/">
                    <i class="fas fa-home"></i> Home
                </router-link>
            </li>
            <li>
                <router-link :to="{path:'/calendar/'+$auth.user().calendar_id}">
                    <i class="far fa-calendar-alt"></i> Kalendarz
                </router-link>
            </li>
            <li  v-if="$auth.user().roles == 1">
                <router-link to="/users">
                    <i class="fas fa-user"></i>Użytkownicy
                </router-link>
            </li>
        </ul>

    </div>
</template>

<script>
    export default {
        name: "Menu"
    }
</script>

<style scoped lang="scss">
    .menu{
        padding-top:20px;
        ul{
            list-style-type: none;
            padding:0;
            margin:0;

            li{
               margin:10px 0;
                border-bottom:1px solid #08557b;
                padding-bottom:10px;

                a{

                    font-size:14px;
                    text-decoration: none;
                    color:#fff;
                    transition:color 0.3s;
                    font-weight: 600;

                    &.is-active{
                        color:#030a20;
                    }

                    &:hover{
                        color: #030a20;
                    }

                    i{
                        margin-right:10px;
                        font-size:16px;
                        width:20px;
                    }
                }
            }
        }
    }
</style>
