<script setup>
import Layout from './Layout/Main.vue'
import { useForm } from '@inertiajs/vue3'

defineOptions({ layout: Layout })

const form = useForm({
    categories: null
})

</script>
<template>
    <div class="d-flex justify-center">
        <v-card class="w-100">
           <v-container fluid>
                <v-card-title>
                    Products
                </v-card-title>
                <v-card-text>
                    <div class="container">
                        <v-btn color="success" href="/create-product" class="mb-3" prepend-icon="mdi-plus-circle">Create</v-btn>
                        <v-text-field
                        v-model="search"
                        append-icon="search"
                        label="Search"
                        ></v-text-field>
                        <v-form @submit.prevent="filter(category)">
                            <v-select v-model="category" :items="categories" label="Filter"></v-select>
                            <v-row class="ml-5"> 
                                <v-btn type="submit" class="mx-1">Apply Filters</v-btn>
                                <v-btn href="/products" class="mx-1">Remove Filters</v-btn>
                            </v-row>
                        </v-form>
                    </div>
                    
                    <v-data-table 
                        class="mt-6"
                        :search="search"
                        :headers="headers"
                        :items="products"
                        v-model:items-per-page="itemsPerPage">
                        <template v-slot:item.action="{ item }">
                            <v-btn
                                class="mx-1 mdi mdi-update bg-yellow"
                                @click="edit(item)"
                                >
                                Update
                            </v-btn>
                            <v-btn 
                                class="mx-1 mdi mdi-trash-can bg-red" 
                                @click="submit(item.id)"
                                >
                                Delete
                            </v-btn>
                        </template>
                    </v-data-table>
                    <v-dialog
                    v-model="dialog"
                    width="520px">
                        <v-card>
                            <v-container fluid>
                                    <v-card-title>
                                        Update Product
                                    </v-card-title>
                                    <v-form @submit.prevent="update">
                                        <v-card-text>   
                                                <v-text-field 
                                                    v-model="form.name" 
                                                    label="Name"
                                                    :error-messages="$page.props.errors.name"
                                                ></v-text-field>
                                                <v-select
                                                    :items="items"
                                                    v-model="form.category" 
                                                    label="Category"
                                                    :error-messages="$page.props.errors.category"
                                                ></v-select>
                                                <v-textarea
                                                    v-model="form.description" 
                                                    label="Description"
                                                    :error-messages="$page.props.errors.description"
                                                ></v-textarea>
                                                <v-text-field
                                                    v-model="form.date_time" 
                                                    type="datetime-local" 
                                                    name="date" 
                                                    id="date"
                                                    label="Date & Time"
                                                    :error-messages="$page.props.errors.date_time"
                                                ></v-text-field>
                                            
                                        </v-card-text>
                                        <v-card-actions class="justify-end">
                                            <v-btn color="primary" @click="dialog = false">Close</v-btn>
                                            <v-btn type="submit">Update</v-btn>
                                        </v-card-actions>
                                    </v-form>
                            </v-container>
                        </v-card>
                    </v-dialog>
                </v-card-text>
           </v-container>
        </v-card>
    </div>
</template>

<script>
export default {
    props: {
        products: Object,
    },
    data () {
        return {
            search: '',
            itemsPerPage: 5,
            headers: [
                { title: 'Name', value: 'name' },
                { title: 'Category', value: 'category' },
                { title: 'Description', value: 'description' },
                { title: 'Date & Time', value: 'date_time' },
                { title: 'Actions', value: 'action' },
              
            ],
            category: null,
            categories: [
                'Category 1',
                'Category 2',
                'Category 3',
                'Category 4',
            ],
            items: [
                'Category 1',
                'Category 2',
                'Category 3',
                'Category 4',
            ],
            dialog: false,
            form: { 
                name: '',
                category: '',
                description: '',
                date_time: '',
            }
        }
    },
    methods: {

        filter: function(category) {
            this.$inertia.get('/filter-products/' + category);
        },
        
        submit: function (id) {
            if (confirm("Are you sure you want to delete this data?")) {
                this.$inertia.delete('/delete-product/' + id);
            }
        },
        edit: function (data) {
            this.form = Object.assign({}, data);
            this.dialog = true;
        },
        update: function() {
            this.$inertia.post('/update-product', this.form,
            {
                onSuccess: () => { 
                    alert("Success");
                    this.dialog = false;
                },
            });
            
        }
    },
}; 
</script>