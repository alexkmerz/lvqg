<template>
    <div class="dashboard">
        <div>
            <input v-model="url" type="text"><button @click="cloneRepository()">Clone</button>
        </div>

        <div class="repositories">
            <div class="repository" v-for="repository in repositories" @click="openRepository(repository.id)">
                {{repository}}
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                url: '',
                repositories: []
            }
        },
        mounted() {
            //Request all git repositories
            axios.get('/api/repository', {
                headers: {
                    Authorization: 'Bearer ' + this.$store.state.jwt_token
                }
            }).then((response) => {
                this.repositories = response.data.repositories;
            });
        },
        methods: {
            openRepository(id) {
                this.$router.push('/repository/'+id);
            },
            cloneRepository() {
                axios.post('/api/repository/clone', {
                        url: this.url
                    },
                    {
                        headers: {
                            Authorization: 'Bearer ' + this.$store.state.jwt_token
                        }
                    })
                    .then((response) => {
                        console.log(response);
                    });
            }
        }
    }
</script>

<style scoped>

</style>