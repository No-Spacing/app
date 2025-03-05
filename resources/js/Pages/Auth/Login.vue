<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
    username: null,
    password: null,
    remember: false,
})
</script>

<template>
   
    <v-container fluid height="1920px">
        <v-row class="d-flex justify-center align-center" >
            <v-col cols="12" sm="4" class="fill-height">
                <v-card :loading="form.processing" width="300px"  >

                    <v-card-title>Login</v-card-title>
                    <v-card-subtitle>Login Form</v-card-subtitle>

                    <form @submit.prevent="form.post('/PostLogin')">
                        <v-card-text>
                            <v-alert
                            v-if="$page.props.flash.message"
                            type="warning"
                            class="mb-4"
                            >
                                {{ $page.props.flash.message }}
                            </v-alert>

                            <v-text-field
                            v-model="form.username"
                            :error-messages="form.errors.username"
                            label="Username"
                            ></v-text-field>

                            <v-text-field
                            v-model="form.password"
                            :error-messages="form.errors.password"
                            label="Password"
                            type="password"
                            ></v-text-field>

                            <v-checkbox
                            v-model="form.remember"
                            label="Remember Me"
                            type="checkbox"
                            ></v-checkbox>
                        </v-card-text>

                        <v-divider></v-divider>

                        <v-card-actions>
                            <v-btn
                            class="me-4"
                            type="submit"
                            :loading="form.processing"
                            block
                            variant="tonal"
                            >
                            Login
                            </v-btn>
                        </v-card-actions>
                    </form>

                    </v-card>
            </v-col>
        </v-row>
    </v-container>
        
</template>
