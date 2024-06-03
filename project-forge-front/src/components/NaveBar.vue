<!-- src/components/Navbar.vue -->
<template>
    <nav v-if="authenticated" class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <button type="button" id="sidebarCollapse" class="btn btn-primary" @click="toggleSidebar">
          <i class="fa fa-bars"></i>
          <span class="sr-only">Toggle Menu</span>
        </button>
        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" id="navCollapse" @click="toggleNav">
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="nav navbar-nav ml-auto">
            <li class="nav-item active">
              <router-link :to="{name: 'profile'} ">Settings</router-link>
            </li>
            <li class="nav-item">
              <a class="nav-link" style="cursor: pointer;" @click="logout()">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </template>
  
  <script>
  import { mapActions, mapGetters } from 'vuex';
  
  export default {
    computed: {
      ...mapGetters({
        'authenticated' : 'auth/authenticated',
      })
    },
    methods: {
        ...mapActions({
            'singnout' : 'auth/logout'
        }),
      toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('active');
      },
      toggleNav() {
        document.getElementById('navbarSupportedContent').classList.toggle('show');
      },
      logout(){
            this.singnout().then(() => this.$router.push({ path: "/login" }))
        }
    }
  };
  </script>
  