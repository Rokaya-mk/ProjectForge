<template lang="">
    <div class="card">
    <div class="card-header bg-dark">
        <h5 class="text-light">Update Role</h5>
    </div>
    <div class="card-body" v-if="role">
        <form @submit.prevent="updateRole">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" v-model="role.name">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="display_name">Display Name</label>
                        <input type="text" class="form-control" v-model="role.display_name">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" v-model="role.description">
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
            roleId : this.$route.params.id
        }
    },
    computed: {
        ...mapGetters({
            'role': 'role/role',
            'authenticated' : 'auth/authenticated',
        }),
    },
    mounted(){
            this.showRole(this.roleId)
        
    },
    methods: {
        
        ...mapActions({
            'showRole' : 'role/showRole',
            'update' : 'role/updateRole',
            'setFlashMessage' : 'flash/setFlashMessage',
        }),
         // methode to show flash message
         showMessage(text, type) {
            this.$refs.flashMessage.showMessage(text, type);
        },
        updateRole(){
            this.update(this.role)
                .then((response) => {
                    // this.$store.dispatch('role/get')
                    this.setFlashMessage({ message: 'Role was Updated !!', type: 'alert-success' });
                    this.$router.push({ path: "/roles"})
                });
            
        }
    },
}
</script>
<style lang="">
    
</style>