import Vue from 'vue'
import Vuex from 'vuex'

// Register vuex
Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        theme: {
                name: null,
                img: null
        },
    },
    mutations: {
        setTheme (state, theme) {
            state.theme = theme;
        }
    }
});
