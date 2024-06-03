<template lang="">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mt-5">
                <img :src="require(`/src/assets/sidebar/images/login.png`)" alt="auth" width="100%">
            </div>
            <div class="col-md-6 ">
                <div class="row mt-5 pt-5">
                    <div class="col-md-12">
                        <h3>Login  </h3>
                        <!-- Show errors login -->
                        <div v-if="loginError" class="alert alert-danger">{{ loginError }}</div>
                        <div class="card">
                            <div class="card-header bg-secondary">
                                <h5 class="text-center text-light">Login</h5>
                            </div>
                            <div class="card-body">
                                <form @submit.prevent="sabmit()">
                                    <div class="form-group my-1">
                                        <label for="email">Email</label>
                                        <!-- Classe CSS "is-invalid" si erreur pour "name" -->
                                        <input type="email" 
                                            v-model="user.email" 
                                            class="form-control"
                                            placeholder="Email Address">
                                        <!-- Le message d'erreur -->
                                        <span v-if="errors.email" class="text-danger">{{ errors.email }}</span>
                                    </div>
                                    <div class="form-group my-1">
                                        <label for="password">Password</label>
                                        <input type="password" 
                                        v-model="user.password"
                                        class="form-control"
                                        placeholder="Password" 
                                        autocomplete="new-password">
                                    <!-- Le message d'erreur -->
                                    <span v-if="errors.password" class="text-danger">{{ errors.password }}</span>
                                    </div>
            
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group my-1">
                                                <a class="text-primary">Forgot Password</a>
                                            </div>
                                        </div>
                                    </div>
            
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group my-1">
                                                <button type="submit" class="btn btn-warning float-start">Login</button>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <a  class="btn btn-dark float-end my-1 text-white">Go to register</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div>
        <h1>Signin</h1>
        <div class="row">
            <div class="col-md-6 mx-auto mt-3">
                <form @submit.prevent="sabmit()" >
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input v-model="user.email" type="email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input v-model="user.password" type="password"  id="password" class="form-control">
                    </div>
                    <button class="btn btn-primary btn-block">Singin</button>
                </form>
            </div>
        </div>
    </div> -->
</template>
<script>
import { mapActions,mapGetters } from 'vuex';
export default {
    components: {
        
    },
    data(){
        return{
            user : {
                email : '',
                password : ''
            },
            errors: {},
        }
    },
    computed: {
        ...mapGetters({
            'loginError' :  'auth/authError'
        }),
    },
    methods: {
        ...mapActions({
            'signIn' :  'auth/singIn'
        }),
        validateForm() {
        this.errors = {};

        if (!this.user.email) {
            this.errors.email = 'email is required';
        }

        if (!this.user.password) {
            this.errors.password = 'Password is required';
        }

        return Object.keys(this.errors).length === 0;
        },
        sabmit(){
            if (!this.validateForm()) {
                return;
            }
            this.signIn(this.user).then(() => this.$router.push({ path: "/" }))
            // this.singnout().then(() => this.$router.replace({name :'Singin'}))
        }
    },

}
</script>
<style lang="">
    
</style>