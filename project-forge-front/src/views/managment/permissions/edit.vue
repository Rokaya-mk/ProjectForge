<template lang="">
    <div class="card">
    <div class="card-header bg-dark">
        <h5 class="text-light">Update Permission</h5>
    </div>
    <div class="card-body" v-if="permission">
        <form @submit.prevent="updatePermission">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" v-model="permission.name">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="display_name">Display Name</label>
                        <input type="text" class="form-control" v-model="permission.display_name">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" v-model="permission.description">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-success float-right">
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</template>
<script>
import { mapActions, mapGetters } from 'vuex';
import FlashMessage from "@/components/FlashMessage.vue";

export default {
    data(){
        return{
            permissionId : this.$route.params.id
        }
    },
    computed: {
        ...mapGetters({
            'permission': 'permission/permission',
            'authenticated' : 'auth/authenticated',
        }),
    },
    mounted(){
            this.showPermission(this.permissionId)
        
    },
    methods: {
        
        ...mapActions({
            'showPermission' : 'permission/showPermission',
            'update' : 'permission/updatePermission',
            'setFlashMessage' : 'flash/setFlashMessage',
        }),
         // methode to show flash message
         showMessage(text, type) {
            this.$refs.flashMessage.showMessage(text, type);
        },
        updatePermission(){
            this.update(this.permission)
                .then((response) => {
                    // this.$store.dispatch('permission/get')
                    this.setFlashMessage({ message: 'Permission was Updated !!', type: 'alert-success' });
                    this.$router.push({ path: "/permissions"})
                });
            
        }
    },
}
</script>
<style lang="">
    
</style>