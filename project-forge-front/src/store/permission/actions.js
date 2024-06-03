import axios from "axios";

export default {
  // retreive permissions data from api 
  async getPermissions({commit},page = 1) {
    await axios
        .get(`permissions?page=${page}`)
        .then((response) => {
            // store data in permissions state
            commit('setPermissions', response.data)
            commit('pagination/SET_PAGINATION', response.data.meta, { root: true }); 
        })
        .catch((error) => {
            if (error.response && error.response.status === 422) { // Validation error
                console.log('yes')
                commit('setErrors', error.response.data.errors);
            } else {
                console.error("Error fetching permission:", error);
            }
        });
    },
     // Search permission
     searchPermission({commit}, payload) {
        setTimeout(function() {
            axios.get(`permissions/searchPermission?${payload.search_type}=${payload.search_value}`).then((response) => {
                commit('setPermissions', response.data)
            }).catch(err => {
                console.log(err);
            });
        });
    },
    // retreive specific permission data from api 
    showPermission({commit}, payload) {
      axios
          .get(`permissions/${payload}`, payload)
          .then((response) => {
              // store data in permission state
              console.log(response.data.data)
              commit('setOnePermission', response.data.data)
          })
          .catch((error) => {
                console.error("Error fetching permission:", error);
          });
      },
    // store permission in db
    storePermission({commit}, payload) {
        axios
            .post("permissions", payload)
            .then((response) => {
                console.log(response);
            }).catch((error) => {
                if (error.response.status === 422) { // Validation error
                    commit('setErrors', error.response.data.errors);
                } else {
                    console.error("Error storing permission:", error);
                }
            });
    },
    // update a permission
    updatePermission({commit}, payload) {
        axios.put(`permissions/${payload.id}`, payload)
            .then((response) => {
                console.log(
                    "permission updated successfully:",
                    response.data
                );
            })
            .catch((error) => {
                if (error.response.status === 422) { 
                    // Validation error
                    commit('setErrors', error.response.data.errors);
                } else {
                    console.error("Error updating permission:", error);
                }
            });
    },
    // delete permission from db
    deletePermission(_, payload) {
        axios
            .delete("permissions/" + payload.id)
            .then((response) => {
                console.log(
                    "permission deleted successfully:",
                    response.data
                );
            })
            .catch((error) => {
                console.error("Error deleting permission:", error);
            });

    }
}