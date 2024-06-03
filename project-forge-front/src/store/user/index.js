import userGetters from './getters';
import userMutations from './mutations';
import userActions from './actions';
export default {
     namespaced : true,
   state:{
      //  auth list variable 
      users : {},
      userRoles : new Set(),
      userPermissions : new Set(),
      filteredRoles:[],
      filteredPermissions:[],
      filteredPermissionsCategory:[]
     },
     getters : userGetters,
     mutations : userMutations,
     actions :userActions
}