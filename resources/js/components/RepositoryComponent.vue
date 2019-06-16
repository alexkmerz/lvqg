<template>
    <div class="repository">
        Hello
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                directoryStructure: []
            }
        },
        mounted() {
            //Request all git repositories
            axios.get('/api/repository/'+this.$route.params.id, {
                headers: {
                    Authorization: 'Bearer ' + this.$store.state.jwt_token
                }
            }).then((response) => {
                console.log(response);
            });
        },
        methods: {

        }
    }
</script>

<style scoped>

</style>