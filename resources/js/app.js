import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import navbar from './components/NavbarComponent.vue';

import Home from './components/HomeComponent.vue';
import Login from './components/LoginComponent.vue';

const router = new VueRouter({
    mode: 'history',
    base: '/',
    routes: [
        {path: '/', component: Home},
        {path: '/login', component: Login}
    ]
});

new Vue({
    router,
    components: { navbar },
}).$mount('#app');