import Vue from 'vue';
import VueRouter from 'vue-router';
import store from './vuex';

Vue.use(VueRouter);

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
        { path: '/repository/:id', component: Repository }
    ]
});

//Check user a jwt token
router.beforeEach((to, from, next) => {
    if(store.state.jwt_token) {
        next();
    } else {
        next('login');
    }
});

export default router;