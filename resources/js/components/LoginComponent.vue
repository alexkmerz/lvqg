<template>
    <div>
        <div>
            <label>email</label>
            <input v-model="email" type="text">
        </div>

        <div>
            <label>password</label>
            <input v-model="password" type="password">
        </div>

        <div>
            <button @click="login">Login</button>
            <button @click="register">Register</button>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                email: '',
                password: ''
            }
        },
        mounted() {

        },
        methods: {
            /**
             * Gets a jwt token from Lumen using email password combo
             */
            login() {
                axios.post('/login', {
                    email: this.email,
                    password: this.password
                })
                .then((response) => {
                    //Store token and navigate to dashboard
                    this.$store.commit('setJwtToken', response.data.token);
                    this.$router.push('/dashboard');
                });
            },
            /**
             * Registers a user with Lumen
             */
            register() {
                axios.post('/register', {
                    email: this.email,
                    password: this.password
                }).then((response) => {
                    console.log(response);
                });
            }
        }
    }
</script>