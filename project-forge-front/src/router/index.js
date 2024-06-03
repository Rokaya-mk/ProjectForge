import { createRouter, createWebHistory } from 'vue-router'
import Dashboard from '../views/Dashboard.vue'
import Singin from '../views/auth/Login.vue'
import Departments from '../views/managment/departments/index.vue'
import Users from '../views/managment/users/index.vue'
import Roles from '../views/managment/roles/index.vue'
import Permission from '../views/managment/permissions/index.vue'
import createRole from '../views/managment/roles/create.vue'
import editRole from '../views/managment/roles/edit.vue'
import createPermission from '../views/managment/permissions/create.vue'
import editPermission from '../views/managment/permissions/edit.vue'
import Profile from '../views/managment/profile/index.vue'
import store from '@/store'

const routes = [
  {
    path: '/',
    name: 'dashboard',
    component: Dashboard,
    
  },
  {
    path: '/departments',
    name: 'departments',
    component: Departments,
  },
  {
    path: '/users',
    name: 'users',
    component: Users,
  },
  {
    path: '/roles',
    name: 'roles',
    component: Roles,
  },
  {
    path: '/roles/create',
    name: 'create-role',
    component: createRole,
  },
  {
    path: '/roles/edit/:id',
    name: 'edit-role',
    component: editRole,
  },
  {
    path: '/permissions',
    name: 'permissions',
    component: Permission,
  },
  {
    path: '/permissions/create',
    name: 'create-permission',
    component: createPermission,
  },
  {
    path: '/permissions/edit/:id',
    name: 'edit-permission',
    component: editPermission,
  },
  {
    path: '/login',
    name: 'Singin',
    component: Singin,
    
  },
  {
    path: '/profile',
    name: 'profile',
    component: Profile,
    
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})


export default router
