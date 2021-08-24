import Vue from "vue";
import Vuex from "vuex";
Vue.use(Vuex);
// constractor value import a {} use korte hoy must
import { user } from "./modules/user";

export const store = new Vuex.Store({
    modules: {
        user: user
    }
});
