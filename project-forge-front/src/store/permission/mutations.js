export default{
    setPermissions(state, payload) {
        state.permissions = payload

    },
    setOnePermission(state, payload) {
        state.permission = payload
    },
    setErrors(state, error) {
        state.error = error;
    }
    
}