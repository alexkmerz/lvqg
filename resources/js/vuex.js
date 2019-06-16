import Vue from 'vue';
import Vuex from 'vuex';
import VuexPersistence from 'vuex-persist';
import axios from 'axios';

Vue.use(Vuex);

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
    plugins: [vuexPersist.plugin],
    actions: {}
});

export default store;