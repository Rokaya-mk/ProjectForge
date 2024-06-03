<template lang="">
    <div class="card">
        <div class="card-header bg-dark">
            <h5 class="text-light">Create New Permission</h5>
        </div>
        <div class="card-body">
            <form @submit.prevent="sabmit()">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-check-inline">
                            <input type="radio" 
                                   class="form-check-input" 
                                   id="inlineradio1" 
                                   v-model="permissionData.permission_type" 
                                   value="basic">
                            <label for="inlineradio1" class="form-check-label">Basic</label>
                        </div>
                        <div class="form-check-inline">
                            <input type="radio" 
                                   class="form-check-input" 
                                   id="inlineradio2" 
                                   v-model="permissionData.permission_type" 
                                   value="crud">
                            <label for="inlineradio2" class="form-check-label">CRUD</label>
                        </div>
                    </div>
                </div>            
                <div class="row" v-if="permissionData.permission_type == 'basic'">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" v-model="permissionData.name">
                            <span v-if="permissionErrors.name"
                                class="text-danger">
                                {{permissionErrors.name}}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="display_name">Display Name</label>
                            <input type="text" class="form-control" v-model="permissionData.display_name">
                            <span v-if="permissionErrors.display_name"
                                class="text-danger">
                                {{permissionErrors.display_name}}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" v-model="permissionData.description">
                            <span v-if="permissionErrors.description"
                                class="text-danger">
                                {{permissionErrors.description}}
                            </span>
                        </div>
                    </div>
                </div>            
                <div class="row" v-if="permissionData.permission_type == 'crud'">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="resource">Resource</label>
                            <input type="text" 
                                   class="form-control" 
                                   v-model="permissionData.resource">
                            <span v-if="permissionErrors.resource"
                                class="text-danger">
                                {{permissionErrors.resource}}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-8 mt-4 pt-3">
                        <div class="form-check-inline" v-for="(item,index) in permissionData.crud" :key="index" >
                            <input type="checkbox" 
                                   class="form-check-input" 
                                   :id="'item'+index " 
                                   v-model="permissionData.selectedCrud" 
                                   :value="item"
                                   checked
                                     >
                            <label :for="'item'+index " class="form-check-label"> {{ capitalizeFirstLetter(item) }} </label>
                        </div>
                    </div>
                </div>
                <div class="row"
                    v-if="permissionData.permission_type == 'crud' " >
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Display Name</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in permissionData.selectedCrud" :key="index">
                                <td v-text="crudName(item)" > </td>
                                <td v-text="crudDisplayName(item)"></td>
                                <td v-text="crudDisplayName(item)"></td>
                                
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success float-right">
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import { mapActions } from 'vuex'
export default {
    data(){
        return {
            permissionData: {
                    name:'',
                    display_name: '',
                    description:'',
                    resource: '',
                    permission_type: 'basic',
                    crud: ['create', 'read', 'update', 'delete'],
                    selectedCrud:['create', 'read', 'update', 'delete']
                },
            permissionErrors:{}
        }
    },
     methods: {
        ...mapActions({
            'setFlashMessage' : 'flash/setFlashMessage',
        }),
        sabmit(){
            // if(this.validateData()) {
                console.log(this.permissionData)
                this.$store
                    .dispatch("permission/storePermission",this.permissionData)
                    .then(() => {
                        this.$router.push({ path: "/permissions", replace: true})
                        this.setFlashMessage({ message: 'Permission was Created !!', type: 'alert-success' });

                    })
            // }
        },
         // validate Name
         validateName() {
            if (!this.permissionData.name) {
                this.permissionErrors.name = "Name is required";
            }else{
                this.permissionErrors.name="";
            }
        },
        // validate display_name 
        validateDisplayName() {
            if (!this.permissionData.display_name) {
                this.permissionErrors.display_name = "display name is required";
            }else{
                this.permissionErrors.display_name="";
            }
        },
        // validate description 
        validateDescription() {
            if (!this.permissionData.description) {
                this.permissionErrors.description = "Description name is required";
            }else{
                this.permissionErrors.description="";
            }
        },
        // validate description 
        validateResource() {
            if (!this.permissionData.resource) {
                this.permissionErrors.resource = "Resource name is required";
            }else{
                this.permissionErrors.resource="";
            }
        },
        // validate data methode
        validateData() {
            if(this.permissionData.permission_type == "basic"){
                this.validateName();
                this.validateDisplayName();
                this.validateDescription();
            }else{
                this.validateResource();
            }
            return Object.keys(this.permissionData).length === 0
            
        },
        capitalizeFirstLetter(item){
            return item.charAt(0).toUpperCase() + item.substring(1);
        },
            crudName(item) {
                return this.permissionData.resource.toLowerCase() + '-' + item.toLowerCase();
            },
            crudDisplayName(item) {
                return this.capitalizeFirstLetter(this.permissionData.resource) + ' ' + this.capitalizeFirstLetter(item);
            },
        }
}
</script>
<style lang="">
    
</style>