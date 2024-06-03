<template v-if="roles" lang="">
        <FlashMessage ref="flashMessage"></FlashMessage>
    <div class="row" v-if="authenticated">
        <div class="col-md-12">
            <div class="d-flex justify-content-between bg-dark p-3 rounded">
                <h5 class="text-light">Roles</h5>
                <router-link class="btn btn-success float-right" :to="{name: 'create-role'}">
                    Create New Role
                </router-link>
            </div>
        </div>
    </div>
    <div class="row" >
        <div class="col-md-12">
            <div class="row px-5 d-flex justify-content-around align-items-center mb-2">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="search_type">Search Type</label>
                        <select  class="form-control" v-model="searchData.search_type">
                            <option value="name">Name</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="search_value">Search Value</label>
                        <input type="text" class="form-control" 
                                v-model="searchData.search_value" 
                                @keyup="search">
                    </div>
                </div>
                <div class="col-md-3  mt-1">
                    <button @click="search" class="btn btn-success">
                        <i class="fa fa-search"></i>
                    </button>
                    
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Display Name</th>
                            <th>Description</th>
                            <th v-if="userPermissions.has('roles-update','roles-delete')">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr v-for="(role, index) in roles.data" :key="index">
                                <td>{{index + 1}}</td>
                                <td>{{ role.name }}</td>
                                <td>{{ role.display_name }}</td>
                                <td>{{ role.description }}</td>
                                <td v-if="userPermissions.has('roles-update')">
                                    <div class="d-inline-block">
                                        <router-link :to="{name:'edit-role' ,params :{id: role.id} }" class="btn btn-success mr-2">
                                            <i class="fa fa-edit"></i>
                                        </router-link>
                                    </div>
                                    <button class="btn btn-danger mx-1"
                                            v-if="userPermissions.has('roles-delete')"
                                            @click="deleteRole(role)">
                                            <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
import FlashMessage from "@/components/FlashMessage.vue";
import { mapActions, mapGetters } from 'vuex';

export default {
    components:{
        FlashMessage
    },
    data(){
        return{
            searchData: {
                    search_type: "name",
                    search_value: "",
            },
        }
    },
    computed: {
         /* access to getter with mapgetter 
        userRoles : verify roles of this authenticated user 
        userPermissions : get the permissions of this user
        */
        ...mapGetters({    
            'authenticated' : 'auth/authenticated',  
            'userRoles' : 'user/userRoles',
            'userPermissions' : 'user/userPermissions',
            'roles' : 'role/roles',

        }),
    },
    mounted(){
        
        this.getRoles()
        this.$store.dispatch('user/getUserRolesPermissions');
      
    },
    methods: {
        ...mapActions({
            'setFlashMessage' : 'flash/setFlashMessage',
            searchRole : 'role/searchRole',
        }),
        search(){
            this.searchRole(this.searchData)
        },
        hasRole(role) {
            return this.userRoles.has(role);
        },
        // get role list
        getRoles() {
            this.$store.dispatch("role/getRoles");
        },
        // delete role
        deleteRole(role) {
            if (confirm("Are you sure you want to delete Role!")) {
                this.$store
                    .dispatch("role/deleteRole", role)
                    .then(() => {
                        this.setFlashMessage({ message: 'Role was Deleted !!', type: 'alert-success' });
                        this.getRoles();
                    });
            }
        },   
    },
}
</script>
<style lang="">
    
</style>