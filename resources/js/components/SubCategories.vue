<template>
    <div class="container">
        <div class="col-8 offset-2 my-4">
            <div class="card card-dark shadow-lg border">
                <div class="card-header">
                    <h3 class="card-title mt-2">Sub Categories:</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <button @click="showCreateModal = true" type="button" class="btn btn-info mb-3 shadow">
                        <i class="fas fa-plus mr-3"></i>Create
                    </button>
                    <div class="justify-content-center w-100">
                        <div v-if="successMessage" class="alert alert-success text-center">Success Message</div>
                    </div>
                    <table class="table table-bordered table-hover dataTable text-center example2 p-1">
                        <thead class="bg-light">
                        <tr>
                            <th>#</th>
                            <th>SubCategories</th>
                            <!--<th>Created</th>
                            <th>Updated</th>-->
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="subcategory in subcategories" :key="subcategory.id">
                            <td>{{ subcategory.id }}</td>
                            <td>{{ subcategory.name}}</td>
                            <!--<td>2020-06-05</td>
                            <td>2020-06-05</td>-->
                            <td class="d-flex align-items-center justify-content-around">
                                <div>
                                    <button @click="showEditModal = true" class="btn btn-xs bg-primary text-white p-1 px-2 shadow">Edit</button>
                                </div>
                                <div>
                                    <button @click="showDeleteModal = true" class="btn btn-xs btn-danger p-1 px-2 shadow">Delete</button>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modals Start -->
        <!-- Modal Create Subcategory -->
        <div class="overlay" v-if="showCreateModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-navy">
                        <h5 class="modal-title">Create SubCategory</h5>
                        <button @click="showCreateModal = false" type="button" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-4">
                        <form @submit.prevent="createSubcategory">
                            <div class="from-group">
                                <label>SubCategory Name:</label>
                                <input type="text" name="name" v-model="name" class="form-control">
                            </div>
                            <div class="modal-footer p-0">
                                <button type="submit" class="btn btn-info shadow mt-4">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Create Subcategory Ends-->
        <!-- Modal Edit Subcategory -->
        <div class="overlay" v-if="showEditModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-navy">
                        <h5 class="modal-title">Edit SubCategory</h5>
                        <button @click="showEditModal = false" type="button" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-4">
                        <form action="" method="post">
                            <div class="from-group">
                                <label>SubCategory Name:</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="modal-footer p-0">
                                <button type="submit" class="btn btn-warning shadow mt-4">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Edit Subcategory Ends-->
        <!-- Modal Delete Subcategory -->
        <div class="overlay" v-if="showDeleteModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-danger">
                        <h5 class="modal-title">Delete SubCategory</h5>
                        <button @click="showDeleteModal = false" type="button" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-4">
                        <p class="text-center">Are you sure you want to delete this?</p>
                    </div>
                    <div class="modal-footer">
                        <button @click="showDeleteModal = false" type="button" class="btn btn-secondary shadow mr-3">Cancel</button>
                        <button type="submit" class="btn btn-danger shadow">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Delete Subcategory Ends-->
    </div>
</template>

<script>
    export default {
        name: "SubCategories",
        data() {
            return {
                //Code op false zetten en op plaats een v-if="" plaatsen
                successMessage: false,
                showCreateModal: false,
                showEditModal: false,
                showDeleteModal: false,
                subcategories: [],
                name: ''
            }
        },
        methods: {
            createSubcategory() {
                console.log('Submitted!!')
                    axios.post('/API/Subcategory', {
                        name: this.name
                }).then( response => {
                    console.log(response);
                    }).catch(error => {
                        console.log(error);
                    });
            }
        },
        mounted: function () {
            axios.get('/API/Subcategory')
                .then( response => {
                    console.log(response.data);
                    this.subcategories = response.data;
                });
            /*.then(( data ) => (this.subcategories = data.data));*/
        }
    }
</script>

<style scoped>
    /*Overlay stylen die background van MODAL is*/
    .overlay {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.6);
    }
</style>
