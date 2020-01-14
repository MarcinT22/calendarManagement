<template>
    <div class="block">
        <div class="block__actions">
            <router-link to="/register" class="block__button block__button--add">
                <i class="fas fa-user-plus"></i> Nowy użytkownik
            </router-link>
        </div>
        <div class="loading loading--center" v-if="isLoading"></div>
        <div v-if="!isLoading">
            <table>
                <tr>
                    <th>
                        Nazwa użytkownika
                    </th>
                    <th>
                        E-mail
                    </th>
                    <th>
                        Admin
                    </th>
                    <th>
                        Akcje
                    </th>
                </tr>
                <tr v-for="user in users">
                    <td>{{user.name}}</td><td>{{user.email}}</td>
                    <td class="roles">
                        <div v-if="user.roles == 1" class="true">
                            <i class="fas fa-check"></i>
                        </div>
                        <div v-else class="false">
                            <i class="fas fa-times"></i>
                        </div>
                    </td>
                    <td>
                        <div class="block__buttons">
                            <router-link :to="{path:'/calendar/'+user.id}" class="block__button block__button--calendar block__button--withoutText" title="Kalendarz">
                                <i class="far fa-calendar-alt"></i>
                            </router-link>
                            <a @click.prevent="deleteUser(user.id)" class="block__button block__button--trash block__button--withoutText" title="Usuń">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        name: "Users",
        data() {
            return {
                users: [],
                isLoading: true,
            }
        },

        methods:{
            getUsers()
            {
                axios.get('/users/')
                    .then(response => {
                        this.users = response.data;
                        this.isLoading = false
                    })
                    .catch(e => {
                        alert('error')
                    })
            },
            deleteUser(user){
                this.isLoading=true
                this.users=[]
                axios.delete('/user/' + user)
                    .then((response) => {
                        this.getUsers()
                        setTimeout(() => {
                            this.$alertify.success('Usunięto użytkownika');
                            this.isLoading=false
                        }, 500);

                    })
                    .catch((e) => {
                        this.$alertify.error('Nie usunięto wpisu');
                    })
            }
        },
        created() {
            this.getUsers()
        },
    }
</script>

<style scoped lang="scss">
    @import '../assets/scss/block';
</style>
