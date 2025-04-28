<script setup>
import 'vue3-carousel/carousel.css'
import MainLayout from "@/Layouts/MainLayout.vue";
import {reactive, toRefs} from "vue";
import {Head, Link, router} from '@inertiajs/vue3';

import Cog from 'vue-material-design-icons/Cog.vue';
import Grid from 'vue-material-design-icons/Grid.vue';
import PlayBoxOutline from 'vue-material-design-icons/PlayBoxOutline.vue';
import BookmarkOutline from 'vue-material-design-icons/BookmarkOutline.vue';
import AccoUnitBoxOutline from 'vue-material-design-icons/AccountBoxOutline.vue';

let data=reactive({post:null})
const form=reactive({file:null})
const props =defineProps({postByUser: Object, user:Object})
const {postByUser, user} = toRefs(props)

const getUploadedImage = (e) => {
    form.file = e.target.files[0];
    router.post('/users', form,{
        preserveState: false
    })
};
</script>

<template>
    <head title="Instagram"/>
    <MainLayout>
        <div class="max-w-5xl mx-auto px-4 py-8">
            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-center md:space-x-16">

                <!-- Profile picture -->
                <div class="flex justify-center mb-4 md:mb-0">
                    <img class="w-24 h-24 md:w-36 md:h-36 rounded-full object-cover" src="https://picsum.photos/id/1005/200/200" alt="Profile Picture">
                </div>

                <!-- Profile Info -->
                <div class="flex flex-col w-full">

                    <!-- Username + Edit profile button -->
                    <div class="flex flex-col items-center md:flex-row md:items-center md:justify-start md:space-x-4">
                        <h2 class="text-2xl font-light">username_here</h2>
                        <button class="mt-2 md:mt-0 px-4 py-1 border rounded text-sm font-semibold">Prati</button>
                        <button class="mt-2 md:mt-0 px-2 py-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12h12M6 12l4-4m-4 4l4 4" />
                            </svg>
                        </button>
                    </div>

                    <!-- Stats -->
                    <div class="flex justify-center md:justify-start space-x-6 mt-4 text-sm">
                        <div><span class="font-semibold">54</span> postova</div>
                        <div><span class="font-semibold">834</span> pratilaca</div>
                        <div><span class="font-semibold">162</span> prati</div>
                    </div>

                    <!-- Bio -->
                    <div class="mt-4 text-center md:text-left text-sm">
                        <div class="font-semibold">Ime i Prezime</div>
                        <div>Bio tekstić ovde ✌️</div>
                    </div>

                </div>
            </div>

            <!-- Story Highlights -->
            <div class="flex space-x-6 overflow-x-auto py-6 mt-4 md:mt-10">
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center">
                        <span class="text-sm">+</span>
                    </div>
                    <span class="text-xs mt-2">New</span>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 rounded-full overflow-hidden">
                        <img src="https://picsum.photos/id/1006/200/200" class="object-cover w-full h-full">
                    </div>
                    <span class="text-xs mt-2">Story 1</span>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 rounded-full overflow-hidden">
                        <img src="https://picsum.photos/id/1008/200/200" class="object-cover w-full h-full">
                    </div>
                    <span class="text-xs mt-2">Story 2</span>
                </div>
                <!-- Dodaj još ako treba -->
            </div>

            <!-- Tabs -->
            <div class="border-t border-gray-300 mt-8 flex justify-center space-x-8 text-xs md:text-sm font-semibold uppercase text-gray-500">
                <button class="py-3 border-t-2 border-black text-black">Objave</button>
                <button class="py-3">Reels</button>
                <button class="py-3">Označeno</button>
            </div>

            <!-- Posts Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 gap-1 mt-1">
                <div class="relative w-full aspect-square overflow-hidden group">
                    <img src="https://picsum.photos/id/1012/400/400" class="object-cover w-full h-full group-hover:opacity-80 transition">
                </div>
                <div class="relative w-full aspect-square overflow-hidden group">
                    <img src="https://picsum.photos/id/1013/400/400" class="object-cover w-full h-full group-hover:opacity-80 transition">
                </div>
                <div class="relative w-full aspect-square overflow-hidden group">
                    <img src="https://picsum.photos/id/1015/400/400" class="object-cover w-full h-full group-hover:opacity-80 transition">
                </div>
                <div class="relative w-full aspect-square overflow-hidden group">
                    <img src="https://picsum.photos/id/1020/400/400" class="object-cover w-full h-full group-hover:opacity-80 transition">
                </div>
                <div class="relative w-full aspect-square overflow-hidden group">
                    <img src="https://picsum.photos/id/1025/400/400" class="object-cover w-full h-full group-hover:opacity-80 transition">
                </div>
            </div>
        </div>
    </MainLayout>

</template>
<style>
.carousel__prev,
.carousel__next,
.carousel__prev:hover,
.carousel__next:hover {
    color: rgb(49,49,49);
    background-color: rgb(255,255,255);
    border-radius: 100%;
    margin: 0 20px;
}
</style>
