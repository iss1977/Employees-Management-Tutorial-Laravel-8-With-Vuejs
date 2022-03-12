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
                            <form>
                                <!-- First name -->
                                <div class="row mb-3">
                                    <label for="first_name" class="col-md-4 col-form-label text-md-end">First name</label>
                                    <div class="col-md-6">
                                        <input type="text" id="first_name" class="form-control" name="first_name" value="" autofocus />
                                    </div>
                                </div>

                                <!-- Middle name -->
                                <div class="row mb-3">
                                    <label for="middle_name" class="col-md-4 col-form-label text-md-end">Middle name</label>
                                    <div class="col-md-6">
                                        <input type="text" id="middle_name" class="form-control" name="middle_name" value=""/>
                                    </div>
                                </div>

                                <!-- Last name -->
                                <div class="row mb-3">
                                    <label for="last_name" class="col-md-4 col-form-label text-md-end">Last name</label>
                                    <div class="col-md-6">
                                        <input type="text" id="last_name" class="form-control" name="last_name" value=""/>
                                    </div>
                                </div>

                                <!-- Address -->
                                <div class="row mb-3">
                                    <label for="address" class="col-md-4 col-form-label text-md-end">Address</label>
                                    <div class="col-md-6">
                                        <input type="text" id="address" class="form-control" name="address" value=""/>
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
                                        <select id="select_state" name="state_id" class="custom-select" required
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
                                        <select id="select_city" name="city_id" class="custom-select" required v-model="form.city_id">
                                            <option :value="0" disabled selected >-- Select city --</option>
                                            <option v-for="city in cities" :key="city.id" :value="city.id">{{ city.name }}</option>
                                            <!-- Read cities -->

                                        </select>
                                    </div>
                                </div>

                                <!-- Zip code -->
                                <div class="row mb-3">
                                    <label for="Zip code" class="col-md-4 col-form-label text-md-end">Zip code</label>
                                    <div class="col-md-6">
                                        <input type="text" id="Zip code" class="form-control" name="Zip code" value=""/>
                                    </div>
                                </div>

                                <!-- Date of birth -->
                                <div class="row mb-3 form-group">
                                    <label for="address" class="col-md-4 col-form-label text-md-end">Date of birth</label>
                                    <div class="col-md-6">
                                        <datepicker input-class="form-control bg-white"></datepicker>
                                    </div>
                                </div>


                                <!-- Date hired-->
                                <div class="row mb-3 form-group">
                                    <label for="address" class="col-md-4 col-form-label text-md-end">Date hired</label>
                                    <div class="col-md-6">
                                        <datepicker input-class="form-control bg-white"></datepicker>
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
import Datepicker from 'vuejs-datepicker';

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
                department_id : '',
                city_id : 0,
                zip_code :'',
                birthdate: null,
                date_hired : null,
            }
        }
    },
    created(){
        this.getCountries();
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
                    console.error('Error reading countries')
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
                    console.error('Error reading countries')
                })
        }

    }

}
</script>

<style>
</style>
