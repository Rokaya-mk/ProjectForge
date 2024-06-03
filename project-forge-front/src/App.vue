<template>
  <div class="wrapper d-flex align-items-stretch" id="app">
    <Sidebar />
    <div id="content" class="p-4 p-md-5">
      <Navbar />
      <router-view></router-view>
    </div>
  </div>
</template>
<script>
import Sidebar from './components/SideBar.vue';
import Navbar from './components/NaveBar.vue';
export default {
  components: {
    Sidebar,
    Navbar
  }
};

</script>
<style>
</style>
