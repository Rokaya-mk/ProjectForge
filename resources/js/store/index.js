import { createStore } from "vuex";
import departmentModule from "./department"
import authModule from "./auth"
import userModule from "./user"

export default createStore({
    // state: {
    //     departments: {},
    //     error: null
    // },
    // getters: {
    //     departments(state) {
    //         return state.departments
    //     }
    // },
    // mutations: {
    //     setDepartment(state, payload) {
    //         state.departments = payload
    //     },
    //     setErrors(state, error) {
    //         state.error = error;
    //     }
    // },
    // actions: {
    //     // retreive departments data from api 
    //     getDepartments(context) {
    //         axios
    //             .get("departments")
    //             .then((response) => {
    //                 // store data in departments state
    //                 // commit('setDepartment', response.data)
    //                 context.commit('setDepartment', response.data)
    //                 // console.log(response.data);
    //             })
    //             .catch((error) => {
    //                 if (error.response.status === 422) { // Validation error
    //                     console.log('yes')
    //                     context.commit('setErrors', error.response.data.errors);
    //                 } else {
    //                     console.error("Error fetching departments:", error);
    //                 }
    //             });
    //     },
    //     // store department in db
    //     storeDepartment(context, payload) {
    //         axios
    //             .post("departments", payload)
    //             .then((response) => {
    //                 console.log(response.data);
    //             }).catch((error) => {
    //                 if (error.response.status === 422) { // Validation error
    //                     context.commit('setErrors', error.response.data.errors);
    //                 } else {

    //                     console.error("Error storing department:", error);
    //                 }
    //             });
    //     },
    //     // update a department
    //     updateDepartment(context, payload) {
    //         axios.put(`departments/${payload.id}`, payload)
    //             .then((response) => {
    //                 console.log(
    //                     "department updated successfully:",
    //                     response.data
    //                 );
    //                 // context.dispatch('departments')
    //                 // this.closeModal();
    //             })
    //             .catch((error) => {
    //                 if (error.response.status === 422) { // Validation error
    //                     context.commit('setErrors', error.response.data.errors);
    //                 } else {
    //                     console.error("Error updating department:", error);
    //                 }
    //             });
    //     },
    //     // delete department from db
    //     deleteDepartment(context, payload) {
    //         axios
    //             .delete("departments/" + payload.id)
    //             .then((response) => {
    //                 console.log(
    //                     "department deleted successfully:",
    //                     response.data
    //                 );
    //             })
    //             .catch((error) => {
    //                 console.error("Error deleting department:", error);
    //             });

    //     }
    // },
    modules: {
        department : departmentModule,
        auth : authModule,
        user : userModule,
      }
})