import departmentGetters from './getters';
import departmentMutations from './mutations';
import departmentActions from './actions';
export default {
    namespaced : true,
   state:{
    //  department list variable 
    departments: {},
    errors: null,
    filteredDepartments:[]
     },
     getters :departmentGetters ,
     mutations : departmentMutations ,
     actions : departmentActions
}