export default {
    users(state){
        return state.users
    },
    userRoles(state) {
        return state.userRoles
    },
    userPermissions(state) {
        return state.userPermissions
    },
    roles(state){
        return state.filteredRoles
    },
    permissions(state){
        return state.filteredPermissions
    },
    permissionsCategory(state){
        return state.filteredPermissionsCategory
    },
}