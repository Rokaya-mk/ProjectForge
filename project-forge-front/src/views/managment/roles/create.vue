<template lang="">
    <div class="card">
    <div class="card-header bg-dark">
        <h5 class="text-light">Create New Role</h5>
    </div>
    <div class="card-body">
        <form  @submit.prevent="sabmit()">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" v-model="roleData.name">
                        <span v-if="roleErrors.name"
                            class="text-danger">
                            {{roleErrors.name}}
                        </span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="display_name">Display Name</label>
                        <input type="text" class="form-control" v-model="roleData.display_name" >
                        <span v-if="roleErrors.display_name"
                            class="text-danger">
                            {{roleErrors.display_name}}
                        </span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" v-model="roleData.description">
                        <span v-if="roleErrors.description"
                            class="text-danger">
                            {{roleErrors.description}}
                        </span>
                    </div>
                </div>
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
import router from '@/router'
import { mapActions } from 'vuex'
export default {
    data(){
        return{
            roleData:{
                name:"",
                display_name: "",
                description :""
            },
            roleErrors: {},
        }
    },
    methods: {
        ...mapActions({
            'setFlashMessage' : 'flash/setFlashMessage',
        }),
        sabmit(){
            if (this.validateData()) {
                this.$store
                    .dispatch("role/storeRole",this.roleData)
                    .then(() => {
                        this.$router.push({ path: "/roles", replace: true})
                        this.setFlashMessage({ message: 'Role was Created !!', type: 'alert-success' });

                    })
            }
        },
         // validate Name
         validateName() {
            if (!this.roleData.name) {
                this.roleErrors.name = "Name is required";
            }
            delete this.roleErrors.name;
        },
        // validate display_name 
        validateDisplayName() {
            if (!this.roleData.display_name) {
                this.roleErrors.display_name = "display name is required";
            }
        },
        // validate description 
        validateDescription() {
            if (!this.roleData.description) {
                this.roleErrors.description = "Description name is required";
            }
        },
        // validate data methode
        validateData() {
            this.validateName();
            this.validateDisplayName();
            this.validateDescription();
            return Object.keys(this.roleErrors).length === 0;
        },
    },
}
</script>
<style lang="">
    
</style>