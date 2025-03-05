<script setup>
import Layout from './Layout/Main.vue'
defineOptions({ layout: Layout })

defineProps({ videoFile: Object })

</script>
<template>
    <v-card title="Videos" subtitle="Bonus objective">
        <v-card-text>
            <v-container fluid> 
                <video
                id="my-video"
                class="video-js"
                controls
                preload="auto"
                width="640"
                height="264"
                poster=""
                autoplay
                data-setup="{}"
                >
                    <source v-bind:src="videoFile?.video_url" type="video/mp4" />
                    
                    <p class="vjs-no-js">
                        To view this video please enable JavaScript, and consider upgrading to a
                        web browser that
                        <a href="https://videojs.com/html5-video-support/" target="_blank"
                        >supports HTML5 video</a
                        >
                    </p>
                </video>
                <v-col cols="8" justify="space-between">
                    <v-btn href="/videos/1">Sunflower</v-btn>
                    <v-btn href="/videos/2" class="mx-2">Chemical</v-btn>
                </v-col>
            </v-container>
        </v-card-text>
    </v-card>
</template>
