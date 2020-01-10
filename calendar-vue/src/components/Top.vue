<template>
        <div class="top">
            <div class="top__user">
                <i class="fas fa-user"></i> {{$auth.user().name}}
            </div>
            <a href="#" @click.prevent="logout" class="top__logout">
                 Wyloguj <i class="fas fa-power-off"></i>
            </a>
        </div>
</template>

<script>
    export default {
        name: "Top",
        methods:{
            logout(){
                this.$auth.logout({
                    redirect: '/login',
                });
            }
        }
    }

</script>

<style scoped lang="scss">
    .top{
        display: flex;
        justify-content: flex-end;
        align-items: center;
        padding:10px 15px;
        box-shadow:0 0 5px rgba(100,100,100,0.2);
        background:#fff;


        &__user{
            margin-right:50px;
            font-size:14px;
            display: flex;
            align-items: center;
            color:#333;
            font-weight: bold;

            i{
                font-size:17px;
                margin-right:5px;
                color: #0a699a;
            }
        }

        &__logout{
            text-decoration: none;
            color:inherit;
            font-size:14px;
            display: flex;
            align-items: center;
            transition:color 0.3s;
            color:#333;
            font-weight: bold;
            &:hover{
                 color: #aa192f;
            }


            i{
                font-size:17px;
                margin-left:5px;
                color: #aa192f;
            }
        }
    }
</style>
