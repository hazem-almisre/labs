<template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb mt-3 bg-white shadow">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">All Offer</li>
        </ol>
        <!-- Icon Cards-->
        <div class="row card  ml-3 mr-3 shadow" style="padding:0">
            <div class="card-header text-dark" style="font-size: 20px; font-weight:700;">
                <i class="fas fa-chart-area"></i>
                All Offer
                <router-link to="/store-supplier" class="btn btn-success"
            style="border-radius: 20px" id="add_new"> Add New</router-link>
            </div>
            <div class="card-body pt-0">
                <div class="card-body">
                    <div class="table-responsive">
                        <label class="d-inline">Search : </label>      <!-----f----->
                        <input type="text" v-model="searchTerm" class="form-control d-inline" style="width:200px;" placeholder="Search by name"><br> <br>
                        <table class="table table-striped table-hover table-bordered  border-white" id="" width="100%" cellspacing="0">
                            <thead>
                            <tr class="bg-dark text-white">
                                <th>DateEnd</th>
                                <th>Photo</th>
                                <th>LabName</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr v-for="supplier in filtersearch" :key="supplier.id">
                                <td>{{ supplier.name }}</td>
                                <td><img :src="supplier.photo" id="em_photo"></td>
                                <td>{{ supplier.phone }}</td>
                                <td>{{ supplier.shopname }}</td>
                                <td>{{ supplier.address }}</td>
                                <td>
                                    <router-link :to="{name: 'edit-supplier', params:{id: supplier.id} }" class="btn btn-sm btn-info">Edit</router-link>
                                    <!-- <router-link :to="'/edit-category/'+category.id" class="btn btn-warning mr-1">Edit</router-link> --> <!--or, -->
                                    <!-- <router-link :to="`/edit-category/${category.id}`" class="btn btn-sm btn-primary text-white">Edit</router-link> -->
                                    <a @click="deleteSupplier(supplier.id)" class="btn btn-sm btn-danger text-white">Delete</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
            </div>
        </div>
    </div>
</template>


<script>
    export default {
        mounted(){
            if (!User.loggedIn()) {
                this.$router.push({ name:'/' })
            }
        },
        created(){
            this.allSupplier();
        },
        data(){
            return{
                suppliers:[],
                searchTerm:'',
            }
        },
        computed:{
            filtersearch(){
                return this.suppliers.filter(supplier => {
                    //return supplier.phone.match(this.searchTerm)
                    return supplier.name.toLowerCase().match(this.searchTerm.toLowerCase())
                    // let searchLowerCase = supplier.name.toLowerCase()
                    // return searchLowerCase.match(this.searchTerm.toLowerCase())
                })
            }
        },
        methods:{
            allSupplier(){
                axios.get('/api/supplier/')
                    .then(({data}) => (this.suppliers = data))
                    .catch()
            },
            deleteSupplier(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        axios.delete('/api/supplier/'+id)
                            .then(()=>{
                                this.suppliers = this.suppliers.filter(supplier =>{
                                    return supplier.id !=id
                                })
                            })
                            .catch(()=>{
                                this.$router.push({name: 'supplier'})
                            })
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            }
        },
    }
</script>


<style>
    #add_new{
        float: right;
    }
    #em_photo{
        height: 40px;
        width: 40px;
    }
</style>
