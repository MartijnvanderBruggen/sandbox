<template>
    <div class="container">
        <div class="row justify-content-center">
           
            <div class="col-md-8">
                <form>                   
                    <select>
                        <option v-for="city in cities" :city="city">{{ city }}</option>
                    </select>
                    <select v-on:change="showUsersCompanyBranch($event)" v-model="branchName">
                        <option v-for="branch in branches" :branch="branch">{{ branch }}</option>
                    </select>
                    <select>
                        <option v-for="company in companies" :company="company">{{ company }}</option>
                    </select>
                </form>
            </div>
            
        </div>
        <div class="row justify-content-center">
           
            <div class="col-md-8">
                <ul>
                    <li class="card" v-for="user in users" :user="user">
                        {{ user }}<br>
                    </li>
                </ul>
                
            </div>
            
        </div>
        <div class="row justify-content-center">
           
            <div class="col-md-8">
                
                
            </div>
            
        </div>
    </div>
</template>

<script>
    export default {
        
        data() {
            return {
                cities : [],
                branches : [],
                users : [],
                companies : [],
                branchName: '',
            }
        },
        mounted() {
            this.getCities();
            this.getCompanies();
            this.getBranches();
            this.getUsers();
        },
        methods: {
            getCities() {
                self = this;
                axios.get('/cities')
                .then(function (response) {
                    // handle success
                    self.cities = response.data;
                })
                .catch(function (error) {
                  // handle error
                  console.log(error);
                })
                .finally(function () {
                  console.log('harhar');
                });
            },
            getUsers() {
                self = this;
                axios.get('/users')
                .then(function (response) {
                    // handle success
                    self.users = response.data;
                })
                .catch(function (error) {
                  // handle error
                  console.log(error);
                })
                .finally(function () {
                  console.log('harhar');
                });
            },
            getCompanies() {
                self = this;
                axios.get('/companies')
                .then(function (response) {
                    // handle success
                    self.companies = response.data;
                })
                .catch(function (error) {
                  // handle error
                  console.log(error);
                })
                .finally(function () {
                  console.log('harhar');
                });
            },
            getBranches() {
                self = this;
                axios.get('/branches')
                .then(function (response) {
                    // handle success
                    self.branches = response.data;
                })
                .catch(function (error) {
                  // handle error
                  console.log(error);
                })
                .finally(function () {
                  console.log('harhar');
                });
            },
            showUsersCompanyBranch(event) {
                self = this;
                
                axios.get('/usersBelongsToBranch', {
                    params: {
                      name: this.branchName
                    }
                })
                .then(function (response) {
                    // handle success
                    self.users = response.data;
                })
                .catch(function (error) {
                  // handle error
                  console.log(error);
                })
                .finally(function () {
                  console.log('harhar');
                });
            }
        }
    }
</script>
