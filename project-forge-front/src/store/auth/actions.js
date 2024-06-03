import axios from 'axios';
export default {
    async singIn({ commit,dispatch }, credential) {
        commit('setError', '');
        try {
            const response = await axios.post('login', credential);
            dispatch('attempt', response.data.token)
        } catch (error) {
            console.log(error)
            if (error.response && error.response.status === 401) {
                commit('setError', 'Invalid username or password');
              } else {
                commit('setError', 'An error occurred. Please try again.');
              }
        }
    },

    async attempt({ commit, state }, token) {
        try {
            if (token) {
                commit('setToken', token);
            }
            if (!state.token) { return; }
            const response = await axios.get('user-profile');
            console.log(response.data)
            console.log('success')
            commit('setUser', response.data);
        } catch (error) {
            console.log(error, 'fail2')
            commit('setToken', null);
            commit('setUser', null);
        }
    },
    // logout user 
    logout({commit}){
        axios.post("logout")
        .then((response) => {
            commit('setToken', null);
            commit('setUser', null);
            localStorage.removeItem('token');
            console.log(
                "user logout successfully:",
                response
            );
        })
        .catch((error) => {
            console.error("Error loging user:", error);
        });
    }








    
}