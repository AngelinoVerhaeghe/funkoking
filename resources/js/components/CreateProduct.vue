<template>
    <div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="modal fade" id="createProduct" tabindex="-1" role="dialog" aria-labelledby="createProductCenterTitle"
                         aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                            <div class="modal-content rounded-0">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="createProductLongTitle">Create Product</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form>
                                    <div class="modal-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="form-group w-25">
                                                <label for="category_id">Category:</label>
                                                <select class="form-control rounded-0" v-model="category_id" name="category_id" id="category_id" required>
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                </select>
                                            </div>
                                            <div class="form-group w-25">
                                                <label for="subcategory_id">SubCategory:</label>
                                                <select class="form-control rounded-0" v-model="subcategory_id" name="subcategory_id" id="subcategory_id" required>
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                </select>
                                            </div>
                                            <div class="form-group w-25">
                                                <label for="price">Price:</label>
                                                <input type="number" v-model="price" name="price" id="price" class="form-control rounded-0" step="0.01" required>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="form-group">
                                                <label for="photo_id">Product Photo:</label>
                                                <input type="file" v-on:change="photo_id" name="photo_id" id="photo_id" class="form-control-file">
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <img id="target" class="img-thumbnail" height="150" width="150"
                                                     src="http://place-hold.it/150x150?text=Select Product Image" alt="Product Picture">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Product Name:</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"><i class="fab fa-product-hunt"></i></span>
                                                </div>
                                                <input type="text" v-model="name" name="name" id="name" class="form-control" aria-label="Username"
                                                       aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="title">Title:</label>
                                            <input type="text" v-model="title" name="title" id="title" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="subtitle">Short-Description:</label>
                                            <input type="text" v-model="subtitle" name="subtitle" id="subtitle" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description:</label>
                                            <textarea v-model="description" name="description" id="description" class="form-control" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary rounded-0" data-dismiss="modal">Back</button>
                                        <button type="submit" @click.prevent="saveProduct" class="btn btn-info rounded-0">Create</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from "axios";
    export default {
        name: "CreateProduct.vue",
        data: function () {
            return{
                name : '',
                title : '',
                subtitle : '',
                description : '',
                price : '',
                photo_id : '',
                category_id : '',
                subcategory_id : '',
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods : {
            saveProduct(){
                axios.post('save_product', {
                    name : this.name,
                    title : this.title,
                    subtitle : this.subtitle,
                    description : this.description,
                    price : this.price,
                    photo_id : this.photo_id,
                    category_id : this.category_id,
                    subcategory_id : this.subcategory_id,
                })
                .then((response) => {
                    console.log(response)
                });
            }

        },
    }
</script>

<style scoped>

</style>
