<template>
    <!-- <div v-if="error" class="error">{{ error }}</div> -->
    <FlashMessage ref="flashMessage"></FlashMessage>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between bg-dark">
                    <h5 class="text-light">Departments List</h5>
                    <button class="btn btn-success"
                            v-if="userPermissions.has('departments-create')"
                            @click="openModal" >
                            New Department
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(department, index) in departments.data" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ department.name }}</td>
                                    <td>
                                        <button class="btn btn-success mx-1"
                                                v-if="userPermissions.has('departments-update')" 
                                                @click="editDepartment(department)">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger mx-1"
                                                v-if="userPermissions.has('departments-delete')"
                                                @click="deleteDepartment(department)">
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
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"
                                        id="exampleModalLabel">
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
                                        <div class="col-md-6 mx-auto">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input @blur="validateName"
                                                        type="text"
                                                        class="form-control"
                                                        v-model="departmentData.name"/>
                                                <span v-if="departmentErrors.name"
                                                      class="text-danger">
                                                      {{departmentErrors.name}}
                                                </span>
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
                                        @click=" !editMode ? saveDepartment() : updateDepartment()"
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
import { mapGetters, mapActions } from "vuex";
import FlashMessage from "./FlashMessage.vue";
export default {
    components:{
        FlashMessage
    },
    data() {
        return {
            showFlashMessage : null,
            editMode: false,
            modal: "",
            departmentData: {
                id: "",
                name: "", 
            },
            // object error
            departmentErrors: {},
        };
    },
    mounted() {

        this.modal = new Modal(document.getElementById("exampleModal"));
        this.getDepartments();
        
        this.$store.dispatch('user/getUserRolesPermissions');
        
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
            
            userRoles : 'user/userRoles',
            userPermissions : 'user/userPermissions',
            errors :"department/errors"
        }),
        
    },
    methods: {
        // methode to show flash message
        showMessage(text, type) {
            this.$refs.flashMessage.showMessage(text, type);
        },
        openModal() {
            this.editMode = false;
            this.departmentData.name = "";
            this.modal.show();
        },

        closeModal() {
            this.modal.hide();
        },
        // save Department method
        saveDepartment() {
            if (this.validateData()) {
                this.$store
                    .dispatch("department/storeDepartment", this.departmentData)
                    .then((response) => {
                        this.getDepartments();
                        this.closeModal();
                        this.$refs.flashMessage.showMessage('department was created !!', 'alert-success');
                    })
            }
        },
        // get departments list
        getDepartments() {
            this.$store.dispatch("department/getDepartments");
        },
        // show edit department modal
        editDepartment(department) {
            this.editMode = true;
            this.departmentData.id = department.id;
            this.departmentData.name = department.name;
            this.modal.show();
        },
        // update department
        updateDepartment() {
            if (this.validateData()) {
                this.$store
                    .dispatch("department/updateDepartment", this.departmentData)
                    .then((response) => {
                        this.getDepartments();
                        this.closeModal();
                        this.$refs.flashMessage.showMessage('Department was Updated !!', 'alert-success');
                    });
            }
        },
        // delete Department
        deleteDepartment(department) {
            if (confirm("Are you sure you want to delete department!")) {
                this.$store
                    .dispatch("department/deleteDepartment", department)
                    .then((response) => {
                        this.getDepartments();
                        this.closeModal();
                        this.$refs.flashMessage.showMessage('Department was Deleted !!', 'alert-success');
                    });
            }
        },
        // validate Name
        validateName() {
            if (!this.departmentData.name) {
                this.departmentErrors.name = "Name is required";
            }else if(this.departmentData.name.length < 5){
                this.departmentErrors.name = "Name length must be at least 5" ;
            } else {
                delete this.departmentErrors.name;
            }
        },
       
        // validate data methode
        validateData() {
            this.validateName();
            return Object.keys(this.departmentErrors).length === 0;
        },
    },
};
</script>
<style></style>
