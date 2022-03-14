<template>
    <div>
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4 container-fluid">
            <h1 class="h3 mb-0 text-gray-800">Employees</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>

        </div>

        <div class="container">
            <div class="row flex-nowrap">
                <form>
                    <div class="form-row align-items-center">
                        <div class="col-auto">
                            <label class="sr-only" for="inlineFormInput">Country</label>
                            <input type="text" class="form-control mb-2 flex-shrink-1 " id="inlineFormInput"
                                placeholder="" name="search" value = "">
                        </div>
                        <div class="col-auto">
                            <input type="submit" class="btn btn-primary mb-2" value="Search" name="searchbutton">
                            <input type="submit" class="btn btn-outline-dark mb-2" value="Reset search" name="resetsearch">
                        </div>
                    </div>
                </form>
                <router-link :to="{name: 'EmployeesCreate'}" class="ml-auto btn btn-primary mb-2" ><i class="fas fa-plus mr-2"></i>Create</router-link>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="w-100" style="overflow-x:auto;">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#Id</th>
                                <th scope="col">First name</th>
                                <th scope="col">Last name</th>
                                <th scope="col">Adress</th>
                                <th scope="col">Department</th>
                                <th scope="col" style="text-align:center">Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="employee in employees" :key="employee.id">
                                <th scope="row">#{{ employee.id}}  </th>
                                <td> {{ employee.first_name}} </td>
                                <td> {{ employee.last_name}} </td>
                                <td> {{ employee.address}} </td>
                                <td> {{ employee.department.name }} </td>
                                <td style="text-align:center" class="d-flex justify-content-center">
                                    <div class="container-fluid">
                                        <router-link :to="{ name : 'EmployeesEdit', params: { id: employee.id } }">
                                            <button class="btn btn-sm btn-success mx-1">Edit</button>
                                        </router-link>
                                        <button class="btn btn-danger btn-sm mx-1" @click="deleteEmployee(employee.id)">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data : function(){
        return {
            employees:[]
        }
    },
    created(){
        this.getEmployees();
    },
    mounted() {
        console.log('Component mounted.')
    },
    methods : {
        getEmployees(){
            axios.get('/api/employees')
            .then( res => {
                console.log(res.data)
                this.employees = res.data.data; // Laravel resource  is wrapping the response data in a "data" key.
            })
            .catch(error => {
                console.log(error)
            })
        },
        deleteEmployee(id) {
            axios.delete('/api/employees/'+id)
            .then(res => {
                this.getEmployees();
            })
            .catch(error => {
                console.error(error);
            });
        }
    }
}
</script>

<style>
</style>
