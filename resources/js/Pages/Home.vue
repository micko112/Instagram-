<script setup>
import 'vue3-carousel/carousel.css'
import MainLayout from "@/Layouts/MainLayout.vue";
import {ref, onMounted, toRefs} from "vue";
import {Head, Link, router} from '@inertiajs/vue3';


import { Carousel, Slide, Navigation} from 'vue3-carousel'
import DotsHorizontal from 'vue-material-design-icons/DotsHorizontal.vue'
import LikeSection from '@/Components/LikeSection.vue'
import ShowPostOverlay from "@/Components/ShowPostOverlay.vue";
let wWidth = ref(window.innerWidth)
let currentSlide = ref(0)
let currentPost = ref( null)
let openOverlay = ref(false)
const props = defineProps({ posts: Object, allUsers:Object})
const {posts, allUsers} = toRefs(props)
onMounted(() => {
    window.addEventListener('resize', ()=>{
        wWidth.value=window.innerWidth
    })
})

</script>

<template>
    <head title="Instagram"/>
    <MainLayout>
        <div class="">
            <Carousel
                v-model="currentSlide"
                class="max-w-[700px] mx-auto"
            :items-to-show="wWidth>=768 ? 8 : 6"
            :items-to-scroll="4"
            :wrap-around="true"
            :transition="400"
            snap-align="start">

                <Slide v-for="slide in 10" :key="slide" class="h-32">
                    <Link href="/" class="flex flex-col items-center space-y-1">
                        <div class="relative">
                            <div class="w-16 h-16 rounded-full p-1 bg-gradient-to-tr from-yellow-400 via-pink-500 to-purple-600">
                                <div class="w-full h-full rounded-full bg-white p-[1.5px]">
                                    <img src="https://picsum.photos/id/54/300/320" alt="profilna" class="rounded-full object-cover w-full h-full">
                                </div>
                            </div>
                        </div>
                        <div class="text-xs ">Name Here</div>

                    </Link>
                </Slide>
                <template #addons>
                    <Navigation/>
                </template>
            </Carousel>

            <!--  POSTS -->
            <div id="Posts" class="px-14 max-w-[600px] mx-auto" >
                    <div class="flex items-center justify-between py-2">
                        <div class="flex items-center">
                            <Link href="/" class="flex items-center" >
                                  <img class="rounded-full z-10 w-[38px] h-[38px]" src="https://picsum.photos/id/50/300/320">
                                  <div class="text-black font-extrabold text-sm ml-4">Name Here</div>
                            </Link>
                            <div class="flex items-center text-[15px] text-gray-500">
                                <span class="-mt-5 ml-2 mr-[0.5px] text-[35px]">.</span>
                                <div>Date Here</div>
                            </div>

                        </div>
                        <DotsHorizontal class="cursor-pointer" :size="27"/>
                    </div>
                <div class="rounded-lg w-full min-h-[400px] flex items-center">
                    <img class="w-[468px] h-[585px] mx-auto" src="https://picsum.photos/id/58/300/320" alt="">
                </div>
                <LikeSection />
                <div class="text-black text-[13px] font-extrabold py-1 pl-3">163 likes</div>
                <div class="text-black text-[13px] ">
                    <span class="text-black text-[13px] font-extrabold  pl-3 pr-2">Name Here</span>
                    description nigga
                </div>
                <button class="text-gray-500 pl-3 text-sm"
                @click="$event=>openOverlay=true">
                    View all 4 comments
                </button>
                <div class="pb-20"></div>
            </div>
        </div>
    </MainLayout>
<ShowPostOverlay
v-if="openOverlay"
:post="currentPost"
@close-overlay="$event=>openOverlay=false"
/>
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
