<template>
    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <router-link to="/">Dashboard</router-link>
            </li>
            <li class="breadcrumb-item active">Categories</li>
        </ol>

        <!-- Area Chart Example-->
        <div class="card mb-3">
            <div class="card-header d-flex">
                <span>
                <i class="fas fa-chart-area"></i>
                Categories Management
                </span>
                
                <button class="btn btn-primary btn-sm ml-auto" v-on:click="showNewCategoryModal"><span class="fa fa-plus"></span> Create new</button>

            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Name</td>
                            <td>Image</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>T-shirt</td>
                            <td>Image</td>
                            <td>
                                <button class="btn btn-primary btn-sm"><span class="fa fa-edit"></span></button>
                                <button class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <b-modal ref="newCategoryModal" hide-footer title="Add new category">
            <div class="d-block">
                <form v-on:submit.prevent="createCategory">
                    <div class="form-group">
                        <label for="name">Category name</label>
                        <input type="text" class="form-control" v-model="categoryData.name" id="name" placeholder="Enter category name">
                    </div>
                    <div class="form-group">
                        <label for="image">Category name</label>
                        <input type="file" v-on:change="attachImage" class="form-control" id="image">
                    </div>

                    <hr>

                    <div class="text-right">
                        <button type="button" class="btn btn-default" v-on:click="hideNewCategoryModal">Cancel</button>
                        <button type="submit" class="btn btn-primary"><span class="fa fa-check"></span>Save</button>
                    </div>
                </form>
            </div>
        </b-modal>

    </div>
</template>

<script>
export default {
    name: 'category',
    data() {
        return {
            categoryData: {
                name: '',
                image: '',
            }
        }
    },
    methods: {
        attachImage(){
            //to do
        },
        hideNewCategoryModal(){
            this.$refs.newCategoryModal.hide()
        },
         showNewCategoryModal(){
            this.$refs.newCategoryModal.show()
        },
        createCategory(){
            console.log('form submitted');
        }
    }
}
</script>