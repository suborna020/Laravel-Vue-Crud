import Axios from "axios"
import { data } from "jquery";
export const admin = {
    namespaced: true,
    state: {
        admin: {}
    },
    getters: {
        getAuthUser(state) {
            return state.admin;
        },

    },
    actions: {
        getUser(context) {
            Axios.get('/admin/user')
                .then((result) => {
                    context.commit('getUser', result.data.admin)
                    // data.admin eta diye routing kore admin auth info anbo 
                }).catch((err) => {

                });
        },
        // userLogout(context) {
        //     Axios.post('/logout')
        //         .then(res => {
        //             context.commit('getUser', res.data)
        //         })
        // },

    },
    mutations: {
        getUser(state, payload) {
            return state.admin = payload
        },
    },

}