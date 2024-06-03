<template lang="" v-if="permissions">
    <FlashMessage ref="flashMessage"></FlashMessage>
<div class="row" v-if="authenticated">
    <div class="col-md-12">
        <div class="card-header d-flex justify-content-between bg-dark">
            <h5 class="text-light">Permissions List</h5>
            <router-link class="btn btn-success " :to="{name:'create-permission'}">
                Create New Permission
            </router-link>
        </div>
    </div>
   
</div>
<div class="row" >
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Display Name</th>
                        <th>Description</th>
                        <th v-if="userPermissions.has('permissions-update','permissions-delete')">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody v-if="permissions">
                        <tr v-for="(permission, index) in permissions.data" :key="index">
                            <td>{{index + 1}}</td>
                            <td>{{ permission.name }}</td>
                            <td>{{ permission.display_name }}</td>
                            <td>{{ permission.description }}</td>
                            <td v-if="userPermissions.has('permissions-update')">
                                <div class="d-inline-block">
                                    <router-link :to="{name:'edit-permission' ,params :{id: permission.id} }" class="btn btn-success mr-2">
                                        <i class="fa fa-edit"></i>
                                    </router-link>
                                </div>
                                <button class="btn btn-danger mx-1"
                                        v-if="userPermissions.has('permissions-delete')"
                                        @click="deletePermission(permission)">
                                        <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<Pagination :pagination="pagination" @page-changed="getPermissions($event)" />


</template>
<script>
import FlashMessage from "@/components/FlashMessage.vue";
import Pagination from '@/components/Pagination.vue'
import { mapActions, mapGetters } from 'vuex';

export default {
components:{
    FlashMessage,
    Pagination
},
computed: {
     /* access to getter with mapgetter 
    userPermissions : get the permissions of this user
    */
    ...mapGetters({    
        'authenticated' : 'auth/authenticated',  
        'userPermissions' : 'user/userPermissions',
        'permissions' : 'permission/permissions',
        'pagination' : 'pagination/pagination'
    }),
},
mounted(){
    
    this.getPermissions()
    this.$store.dispatch('user/getUserRolesPermissions');
},
methods: {
    ...mapActions({
        setFlashMessage : 'flash/setFlashMessage',
    }),
    // get permission list
    getPermissions(page) {
        this.$store.dispatch("permission/getPermissions",page);
    },
    // delete permission
    deletePermission(permission) {
        if (confirm("Are you sure you want to delete permission!")) {
            this.$store
                .dispatch("permission/deletePermission", permission)
                .then(() => {
                    this.setFlashMessage({ message: 'permission was Deleted !!', type: 'alert-success' });
                    this.getPermissions();
                });
        }
    },   
},
}
</script>
<style lang="">

</style>