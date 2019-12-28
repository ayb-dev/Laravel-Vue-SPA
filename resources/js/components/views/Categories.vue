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
                            <td>#</td>
                            <td>Name</td>
                            <td>Image</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(category, index) in categories" :key="index">
                            <td>{{ index+1 }}</td>
                            <td>{{ category.name }}</td>
                            <td><img class="table-image" :src="`${$store.state.serverPath}/storage/${category.image}`" :alt="category.name"></td>
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
                        <input type="text" class="form-control" v-model="categoryData.name" id="name" placeholder="Enter category name" />
                            
                        <div class="invalid-feedback" v-if="errors.name">{{ errors.name[0] }}</div>

                    </div>
                    <div class="form-group">
                        <label for="image">Category name</label>
                        <div v-if="categoryData.image.name">
                            <img ref="newCategoryImageDisplay" class="w-150px" />
                        </div>
                        <input type="file" v-on:change="attachImage" ref="newCategoryImage" class="form-control" id="image">

                        <div class="invalid-feedback" v-if="errors.image">{{ errors.image[0] }}</div>

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
import * as categoryService from '../../services/category_service'
export default {
    name: 'category',
    data() {
        return {
            categories: [],
            categoryData: {
                name: '',
                image: '',
            },
            errors: {}
        }
    },
    mounted(){
        this.loadcategories();
    },
    methods: {
        loadcategories: async function(){
            try{
                const response = await categoryService.loadCategories();
                console.log(response);
                this.categories = response.data.data;
                console.log(this.categories);
            }catch(error){
                this.flashMessage.error({
                    message: 'Some error ocured, please try again.',
                    time: 5000
                });
            }
        },
        attachImage(){
            this.categoryData.image = this.$refs.newCategoryImage.files[0];
            let reader = new FileReader();
            reader.addEventListener('load', function(){
                this.$refs.newCategoryImageDisplay.src = reader.result;
            }.bind(this), false);

            reader.readAsDataURL(this.categoryData.image);
        },
        hideNewCategoryModal(){
            this.$refs.newCategoryModal.hide()
        },
         showNewCategoryModal(){
            this.$refs.newCategoryModal.show()
        },
        createCategory: async function(){
            let formData = new FormData();
            formData.append('name', this.categoryData.name);
            formData.append('image', this.categoryData.image);

            try{
                const response = await categoryService.createCategory(formData);
                this.categories.unshift(response.data);

                this.hideNewCategoryModal();
                this.flashMessage.success({
                    message: 'Category stored successfuly.',
                    time: 5000
                });
            }catch(error){
                switch (error.response.status) {
                    case 422:
                        this.errors = error.response.data.errors;
                        break;
                    default:
                        this.flashMessage.error({
                            message: 'Some error ocured, please try again.',
                            time: 5000
                        });
                        break;
                }
            }
        }
    }
}
</script>
