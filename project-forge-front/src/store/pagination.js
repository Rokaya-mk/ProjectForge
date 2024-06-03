export default {
    namespaced: true,
    state: {
        pagination: {
          current_page: 1,
          last_page: 1,
          per_page: 15,
          total: 0
        }
      },
      getters:{
        pagination(state){
            return state.pagination
        }
      },
      mutations:{
        SET_PAGINATION(state, pagination) {
            state.pagination = {
              current_page: pagination.current_page,
              last_page: pagination.last_page,
              per_page: pagination.per_page,
              total: pagination.total
            };
          }
      },
      actions:{
        
      },
  };

  
  