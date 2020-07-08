<template>
    <div class="container-fluid">
        <!--add modal employee-->
        <div class="action-header d-flex flex-row-reverse mb-3">
            <button type="button" class="btn btn-primary" @click="openModal('Add',null)">Add Employee</button>
        </div>
        <div class="modal fade" id="employeeModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" >
            <div class="modal-dialog " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">{{modalAction}} Employee</h5>
                        <button type="button" class="close" @click="closeModal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex m-2">
                            <div class="d-flex flex-column">
                                <h6 class="mb-0">First Name</h6>
                                <input v-model="employeeProps.firstName" type="text" class="form-control" id="first_name" placeholder="Enter First Name">
                            </div>
                            <div class="d-flex flex-column ml-2">
                                <h6 class="mb-0">Middle Name</h6>
                                <input v-model="employeeProps.middleName" type="text" class="form-control" id="middle_name" placeholder="Enter Middle Name">
                            </div>
                            <div class="d-flex flex-column ml-2">
                                <h6 class="mb-0">Last Name</h6>
                                <input v-model="employeeProps.lastName" type="text" class="form-control" id="last_name" placeholder="Enter Last Name">
                            </div>
                        </div>
                        <div class="d-flex m-2">
                            <div class="d-flex flex-column ">
                                <h6 class="mb-0">Employee #</h6>
                                <input v-model="employeeProps.employeeId" type="text" class="form-control" id="employee_number" placeholder="Enter Employee #">
                            </div>
                            <div class="d-flex flex-column ml-2">
                                <h6 class="mb-0">Contact #</h6>
                                <input v-model="employeeProps.number" type="text" class="form-control" id="contact_number" placeholder="Enter Contact #">
                            </div>
                            <div class="d-flex flex-column ml-2">
                                <h6 class="mb-0">Birthday</h6>
                                <div style="margin-top: 3px">
                                    <date-picker v-model="employeeProps.birthday" valueType="YYYY-MM-DD"></date-picker>
                                </div>
                            </div>
                        </div>
                        <form>
                            <div class="form-group m-2">
                                <h6 class="mb-0">Address</h6>
                                <textarea v-model="employeeProps.address" class="form-control" id="address" rows="3" placeholder="Enter Address"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="closeModal" >Close</button>
                        <button type="button" class="btn btn-primary" @click="saveEmployee">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <!--table Employee-->
        <div class="table-container">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Employee #</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Birthday</th>
                    <th scope="col">Contact #</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(employee, index) in employees" :key="employee.id">
                    <th scope="row">{{employee.id}}</th>
                    <td>{{employee.first_name}} {{employee.middle_name}} {{employee.last_name}}</td>
                    <td>{{employee.birthday}}</td>
                    <td>{{employee.number}}</td>
                    <td>
                        <button type="button" class="btn btn-info btn-sm" @click="openModal('Edit',employee)">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm" @click="deleteEmployee(employee.id)">Delete</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div v-if="employees.length == 0" class="no-record">No Record Found</div>
        <div class="pagination-container d-flex flex-row-reverse">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>


    </div>
</template>

<script>
    import DatePicker from 'vue2-datepicker';
    import 'vue2-datepicker/index.css';

    export default {
        data() {
            return {
                employees: [],
                pagination: null,
                loading: false,
                employeeProps:{
                    id: null,
                    firstName: "",
                    middleName: "",
                    lastName: "",
                    birthday: "",
                    address: "",
                    employeeId:"",
                    number:"",
                },
                showModal: false,
                modalAction: "",
                modalTitle: "",
            }
        },
        mounted() {
            this.loadEmployeeData();
            $('#employeeModal').modal('hide');
        },
        methods: {
            clearEmployee() {
                this.employeeProps.id = "";
                this.employeeProps.address = "";
                this.employeeProps.birthday = "";
                this.employeeProps.employeeId = "";
                this.employeeProps.number = "";
                this.employeeProps.firstName = "";
                this.employeeProps.middleName = "";
                this.employeeProps.lastName = "";
            },
            async closeModal(){
                $('#employeeModal').modal('hide');
                this.clearEmployee();
            },
            async openModal(action, employee){

                this.modalAction = action;
                if (action === "Edit"){
                    this.employeeProps.id = employee.id;
                    this.employeeProps.address = employee.address;
                    this.employeeProps.birthday = employee.birthday;
                    this.employeeProps.employeeId = employee.employee_id;
                    this.employeeProps.number = employee.number;
                    this.employeeProps.firstName = employee.first_name;
                    this.employeeProps.middleName = employee.middle_name;
                    this.employeeProps.lastName = employee.last_name;
                }
                $('#employeeModal').modal('show');
            },
            async saveEmployee(){

                if(this.modalAction === "Add"){
                    this.addEmployee();
                }else {
                    this.editEmployee(this.employeeProps.id);
                }
                $('#employeeModal').modal('hide');
            },
            async addEmployee(){
                await axios.post('employee',this.employeeProps)
                    .then((response)=>{
                        console.log(response.data);
                        this.loadEmployeeData();
                    }).catch(error =>{
                        console.log(error);
                    });
            },
            async deleteEmployee(id){
                await axios.delete('employee/'+id)
                    .then((response)=>{
                        this.loadEmployeeData();
                    }).catch(error =>{
                    console.log(error);
                });
            },
            async editEmployee(id){
                await axios.put('employee/'+id, this.employeeProps)
                    .then((response)=>{
                        console.log(response.data);
                        this.loadEmployeeData();
                    }).catch(error =>{
                        console.log(error);
                    });
            },
            async loadEmployeeData(){
                try{
                    await axios.get('employee')
                        .then((response) => {
                            this.employees = response.data;
                        }).catch((error) => {
                        console.log(error);
                    });
                }catch(err){
                    console.log(err)
                }
            }
        }
    }
</script>

<style>
    .no-record{
        text-align: center;
        font-size: 20px;
        opacity: .5;
    }
    .mx-datepicker{
        width: 145px;
    }
</style>