<template>
    <div class="card card-dark shadow-lg border">
        <div class="card-header">
            <h3 class="card-title mt-2">Users:</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                <!--<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>-->
            </div>
        </div>

        <div class="card-body">
            <button type="button" class="btn btn-info mb-3" data-toggle="modal" data-target="#createUser">
                <i class="fas fa-user-plus mr-3"></i>Create
            </button>
            <table class="table table-bordered table-hover dataTable text-center example2 p-1">
                <thead class="bg-light">
                <tr>
                    <th>#</th>
                    <!-- <th>Address ID</th>-->
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <!-- <th>Edit</th>
                     <th>Status</th>-->
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="user in users" :key="user.id">
                    <td>{{ user.id }}</td>
                    <td>1</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.role }}</td>
                    <td>{{ user.created_at | customDate }}</td>
                    <td>{{ user.updated_at | customDate }}</td>
                    <td class="d-flex align-items-center justify-content-around">
                        <div>
                            <button class="btn btn-xs bg-secondary text-white p-1 px-2">Profile</button>
                        </div>
                        <div>
                            <button class="btn btn-xs bg-primary text-white p-1 px-2">Edit</button>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <!-- Modal Create User-->
        <div class="modal fade" id="createUser" tabindex="-1" role="dialog" aria-labelledby="createUserCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createUserLongTitle">Create User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="createUser">
                        <div class="modal-body">
                            <div class="form-group w-25">
                                <label for="role_id">User Role:</label>
                                <select v-model="role" name="role_id" id="role_id" class="form-control">
                                    <option value="">Select User Role</option>
                                    <option value="Administrator">Administrator</option>
                                    <option value="Customer">Customer</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" v-model="name" name="name" id="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" v-model="email" name="email" id="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" v-model="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
                                <button type="submit" class="btn btn-info">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Modal User-->--}}
        </div>
    </div>
</template>

<script>
    export default {
        name: "Users",
        data() {
            return {
                users : {},
                role: '',
                name: '',
                email: '',
                password: '',
            }
        },
        methods : {
            loadUsers(){
                axios.get('api/user').then(( data ) => (this.users = data.data));
            },
            createUser(){
                axios.post('api/user', {
                    role: this.role,
                    name: this.name,
                    email: this.email,
                    password: this.password,
                });
            }
        },
        created() {
            this.loadUsers();
        }
    }
</script>

<style scoped>

</style>
