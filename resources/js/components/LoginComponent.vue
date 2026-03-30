<template>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Login
                </div>
                <div class="card-body">
                    <div v-if="error" class="alert alert-danger">
                        {{ error }}
                    </div>
                    <form @submit.prevent="login">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="email" class="form-control" v-model="form.email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" v-model="form.password" required>
                        </div>
                        <button class="btn btn-primary w-100">
                            Login
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>  
</template>
<script>

    /* 
        This script does the following:
        Imports the Axios library to make HTTP requests
        Captures the login form information
        Executes the method to process it in the controller and perform the corresponding login
    */
    import axios from 'axios'

    export default {
        data(){
            return {
                form:{
                    email:'',
                    password:''
                },
                error:null
            }
        },
        methods:{
            async login(){
                this.error = null
                try{
                    await axios.post('/login', this.form)
                    window.location.assign('/pharmacovigilance/search')
                }catch(e){
                    if(e.response && e.response.status == 401){
                        this.error = e.response.data.message
                    }else{
                        this.error = 'Invalid credentials'
                    }
                }
            }
        }
    }
</script>