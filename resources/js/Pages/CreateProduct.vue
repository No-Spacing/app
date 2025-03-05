<script setup>
import Layout from './Layout/Main.vue'
import { useForm } from '@inertiajs/vue3'
import { useTemplateRef } from "vue";

defineOptions({ layout: Layout })

const form = useForm({
    name: null,
    category: null,
    description: null,
    image: null,
    productDetails: 1,
    date_time: null,
    errorImage: null,
})

const myStepper = useTemplateRef('stepperActions')
    
function submit(){
    form.post('/post-product', {
        preserveScroll: true,
        onSuccess: () => {
            if(form.productDetails == 1){
                myStepper.value.next();
                form.productDetails += 1;
                form.errorImage = null;
            }else if(form.productDetails == 2){  
                myStepper.value.next();
                form.productDetails += 1;
                form.errorImage = null;
            }
              
        },
        onError: (errorImage) => {
            form.errorImage = errorImage;
        }
    })
}

</script>

<template>
    <v-card>
        <v-container fluid>
            <v-card-title>Create Product</v-card-title>
            <v-stepper ref="stepperActions" :items="['Step 1', 'Step 2', 'Step 3']" hide-actions>
                <template v-slot:item.1>
                    <v-card title="Step 1" subtitle="Product Details" flat>
                        <v-form @submit.prevent="submit">
                            <v-card-text>
                                <v-text-field 
                                    v-model="form.name" 
                                    name="name" 
                                    id="name" 
                                    label="Product Name"
                                    :error-messages="form.errors.name"
                                    :counter="20"
                                ></v-text-field>
                                <v-select
                                    label="Category"
                                    v-model="form.category"
                                    :items="items"
                                    :error-messages="form.errors.category"
                                    required
                                ></v-select>
                                <v-textarea 
                                    v-model="form.description" 
                                    name="description" 
                                    id="description" 
                                    label="Description" 
                                    :error-messages="form.errors.description"
                                    :counter="1000" 
                                    required>
                                </v-textarea>
                            </v-card-text>
                            <v-card-actions class="d-flex justify-end">
                                <v-btn 
                                    color="primary"
                                    type="submit"
                                    >
                                    Next
                                </v-btn>
                            </v-card-actions>
                        </v-form>
                    </v-card>
                </template>

                <template v-slot:item.2>
                    <v-card title="Step 2" subtitle="Multiple image picker" flat>
                        <v-container fluid>
                            <v-alert type="error" title="Error" v-if="form.errorImage">
                                    Please upload image only.
                            </v-alert>   
                            <v-form @submit.prevent="submit">
                                <v-card-text>
                                    <v-file-input
                                    v-model="form.image"
                                    label="Browse files..."
                                    multiple
                                    :error-messages="form.errors.image"
                                    prepend-icon="mdi-camera">
                                    </v-file-input>
                                </v-card-text>
                                <v-card-actions class="d-flex justify-end">
                                    <v-btn 
                                    color="primary"
                                    @click="$refs.stepperActions.prev(); form.productDetails = 1 ">
                                        Previous
                                    </v-btn>
                                    <v-btn 
                                        color="primary"
                                        type="submit"
                                        >
                                        Next
                                    </v-btn>
                                </v-card-actions>
                            </v-form>
                        </v-container>
                    </v-card>
                </template>

                <template v-slot:item.3>
                    <v-card title="Step 3" subtitle="Date & Time picker" flat>
                        <v-form @submit.prevent="submit">
                            <v-card-text>
                                <label class="form-label required fw-bold">Date Picker</label>
                                <v-text-field 
                                v-model="form.date_time" 
                                type="datetime-local" 
                                name="date" 
                                id="date"
                                :error-messages="form.errors.date_time"
                                width="250"

                            ></v-text-field>
                            </v-card-text>
                            <v-card-actions class="d-flex justify-end">
                                <v-btn 
                                color="primary"
                                @click="$refs.stepperActions.prev(); form.productDetails = 2">
                                    Previous
                                </v-btn>
                                <v-btn 
                                    color="primary"
                                    type="submit"
                                    >
                                    Submit
                                </v-btn>
                            </v-card-actions>
                        </v-form>
                    </v-card>
                </template>
            </v-stepper>
        </v-container>
    </v-card>
</template>

<script>
    export default {
        data() {
            return { 
                items: [
                    'Category 1',
                    'Category 2',
                    'Category 3',
                    'Category 4',
                ],
            };
        },
    }
</script> 

