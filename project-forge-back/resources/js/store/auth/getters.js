export default {
    // verify authentication
    authenticated(state) {
        return state.token && state.user;
    },
    // get the user
    user(state) {
        return state.user;
    }
}