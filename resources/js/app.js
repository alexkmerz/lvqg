import Vue from 'vue';

import navbar from './components/NavbarComponent.vue';

import router from './router';
import store from './vuex';

new Vue({
    router,
    store,
    components: { navbar },
}).$mount('#app');