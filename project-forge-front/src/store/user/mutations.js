export default {
  setUsers(state, payload) {
    state.users = payload;    
  },
  setUserRoles(state, roles) {

    state.userRoles = new Set();
    roles.forEach(role => {
        state.userRoles.add(role.name)
    });
  },
  setUserPermissions(state, permissions) {
      state.userPermissions = new Set();
      permissions.forEach(permission => {
          state.userPermissions.add(permission.name)
      });

  },
  setRoles(state,roles){
    state.filteredRoles = [];
    state.filteredRoles = roles
  },
  setPermissions(state,permissions){
    state.filteredPermissions = [];
    state.filteredPermissionsCategory = [];
    let items = []
    permissions.forEach(element => {
        items.push({
            value: element.id,
            label: element.name
        })
    });
    state.filteredPermissions = items
    permissions.forEach(permission => {
      let str = permission.name.split('-');
      state.filteredPermissionsCategory.push(str[0])
    });
    state.filteredPermissionsCategory = [...new Set(state.filteredPermissionsCategory)]
  },
 

}