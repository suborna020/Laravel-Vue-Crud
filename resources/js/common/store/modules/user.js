import Axios from "axios";

export const user = {
    // later we will import it on store.js , using vuex, for data store perpose
    namespaced: true,
    state: {
        user: []
    },
    getters: {
        getUsersData(state) {
            return state.user;
        }
    },
    actions: {
        getUser(context) {
            Axios.get("candidate")
                .then(result => {
                    console.log("from user js : ", result.data.user);

                    context.commit("getUser", result.data.user);

                    //  result.data.user er  .user= publicHeader-> computed->user() function
                    // maxtime  ( result.data.user ) er user ta controller theke returned response o hote pare
                })
                .catch(err => {});
        }
    },
    mutations: {
        getUser(state, payload) {
            return (state.user = payload);
        }
    }
};
