export default{
    setRole(state, payload) {
        state.roles = payload
    },
    setOneRole(state, payload) {
        state.role = payload
    },
    setErrors(state, error) {
        state.error = error;
    }
    
}