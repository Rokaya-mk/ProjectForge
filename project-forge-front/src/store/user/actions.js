import axios from "axios";

export default{
    // get users list
  getUsers({commit,state}) {
    axios
        .get("users")
        .then((response) => {
            commit('setUsers', response.data)
        })
        .catch((error) => {
            console.error("Error fetching users:", error);
        });
    },
    // Search users
    searchUser({commit}, payload) {
        setTimeout(function() {
            axios.get(`users/searchUser?${payload.search_type}=${payload.search_value}`).then((response) => {
                commit('setUsers', response.data)
            }).catch(err => {
                console.log(err);
            });
        });
    },
  // retreive auth user roles/permissions data from api 
  getUserRolesPermissions({commit,state}) {
    axios
        .get("users/userRolesPermissions")
        .then((response) => {
            commit('setUserRoles', response.data.roles);
            commit('setUserPermissions', response.data.permissions);
            
        })
        .catch((error) => {
                console.error("Error fetching userRolesPermissions:", error);
        });
    },
    // get all roles 
    getAllRoles({commit}){
        axios.get("users/roles")
        .then((response) => {
            var items = []
            response.data.data.forEach(element => {
                items.push({
                    value: element.id,
                    label: element.name
                })
            });
            commit('setRoles',items)
        })
        .catch((error) => {
            console.error("Error fetching roles:", error);
        });
    },
    // get all permissions 
    getAllPermissions({commit}){
        axios.get("users/permissions")
        .then((response) => {
            
            commit('setPermissions',response.data.data)
        })
        .catch((error) => {
            console.error("Error fetching permissions:", error);
        });
    },
    // store data in api 
    // store department in db
    storeUser({commit}, payload) {
        console.log(payload)
        axios
            .post("users", payload)
            .then((response) => {
                console.log(response);
            }).catch((error) => {
                console.error("Error storing user:", error);
            });
    },
     // update a user
     updateUser({commit}, payload) {
        console.log(payload)
        axios.put(`users/${payload.id}`, payload)
            .then((response) => {
                console.log(
                    "user updated successfully:",
                    response.data
                );
            })
            .catch((error) => {
                console.error("Error updating user:", error);
                
            });
    },
    // delete user from db
    deleteUser({commit}, payload) {
        axios
            .delete("users/" + payload.id)
            .then((response) => {
                console.log(
                    "user deleted successfully:",
                    response.data
                );
            })
            .catch((error) => {
                console.error("Error deleting user:", error);
            });

    }
}