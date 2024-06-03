import roleGetters from './getters';
import roleMutations from './mutations';
import roleActions from './actions';
export default {
    namespaced : true,
   state:{
    //  permission list variable 
    permission: {},
    permission:null,
    errors: null,
     },
     getters :roleGetters ,
     mutations : roleMutations ,
     actions : roleActions
}