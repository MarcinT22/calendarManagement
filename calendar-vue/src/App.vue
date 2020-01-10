<template>
    <div>
        <template v-if="$auth.check()">
            <div class="dashboard">
                <div class="dashboard__left">
                    <div class="dashboard__header">
                        <h1>
                            <router-link to="/">
                                <i class="far fa-calendar-alt"></i> E-Calendar
                            </router-link>
                        </h1>
                    </div>
                    <Menu></Menu>
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

        &__left {
            width: 250px;
            position: fixed;
            left: 0;
            top: 0;
            background: #0a699a;
            bottom: 0;
            padding: 15px;
            box-sizing: border-box;

        }

        &__container {
            width: calc(100% - 250px);


        }

        &__content {
            padding: 15px;
            box-sizing: border-box;

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
