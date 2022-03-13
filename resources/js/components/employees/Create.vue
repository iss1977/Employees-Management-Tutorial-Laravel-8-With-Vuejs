<template>
    <div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            Register Employees
                            <a @click="$router.go(-1)">back</a>
                        </div>

                        <div class="card-body">
                            <form @submit.prevent="submitForm">
                                <!-- First name -->
                                <div class="row mb-3">
                                    <label for="first_name" class="col-md-4 col-form-label text-md-end">First name</label>
                                    <div class="col-md-6">
                                        <input type="text" id="first_name" class="form-control" value="" autofocus
                                        v-model="form.first_name"/>
                                    </div>
                                </div>

                                <!-- Middle name -->
                                <div class="row mb-3">
                                    <label for="middle_name" class="col-md-4 col-form-label text-md-end">Middle name</label>
                                    <div class="col-md-6">
                                        <input type="text" id="middle_name" class="form-control" value=""
                                        v-model="form.middle_name"/>
                                    </div>
                                </div>

                                <!-- Last name -->
                                <div class="row mb-3">
                                    <label for="last_name" class="col-md-4 col-form-label text-md-end">Last name</label>
                                    <div class="col-md-6">
                                        <input type="text" id="last_name" class="form-control" value=""
                                        v-model="form.last_name"/>
                                    </div>
                                </div>

                                <!-- Address -->
                                <div class="row mb-3">
                                    <label for="address" class="col-md-4 col-form-label text-md-end">Address</label>
                                    <div class="col-md-6">
                                        <input type="text" id="address" class="form-control"  value=""
                                        v-model="form.address"/>
                                    </div>
                                </div>

                                <!-- Country -->
                                <div class="row mb-3">
                                    <label class="col-md-4 col-form-label text-md-end" for="select_country">Country</label>
                                    <div class="col-md-6">
                                        <!-- Countries Dropdown -->
                                        <select id="select_country" class="custom-select" required
                                        v-model="form.country_id" @change="getStatesOfCountry">
                                            <option :value="0" disabled selected >-- Select country --</option>
                                            <option v-for="country in countries" :key="country.id" :value="country.id">{{ country.name }}</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- State -->
                                <div class="row mb-3">
                                    <label class="col-md-4 col-form-label text-md-end" for="select_state">State</label>
                                    <div class="col-md-6">
                                        <!-- States Dropdown -->
                                        <select id="select_state" class="custom-select" required
                                        v-model="form.state_id"
                                        @change="getCitiesOfState">
                                            <option :value="0" disabled selected>-- Select state --</option>
                                            <option v-for="state in states" :key="state.id"  :value="state.id">{{state.name}}</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- City -->
                                <div class="row mb-3">
                                    <label class="col-md-4 col-form-label text-md-end" for="select_city">City</label>
                                    <div class="col-md-6">
                                        <!-- Cities Dropdown -->
                                        <select id="select_city" class="custom-select" required v-model="form.city_id">
                                            <option :value="0" disabled selected >-- Select city --</option>
                                            <option v-for="city in cities" :key="city.id" :value="city.id">{{ city.name }}</option>
                                            <!-- Read cities -->

                                        </select>
                                    </div>
                                </div>

                                <!-- Zip code -->
                                <div class="row mb-3">
                                    <label for="zip_code" class="col-md-4 col-form-label text-md-end">Zip code</label>
                                    <div class="col-md-6">
                                        <input type="text" id="zip_code" class="form-control" value=""
                                        v-model="form.zip_code"/>
                                    </div>
                                </div>

                                <!-- Departments -->
                                <div class="row mb-3">
                                    <label class="col-md-4 col-form-label text-md-end" for="select_department">Department</label>
                                    <div class="col-md-6">
                                        <!-- Cities Dropdown -->
                                        <select id="select_department" class="custom-select" required v-model="form.department_id">
                                            <option :value="0" disabled selected >-- Select Department --</option>
                                            <option v-for="department in departments" :key="department.id" :value="department.id">{{ department.name }}</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Date of birth -->
                                <div class="row mb-3 form-group">
                                    <label for="address" class="col-md-4 col-form-label text-md-end">Date of birth</label>
                                    <div class="col-md-6">
                                        <datepicker input-class="form-control bg-white"
                                        v-model="form.birthdate"></datepicker>
                                    </div>
                                </div>


                                <!-- Date hired-->
                                <div class="row mb-3 form-group">
                                    <label for="address" class="col-md-4 col-form-label text-md-end">Date hired</label>
                                    <div class="col-md-6">
                                        <datepicker input-class="form-control bg-white"
                                        v-model="form.date_hired"></datepicker>
                                    </div>
                                </div>


                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button
                                            type="submit"
                                            class="btn btn-primary"
                                        >
                                            Create
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Datepicker from 'vuejs-datepicker';
import moment from "moment";

export default {
    components: {
        Datepicker
    },
    data: function (){
        return{
            countries:[],
            states:[],
            departments:[],
            cities:[],
            form : {
                first_name: '',
                last_name : '',
                middle_name:'',
                address: '',
                country_id: 0,
                state_id : 0,
                department_id : 0,
                city_id : 0,
                zip_code :'',
                birthdate: null,
                date_hired : null,
            }
        }
    },
    created(){
        this.getCountries();
        this.getDepartments();
    },
    methods:{
        getCountries(){
            console.log('Start get countries');
            this.states=[];
            axios.get('/api/employees/countries')
                .then(res => {
                    this.countries = res.data

                })
                .catch(error => {
                    console.error('Error reading countries')
                })
        },
        getStatesOfCountry(){
            this.cities=[];
            this.form.state_id = 0
            this.form.city_id = 0

            var getRoute = "/api/employees/"+this.form.country_id+"/states";
            console.log(getRoute);
            axios.get(getRoute,[{ responseType: 'json'}])
                .then(res => {
                    this.states = res.data;
                })
                .catch(error => {
                    console.error('Error reading states')
                })
        },
        getCitiesOfState(){
            this.form.city_id = 0
            var getRoute=`/api/employees/${this.form.state_id}/cities`;
            axios.get(getRoute,[{ responseType: 'json'}])
                .then(res => {
                    this.cities = res.data
                })
                .catch(error => {
                    console.error('Error reading cities')
                }
            )
        },
        getDepartments(){
            this.form.city_id = 0
            var getRoute=`/api/employees/departments`;
            axios.get(getRoute,[{ responseType: 'json'}])
                .then(res => {
                    this.departments = res.data
                })
                .catch(error => {
                    console.error('Error reading departments')
                }
            )
        },
        submitForm(){
            axios.post('/api/employees/create',
            {
                first_name: this.form.first_name,
                last_name: this.form.last_name,
                middle_name: this.form.middle_name,
                address: this.form.address,
                country_id: this.form.country_id,
                state_id: this.form.state_id,
                department_id: this.form.department_id,
                city_id: this.form.city_id,
                zip_code: this.form.zip_code,
                birthdate: this.format_date(this.form.birthdate),
                date_hired: this.format_date(this.form.date_hired),
            }
            ).then(res => {
                console.log(res);
            });

        },
        format_date(value){
            if(value){
                return moment(String(value)).format('YYYYMMDD')
            }
        },
    }//methods()

}
</script>

<style>
</style>
