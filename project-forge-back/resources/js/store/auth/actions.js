
export default {
    async singIn({ dispatch }, credential) {
        try {
            const response = await axios.post('login', credential);
            dispatch('attempt', response.data.access_token)
        } catch (error) {
            console.log(error)
        }
    },

    async attempt({ commit, state }, token) {
        try {
            if (token) {
                commit('setToken', token);
            }
            if (!state.token) { return; }
            const response = await axios.get('user-profile');
            commit('setUser', response.data);
            console.log('success')
        } catch (error) {
            console.log(error, 'fail2')
            commit('setToken', null);
            commit('setUser', null);
        }
    },
    singnOut({ commit }) {
        return axios.post('logout').then(() => {
            console.log("yes")
            commit('setToken', null);
            commit('setUser', null);
        })
    }








    
}