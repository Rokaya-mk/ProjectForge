<template>
    <FlashMessage ref="flashMessage"></FlashMessage>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between bg-dark">
                    <h5 class="text-light">Users List</h5>
                    <button class="btn btn-success"
                            v-if="userPermissions.has('users-create')"
                            @click="openModal" >
                            New User
                    </button>
                </div>
                <div class="card-body">
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
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Department</th>
                                    <th v-if="userPermissions.has('users-update') || 
                                             userPermissions.has('users-delete')">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(user, index) in users.data" :key="index" >
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ user.name }}</td>
                                    <td>{{ user.email }}</td>
                                    <td  v-if="user.departments">
                                        <div v-for="dep in user.departments" :key="dep">
                                            <span class="badge bg-primary ">{{ dep.name }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <button class="btn btn-success mx-1"
                                                v-if="userPermissions.has('users-update')" 
                                                @click="editUser(user)">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger mx-1"
                                                v-if="userPermissions.has('users-delete')"
                                                @click="deleteUser(user)">
                                                <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade show"
                        id="exampleModal"
                        tabindex="-1"
                        aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        {{ !editMode ? "Create Department" : "Update Department" }}
                                    </h5>
                                    <button @click="closeModal"
                                            type="button"
                                            class="btn-close"
                                            aria-label="Close">
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-3 ">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input  @blur="validateName"
                                                        type="text"
                                                        class="form-control"
                                                        v-model="userData.name" />
                                                <span v-if="userErrors.name" class="text-danger">
                                                    {{userErrors.name}}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 ">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input  @blur="validateEmail"
                                                        type="email"
                                                        :disabled="isDisabled"
                                                        class="form-control"
                                                        v-model="userData.email" />
                                                <span v-if="userErrors.email" class="text-danger">
                                                    {{userErrors.email}}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input  @blur="validatePassword"
                                                        type="password"
                                                        class="form-control"
                                                        v-model="userData.password" />
                                                <span v-if="userErrors.password" class="text-danger">
                                                    {{userErrors.password}}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="department_id">Department</label>
                                                <Multiselect
                                                    mode="tags"
                                                    :searchable="true"
                                                    v-model="userData.department_id"
                                                    :options="filteredDepartments"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="selected_roles">Roles</label>
                                                <Multiselect 
                                                    :searchable="true"
                                                    v-model="userData.selected_roles"
                                                    :options="filteredRoles"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="permissionCategoryValue">Permission category</label>
                                                <Multiselect
                                                    mode="tags"
                                                    :searchable="true"
                                                    v-model="userData.permissionCategoryValue"
                                                    :options="filteredPermissionsCategory"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="permissionValue">Permission</label>
                                                <Multiselect
                                                    mode="tags"
                                                    :searchable="true"
                                                    v-model="userData.permissionValue"
                                                    :options="permissionList"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button
                                        @click="closeModal"
                                        type="button"
                                        class="btn btn-secondary">
                                        Close
                                    </button>
                                    <button
                                    @click=" !editMode ? saveUser() : updateUser()"
                                        type="button"
                                        class="btn"
                                        :class="{
                                            'btn-success': !editMode,
                                            'btn-warning': editMode,
                                        }">
                                        {{ !editMode ? "Save changes" : "Update " }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import { Modal } from "bootstrap";
import Multiselect from '@vueform/multiselect';
import { mapState,mapGetters, mapActions } from "vuex";
import FlashMessage from "@/components/FlashMessage.vue";
    export default {
        components:{
            Multiselect,
            FlashMessage,
        },
        data(){
        return {
            isDisabled:false,
            permissionList: [],
            
            editMode: false,
            userData: {
                    id: '',
                    department_id: [],
                    name: '',
                    email: '',
                    password: '',
                    selected_roles: [],
                    permissionCategoryValue: [],
                    permissionValue: [],
                },
            userErrors:{},
            searchData: {
                    search_type: "name",
                    search_value: "",
            },
        }
    },
    computed: {
          /* access to getter with mapgetter 
        departments : to get departments list
        userRoles : verify roles of this authenticated user 
        userPermissions : get the permissions of this user
        errors :  get api errors
        */
       
        ...mapGetters({
            departments :'department/departments',
            filteredDepartments : 'department/filteredDepartments',
            filteredRoles : 'user/roles',
            filteredPermissions : 'user/permissions',
            filteredPermissionsCategory : 'user/permissionsCategory',
            userRoles : 'user/userRoles',
            userPermissions : 'user/userPermissions',
            users : 'user/users'
        }),
       
    },
    watch: {
        'userData.permissionCategoryValue': function (value) {
        	 // show permissions of selected categories without including 'delete' permission
             this.permissionList = [];
            let ar = Object.entries(value).map(entry => entry[1])
            ar.forEach(element => {
                let categories = this.filteredPermissions.filter(item => item.label.includes(element) && (!item.label.includes('delete')))
                categories.forEach(item => {
                    this.permissionList.push(item)
                })
            });
            
        }
    },
    mounted() {
        this.modal = new Modal(document.getElementById("exampleModal"));
        this.$store.dispatch('user/getUserRolesPermissions'); 
        this.$store.dispatch('user/getAllPermissions');
        this.$store.dispatch('user/getAllRoles');
        this.$store.dispatch('user/getUsers');
        this.getDepartments();
    },
    methods: {
        ...mapActions({
            setFlashMessage : 'flash/setFlashMessage',
            searchUser : 'user/searchUser',
        }),
        search(){
            this.searchUser(this.searchData)
        },
        getDepartments() {
            this.$store.dispatch("department/getDepartments")
        },
        saveUser(){
            if (this.validateData()) {
                this.$store
                    .dispatch("user/storeUser", this.userData)
                    .then((response) => {
                        this.$store.dispatch('user/getUsers');
                        this.closeModal();
                        this.setFlashMessage({ message: 'User was created !!', type: 'alert-success' });
                    })
            }
        },
        // show edit user modal
        editUser(user) {
            this.editMode = true;
            this.isDisabled = true
            this.userData.id = user.id;
            this.userData.name = user.name;
            this.userData.email = user.email;
            this.userData.permissionValue = []
            this.userData.permissionCategoryValue = []
            if(user.departments){
                user.departments.forEach(department => {
                    this.userData.department_id.push(department.id)
                });
            }
            user.roles.forEach(role => {
                this.userData.selected_roles.push(role.id)
            })
            let category_array = []
            user.permissions.forEach(permission => {
                category_array.push(permission.name.split('-')[0])
                let user_permissions = this.filteredPermissions.filter(item => item.label.includes(permission.name) && (!item.label.includes('delete')))
                user_permissions.forEach(item => {
                    this.userData.permissionValue.push(item.value)
                })
            })
            this.userData.permissionCategoryValue=[...new Set(category_array)]
            //  this.userData.permissionCategoryValue = this.filteredPermissionsCategory
            this.modal.show();
        },
        // update user
        updateUser() {
            if (this.validateData()) {
                this.$store
                    .dispatch("user/updateUser", this.userData)
                    .then((response) => {
                        this.$store.dispatch('user/getUsers');
                        this.closeModal();
                        this.setFlashMessage({ message: 'User was Updated !!', type: 'alert-success' });
                    });
            }
        },
        // delete User
        deleteUser(user) {
            if (confirm("Are you sure you want to delete user!")) {
                this.$store
                    .dispatch("user/deleteUser", user)
                    .then((response) => {
                        this.$store.dispatch('user/getUsers');
                        this.closeModal();
                        this.setFlashMessage({ message: 'User was Deleted !!', type: 'alert-success' });

                    });
            }
        },
        // methode to show flash message
        showMessage(text, type) {
            this.$refs.flashMessage.showMessage(text, type);
        },
        openModal() {
            this.editMode = false;
            this.isDisabled = false;
            // clear data inputs
            this.clearModal();
            this.modal.show();
        },
        closeModal() {
            this.modal.hide();
        },
        clearModal(){
            console.log('clear')
            this.userData.name = ''
            this.userData.department_id= []
            this.userData.email= ''
            this.userData.password= ''
            this.userData.department_id= []
            this.userData.selected_roles= []
            this.userData.permissionCategoryValue= []
            this.userData.permissionValue= []
            this.permissionList= []
        },
        // validate Name
        validateName() {
            if (!this.userData.name) {
                this.userErrors.name = "Name is required";
            }else if(this.userData.name.length < 5){
                this.userErrors.name = "Name length must be at least 5" ;
            } else {
                delete this.userErrors.name;
            }
        },
        // validate Email
        validateEmail(){

        },
        validatePassword(){},
       
        // validate data methode
        validateData() {
            this.validateName();
            return Object.keys(this.userErrors).length === 0;
        },
    },
    }
</script>