import axios from "axios";

export default {
  // retreive roles data from api 
  getRoles({commit}) {
    axios
        .get("roles")
        .then((response) => {
            // store data in roles state
            commit('setRole', response.data)
        })
        .catch((error) => {
            if (error.response && error.response.status === 422) { // Validation error
                console.log('yes')
                commit('setErrors', error.response.data.errors);
            } else {
                console.error("Error fetching roles:", error);
            }
        });
    },
    // Search roles
    searchRole({commit}, payload) {
        setTimeout(function() {
            axios.get(`searchRole?${payload.search_type}=${payload.search_value}`).then((response) => {
                commit('setRole', response.data)
            }).catch(err => {
                console.log(err);
            });
        });
    },
    // retreive specific role data from api 
    showRole({commit}, payload) {
      axios
          .get(`roles/${payload}`, payload)
          .then((response) => {
              // store data in role state
              console.log(response.data.data)
              commit('setOneRole', response.data.data)
          })
          .catch((error) => {
                console.error("Error fetching role:", error);
          });
      },
    // store role in db
    storeRole({commit}, payload) {
        axios
            .post("roles", payload)
            .then((response) => {
                console.log(response.data);
            }).catch((error) => {
                if (error.response.status === 422) { // Validation error
                    commit('setErrors', error.response.data.errors);
                } else {
                    console.error("Error storing role:", error);
                }
            });
    },
    // update a role
    updateRole({commit}, payload) {
        axios.put(`roles/${payload.id}`, payload)
            .then((response) => {
                console.log(
                    "role updated successfully:",
                    response.data
                );
            })
            .catch((error) => {
                if (error.response.status === 422) { // Validation error
                    commit('setErrors', error.response.data.errors);
                } else {
                    console.error("Error updating role:", error);
                }
            });
    },
    // delete role from db
    deleteRole({commit}, payload) {
        axios
            .delete("roles/" + payload.id)
            .then((response) => {
                console.log(
                    "role deleted successfully:",
                    response.data
                );
            })
            .catch((error) => {
                console.error("Error deleting role:", error);
            });

    }
}