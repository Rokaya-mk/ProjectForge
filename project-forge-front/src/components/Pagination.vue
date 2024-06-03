<!-- components/Pagination.vue -->
<template>
  <div class="row ">
    <div class="col-md-12">
      <nav v-if="pagination.total > pagination.per_page" aria-label="Page navigation example ">
        <ul class="pagination  pagination-md d-flex justify-content-center">
          <li class="page-item">
            <a class="page-link" @click="changePage(pagination.current_page - 1)" :disabled="pagination.current_page === 1">Previous</a>
          </li>
          <li class="page-item">
            <a class="page-link active">{{ pagination.current_page }}</a>
          </li>
          <li class="page-item" v-if="pagination.current_page !== pagination.last_page">
            <a class="page-link" @click="changePage(pagination.current_page +1 )">{{ pagination.current_page +1 }}</a>
          </li>
          <li :class="`page-item ${pagination.current_page === pagination.last_page ? 'disabled' : ''}`">
            <a class="page-link" @click="changePage(pagination.current_page + 1)" :disabled="pagination.current_page === pagination.last_page">Next</a>
          </li>
        </ul>
      </nav>
    </div>
  </div>

</template>
  
  <script>
  export default {
    props: {
    pagination: {
      type: Object,
      required: true
    }
  },
     emits: ['page-changed'],
    methods: {
      changePage(page) {
        
        this.$emit('page-changed', page);
      }
    }
  };
  </script>
  
  <style>
  a.page-link{
    color:#000 !important;
    cursor: pointer;
  }
  </style>
  