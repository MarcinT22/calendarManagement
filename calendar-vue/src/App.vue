<template>
    <div>
        <template v-if="$auth.check()">
            <div class="dashboard" id="dashboard">
                <div class="dashboard__left">
                    <div class="dashboard__header">
                        <h1>
                            <router-link to="/">
                                <i class="far fa-calendar-alt"></i> E-Calendar
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
        name: 'App',
        components: {Menu, Top},
    }
</script>

<style lang="scss">
    html, body {
        padding: 0;
        margin: 0;
    }
</style>
<style lang="scss">
    @import "assets/scss/fonts";
    @import "assets/scss/fontawesome";
    @import "assets/scss/style";

    .dashboard {
        display: flex;
        justify-content: flex-end;

        &--full{
            .dashboard{
                &__left{
                    left:-250px;

                    @media (max-width:1024px)
                    {
                        left:0;
                    }
                }

                &__container{
                    width:100%;

                    @media (max-width:1024px)
                    {
                        width: calc(100% - 250px);
                    }
                }
            }
        }

        &__left {
            width: 250px;
            position: fixed;
            left: 0;
            top: 0;
            background: #0a699a;
            bottom: 0;
            padding: 15px;
            box-sizing: border-box;
            transition:left 0.3s ease-in-out;

            @media (max-width:1024px)
            {
                left:-250px;
            }

        }

        &__container {
            width: calc(100% - 250px);
            transition:width 0.3s ease-in-out;
            @media (max-width:1024px)
            {
                width:100%;
            }
        }

        &__content {
            padding: 15px;
            box-sizing: border-box;


            @media (max-width:1024px)
            {
                padding:10px;
            }

        }

        &__header {
            padding-bottom: 5px;

            h1 {
                margin: 0;
                color: #fff;
                font-family: Bitter;
                font-size: 28px;
                text-shadow: 2px 2px 2px #555;

                a{
                    color:inherit;
                    text-decoration: none;
                }

                i {
                    margin-right: 10px;
                }
            }
        }

    }

</style>
