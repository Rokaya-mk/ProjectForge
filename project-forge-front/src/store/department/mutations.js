export default{
    setDepartment(state, payload) {
        state.departments = payload
    },
    setErrors(state, error) {
        state.error = error;
    },
    setFilteredDepartments(state,filteredDepartments){
        state.filteredDepartments = filteredDepartments;
    }
    
}