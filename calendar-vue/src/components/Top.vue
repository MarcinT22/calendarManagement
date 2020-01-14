<template>
    <div class="top">
        <div class="top__bars" @click="fullDashboard">
            <i class="fas fa-bars"></i>
        </div>
        <div class="top__nav">
            <div class="top__user">
                <i class="fas fa-user"></i> {{$auth.user().name}}
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
                    redirect: '/login',
                });
            },
            fullDashboard(){
                let dashboard = document.getElementById('dashboard');
                dashboard.classList.toggle('dashboard--full')
            }
        }
    }

</script>

<style scoped lang="scss">
    .top {
        display: flex;

        align-items: center;
        padding: 8px 15px;
        box-shadow: 0 0 5px rgba(100, 100, 100, 0.2);
        background: #fff;

        &__bars{
            cursor:pointer;
            font-size:18px;
            color:#0a699a;
            transition:color 0.3s;
            &:hover{
                color:#333;
            }
        }

        &__nav{
            width: 100%;
            display: flex;
            justify-content: flex-end;
        }


        &__user {
            margin-right: 50px;
            font-size: 14px;
            display: flex;
            align-items: center;
            color: #333;
            font-weight: bold;

            @media (max-width:1024px)
            {
               font-size:12px;
            }

            i {
                font-size: 17px;
                margin-right: 5px;
                color: #0a699a;

                @media (max-width:1024px)
                {
                    font-size:15px;
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
            color: #333;
            font-weight: bold;

            @media (max-width:1024px)
            {
                font-size:12px;
            }

            &:hover {
                color: #aa192f;
            }


            i {
                font-size: 17px;
                margin-left: 5px;
                color: #aa192f;

                @media (max-width:1024px)
                {
                    font-size:15px;
                }
            }
        }
    }
</style>
