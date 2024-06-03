<!-- src/components/Sidebar.vue -->
<template>
    <nav v-if="authenticated" id="sidebar">
      <div class="p-4 pt-5">
        <a href="#" class="img logo rounded-circle mb-5" 
            :style="{backgroundImage: 'url('+require('@/assets/sidebar/images/tasks.png')+')'}"
            ></a>
        <ul class="list-unstyled components mb-5">
          <li v-if="hasRole('admin')" :class="{ active: isManagementActive }">
            <a href="#homeSubmenu" @click="toggleManagement" aria-expanded="false">
              Management
              <i class="fa fa-angle-down"></i>
            </a>
            <ul class="collapse list-unstyled" :class="{ show: isManagementActive }" id="homeSubmenu">
              <li v-if="userPermissions.has('departments-read')" :class="{ active: isDepartmentsActive }">
                <router-link :to="{name: 'departments'} ">Departments</router-link>
              </li>
              <li v-if="userPermissions.has('users-read')" :class="{ active: isUsersActive }">
                <router-link :to="{name: 'users'} ">Users</router-link>
              </li>
              <li v-if="userPermissions.has('roles-read')">
                <router-link :to="{name: 'roles'} ">Roles</router-link>
              </li>
              <li v-if="userPermissions.has('permissions-read')">
                <router-link :to="{name: 'permissions'} ">Permissions</router-link>
              </li>
            </ul>
          </li>
          <li>
            <router-link to="">Tasks Inbox</router-link>
          </li>
        </ul>
        <div class="footer">
          <p>
            &copy; 2024 All rights reserved | Made with <i class="icon-heart" aria-hidden="true"></i> by <a href="#">rqia</a>
          </p>
        </div>
      </div>
    </nav>
  </template>
  
  <script>
  import $ from 'jquery';
  import 'bootstrap';
  import '@/assets/sidebar/js/main'; // Import your custom script
import { mapGetters, mapActions } from "vuex";

  export default {
    data() {
      return {
        isManagementActive: false,
      };
    },
    computed: {
       /* access to getter with mapgetter 
        departments : to get departments list
        userRoles : verify roles of this authenticated user 
        userPermissions : get the permissions of this user
        authenticated :  verify user authentication
        */
        ...mapGetters({     
            authenticated : 'auth/authenticated',        
            userRoles : 'user/userRoles',
            userPermissions : 'user/userPermissions',
        }),
      isDepartmentsActive() {
        return this.$route.path === '/departments';
      },
      isUsersActive() {
        return this.$route.path === '/users';
      }
    },
    mounted() {
      if(this.authenticated){
        this.$store.dispatch('user/getUserRolesPermissions');
      }
      
    },
    methods: {
      toggleManagement() {
        this.isManagementActive = !this.isManagementActive;
      },
    hasRole(role) {
       return this.userRoles.has(role);
    }
    }
  };
  </script>
  
  <style scoped>
  @import "~@/assets/sidebar/css/style.css";
  </style>
  