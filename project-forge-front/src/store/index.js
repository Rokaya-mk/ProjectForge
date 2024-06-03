import { createStore } from 'vuex'
import auth from './auth'
import userModule from './user'
import departmentModule from './department'
import roleModule from './role'
import permissionModule from './permission'
import flash from './flash'
import profileModule from './profile'
import pagination from './pagination'

export default createStore({
  state: {
  },
  getters: {
  },
  mutations: {
  },
  actions: {
  },
  modules: {
    auth: auth,
    user:userModule,
    department : departmentModule,
    role:roleModule,
    permission:permissionModule,
    profile:profileModule,
    flash:flash,
    pagination : pagination
  }
})
