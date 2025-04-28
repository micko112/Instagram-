<script setup>
import 'vue3-carousel/carousel.css'
import MainLayout from "@/Layouts/MainLayout.vue";
import {reactive, toRefs} from "vue";
import {Head, Link, router} from '@inertiajs/vue3';

import Cog from 'vue-material-design-icons/Cog.vue';
import Grid from 'vue-material-design-icons/Grid.vue';
import PlayBoxOutline from 'vue-material-design-icons/PlayBoxOutline.vue';
import BookmarkOutline from 'vue-material-design-icons/BookmarkOutline.vue';
import AccountBoxOutline from 'vue-material-design-icons/AccountBoxOutline.vue';

import ContentOverlay from "@/Components/ContentOverlay.vue";
let data = reactive({post: null})
const form = reactive({file: null})
const props = defineProps({postByUser: Object, user: Object})
const {postByUser, user} = toRefs(props)

const getUploadedImage = (e) => {
    form.file = e.target.files[0];
    router.post('/users', form, {
        preserveState: false
    })
};
</script>

<template>
    <head title="Instagram"/>
    <MainLayout>
        <div class="max-w-5xl lg:ml-0 md:ml-[80px] w-[100vw] mx-auto px-4 py-8">
            <!-- Header: profilna + ime + dugme + stats -->
            <div class="flex items-center md:justify-between md:flex-row md:items-center md:space-x-16">

                <!-- Profilna slika -->
                <label for="fileUser">
                    <img class="w-[100px]  md:w-[170px]  rounded-full object-fit cursor-pointer"
                         src="https://picsum.photos/id/51/170/170" alt="Profile Picture">
                </label>
                <input
                    id="fileUser"
                    class="hidden"
                    type="file"
                    @input="$event=>getUploadedImage($event)"
                >
                <!-- Info -->
                <div class="ml-6 w-full   ">
                    <div class="flex md:flex-row items-center md:mb-8 mb-5 space ">
                        <div class="md:mr-6 mr-3 rounded-lg text-[18px] font-light">username_here</div>
                        <button
                            class=" md:block hidden md:mr-6 p-1 px-4 border rounded-lg  text-sm font-semibold bg-gray-100 hover:bg-gray-200">
                            Edit Profile
                        </button>
                        <button
                            class="md:block hidden md:mr-6 p-1 px-4 border rounded-lg  text-sm font-semibold bg-gray-100 hover:bg-gray-200">
                            View Archive
                        </button>
                        <Cog class="cursor-pointer"/>
                    </div>
                    <button
                        class=" md:hidden mr-6 p-1 px-4 max-w-[260px] border rounded-lg  text-sm font-semibold bg-gray-100 hover:bg-gray-200">
                        Edit Profile
                    </button>
                    <button
                        class=" md:hidden mr-6 p-1 px-4 max-w-[260px] border rounded-lg  text-sm font-semibold bg-gray-100 hover:bg-gray-200">
                        View Archive
                    </button>

                    <!-- Stats -->
                    <div class="md:block hidden ">
                        <div class="flex items-center text-sm">
                            <div class="mr-6"><span class="font-semibold">54</span>posts</div>
                            <div class="mr-6"><span class="font-semibold">834</span>followers</div>
                            <div class="mr-6"><span class="font-semibold">162</span>following</div>
                        </div>
                    </div>
                    <div class="text-sm">
                        <div class="font-semibold">Ime i Prezime</div>
                        <div>Bio tekstić ovde ✌️</div>
                    </div>
                    <!--                    Za manje ekrane-->

                </div>
            </div>
            <div class="md:hidden ">
                <div class="w-full flex items-center justify-around text-sm border-t border-t-gray-300 mt-8 ">
                    <div class="text-center p-3">
                        <div class="font-extrabold">3</div>
                        <div class="text-gray-400 font-semibold -mt-1.5">posts</div>
                    </div>
                    <div class="text-center p-3">
                        <div class="font-extrabold">604</div>
                        <div class="text-gray-400 font-semibold -mt-1.5">followers</div>
                    </div>
                    <div class="text-center p-3">
                        <div class="font-extrabold">632</div>
                        <div class="text-gray-400 font-semibold -mt-1.5">following</div>
                    </div>
                </div>
            </div>
            <!--                Content section-->
            <div id="contentSection" class="md:pr-1.5 lg:pl-[90px]">
                <div class="  border-t border-t-gray-300">
                    <div
                        class="flex items-center justify-between max-w-[600px] mt-auto font-extraboldborder-t border-t-gray-300 text-sm">
                        <div class="p-[17px] w-1/4 flex justify-center items-center border-t border-t-gray-900 ">
                            <Grid :size="23" fillColor="#00000" class="cursor-pointer"/>
                            <div class="md:block hidden ml-2 -mb-[1px] text-gray-900">POSTS</div>
                        </div>
                        <div class="p-[17px] w-1/4 flex justify-center items-center border-t  ">

                            <PlayBoxOutline :size="23" fillColor="#00000" class="cursor-pointer"/>
                            <div class="md:block hidden ml-2 -mb-[1px] text-gray-900">REELS</div>
                        </div>
                        <div class="p-[17px] w-1/4 flex justify-center items-center border-t  ">
                            <BookmarkOutline :size="23" fillColor="#00000" class="cursor-pointer"/>
                            <div class="md:block hidden ml-2 -mb-[1px] text-gray-900">POSTS</div>
                        </div>
                        <div class="p-[17px] w-1/4 flex justify-center items-center border-t  ">
                            <AccountBoxOutline :size="23" fillColor="#00000" class="cursor-pointer"/>
                            <div class="md:block hidden ml-2 -mb-[1px] text-gray-900">POSTS</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid md:gap-4 gap-1 grid-cols-3 relative">
                <ContentOverlay/>
<!--                :postByUser="postByUser"-->
<!--                @selectedPost="$event=>data.post=$event"-->


            </div>

        </div>


    </MainLayout>

</template>
<style>
.carousel__prev,
.carousel__next,
.carousel__prev:hover,
.carousel__next:hover {
    color: rgb(49, 49, 49);
    background-color: rgb(255, 255, 255);
    border-radius: 100%;
    margin: 0 20px;
}
</style>
