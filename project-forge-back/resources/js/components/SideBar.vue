<template lang="">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-primary">
                        <i class="fa fa-bars"></i>
                        <span class="sr-only">Toggle Menu</span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" id="navCollapse">
                        <i class="fa fa-bars"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="#">Settings</a>
                            </li>
                            <li v-if="authenticated" class="nav-item">
                                
                                <a @click="logout()" class="nav-link">Logout</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>
</template>
<script>
import {mapGetters,mapActions} from 'vuex';
export default {
    computed : {
        ...mapGetters({
            'authenticated' : 'auth/authenticated', 
            'user' : 'auth/user', 
        })
    },
    methods: {
        ...mapActions({
            'singnout' : 'auth/singnOut'
        }),
        logout(){
            this.singnout().then(() => this.$router.replace({name :'Singin'}))
        }
    },
}
</script>
<style lang="">
    
</style>