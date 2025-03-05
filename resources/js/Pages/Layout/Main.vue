<template>

    <v-layout>

        <v-navigation-drawer
            v-model="drawer"
            expand-on-hover
            :rail="rail"
            @click="rail = false"
        >
            <v-list>
            <v-list-item
                prepend-icon="mdi-account-circle"
                title=""
            >{{ $page.props.admin.username }}</v-list-item>
            </v-list>

            <v-divider></v-divider>

            <v-list density="compact" nav>
                <v-list-item href="/dashboard" prepend-icon="mdi-view-dashboard" title="Dashboard"></v-list-item>
                <v-list-item href="/products" prepend-icon="mdi-alpha-p-box" title="Products"></v-list-item>
                <v-list-item href="/create-product" prepend-icon="mdi-plus-box" title="Create Products"></v-list-item>
                <v-list-item href="/videos" prepend-icon="mdi-play-box" title="Videos"></v-list-item>
            </v-list>

            <template v-slot:append>

                <v-list density="compact" nav>
                    <v-list-item href="/logout" prepend-icon="mdi-logout" title="Logout"></v-list-item>
                </v-list>
                <!-- <v-btn 
                :loading="loading" 
                icon="mdi-logout"
                @click="load()"
                href="/logout" 
                ></v-btn> -->
        
            </template>
        </v-navigation-drawer>


        <v-app-bar color="primary">
            <v-app-bar-nav-icon variant="text" @click.stop="rail = !rail"></v-app-bar-nav-icon>

            <template v-if="$vuetify.display.mdAndUp">
                <v-btn variant="plain" href="/dashboard":ripple="false">Home</v-btn>

                <v-btn variant="plain" :ripple="false">About</v-btn>
            </template>
            
        </v-app-bar>

       
        <v-main>
            <v-container fluid>
                <slot />
            </v-container>
        </v-main>
    </v-layout>
 
</template>
<script>
    export default {
        data () {
            return {
                loading: false,
                drawer: true,
                rail: true,
            }
        },
        methods: {
            load() {
                this.loading = true
            }
        },
    }
</script>