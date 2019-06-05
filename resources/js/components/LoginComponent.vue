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
            login() {
                axios.post('/login', {
                    email: this.email,
                    password: this.password
                })
                .then((response) => {
                    console.log(response.data.data.token);

                    let config = {
                        headers: {'Authorization': "bearer " + response.data.data.token}
                    };

                    this.test(config);
                });
            },
            register() {
                axios.post('/register', {
                    email: this.email,
                    password: this.password
                }).then((response) => {
                    console.log(response);
                });
            },
            test(config) {
                axios.get('/api/hello', config)
                    .then((response) => {
                        console.log(response);
                    })
            }
        }
    }
</script>