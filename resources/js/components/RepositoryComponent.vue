<template>
    <div class="repository">

    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {

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

        }
    }
</script>

<style scoped>

</style>