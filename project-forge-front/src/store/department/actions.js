import axios from "axios";

export default {
  // retreive departments data from api 
  getDepartments({commit,state}) {
    axios
        .get("departments")
        .then((response) => {
            state.filteredDepartments = [];
            // store data in departments state
            // commit('setDepartment', response.data)
            commit('setDepartment', response.data)
            // console.log(response.data.data)
            var items = []
            response.data.data.forEach(element => {
                items.push({
                    value: element.id,
                    label: element.name
                })
            });
            commit('setFilteredDepartments', items)
            
        })
        .catch((error) => {
            if (error.response && error.response.status === 422) { // Validation error
                console.log('yes')
                commit('setErrors', error.response.data.errors);
            } else {
                console.error("Error fetching departments:", error);
            }
        });
    },
    // Search departments
    searchDepartment({commit}, payload) {
        setTimeout(function() {
            axios.get(`departments/searchDepartment?${payload.search_type}=${payload.search_value}`).then((response) => {
                commit('setDepartment', response.data)
            }).catch(err => {
                console.log(err);
            });
        });
    },
    // store department in db
    storeDepartment({commit}, payload) {
        axios
            .post("departments", payload)
            .then((response) => {
                console.log(response.data);
            }).catch((error) => {
                if (error.response.status === 422) { // Validation error
                    commit('setErrors', error.response.data.errors);
                } else {
                    console.error("Error storing department:", error);
                }
            });
    },
    // update a department
    updateDepartment({commit}, payload) {
        axios.put(`departments/${payload.id}`, payload)
            .then((response) => {
                console.log(
                    "department updated successfully:",
                    response.data
                );
                // context.dispatch('departments')
                // this.closeModal();
            })
            .catch((error) => {
                if (error.response.status === 422) { // Validation error
                    commit('setErrors', error.response.data.errors);
                } else {
                    console.error("Error updating department:", error);
                }
            });
    },
    // delete department from db
    deleteDepartment({commit}, payload) {
        axios
            .delete("departments/" + payload.id)
            .then((response) => {
                console.log(
                    "department deleted successfully:",
                    response.data
                );
            })
            .catch((error) => {
                console.error("Error deleting department:", error);
            });

    }
}