import Vue from 'vue';
import Vuex from 'vuex';
import VueRouter from 'vue-router';
import VuexPersistence from 'vuex-persist';

Vue.use(VueRouter);
Vue.use(Vuex);

import navbar from './components/NavbarComponent.vue';

import Home from './components/HomeComponent.vue';
import Login from './components/LoginComponent.vue';
import Dashboard from './components/DashboardComponent.vue';
import Repository from './components/RepositoryComponent.vue';

const router = new VueRouter({
    mode: 'history',
    base: '/',
    routes: [
        { path: '/', component: Home },
        { path: '/login', component: Login },
        { path: '/dashboard', component: Dashboard },
        { path: '/repository/{id}', component: Repository }
    ]
});

const vuexPersist = new VuexPersistence({
    storage: window.localStorage
});

const store = new Vuex.Store({
    state: {
        jwt_token: ''
    },
    mutations: {
        setJwtToken(state, jwt_token) {
            state.jwt_token = jwt_token;
        }
    },
    plugins: [vuexPersist.plugin]
});

new Vue({
    router,
    store,
    components: { navbar },
}).$mount('#app');