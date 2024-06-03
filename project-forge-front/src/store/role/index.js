import roleGetters from './getters';
import roleMutations from './mutations';
import roleActions from './actions';
export default {
    namespaced : true,
   state:{
    //  role list variable 
    roles: {},
    role:null,
    errors: null,
     },
     getters :roleGetters ,
     mutations : roleMutations ,
     actions : roleActions
}