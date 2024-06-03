<template  lang="" >
    <FlashMessage ref="flashMessage"></FlashMessage>
    <div class="row" v-if="profile">
        <div v-if="profileError" >
            <div  v-for="(error, index) in profileError" :key="index">
                <div class="alert alert-danger">{{ error }}</div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card mt-2">
                <div class="card-header bg-dark">
                    <h5 class="text-light">Update Password of {{ profile.name }} </h5>
                </div>
                <div class="card-body">
                    <form @submit.prevent="update()" >
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="old_password">Old Password</label>
                                    <input type="password" class="form-control" v-model="profileData.old_password" />
                                </div>
                            </div>
                           
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <input type="password" class="form-control" v-model="profileData.password"  />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm New Password</label>
                                    <input type="password" class="form-control" v-model="profileData.password_confirmation"  />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Change Password</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</template>
<script>
import FlashMessage from "@/components/FlashMessage.vue";
import { mapActions, mapGetters } from "vuex";
export default {
    components:{
        FlashMessage
    },
    data(){
        return{
           profileData:{
            id:'',
            old_password : '',
            password : '',
            password_confirmation : '',
           },
        }
    },
    computed: {
        ...mapGetters({
            'profile' : 'profile/profile',
            'profileError' : 'profile/profileError'
        })
    },
    mounted() {
        this.getProfile();
        
    },
    methods: {
        ...mapActions({
            'getProfile' : 'profile/getProfile',
            'updatePassword': 'profile/updatePassword',
            'setFlashMessage' : 'flash/setFlashMessage',
        }),
        update(){
            
            this.profileData.id = this.profile.id
            this.updatePassword(this.profileData).then(() => {
                if(!this.profileError){
                    this.setFlashMessage({ message: 'Password Updeted Successfully!!', type: 'alert-success' });
                    setTimeout(() => {
                        this.$router.push({ path: "/login" });
                        }, 3000);
                    
            }
            })
        },
        
    },

}
</script>
<style lang="">
    
</style>