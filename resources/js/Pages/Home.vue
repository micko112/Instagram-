<script setup>
import 'vue3-carousel/carousel.css'
import MainLayout from "@/Layouts/MainLayout.vue";
import {ref, onMounted, toRefs} from "vue";
import {Head, Link, router} from '@inertiajs/vue3';


import { Carousel, Slide, Navigation} from 'vue3-carousel'
import DotsHorizontal from 'vue-material-design-icons/DotsHorizontal.vue'

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

                <Slide v-for="slide in 10" :key="slide" class="h-60">
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
            </Carousel>

        </div>
    </MainLayout>

</template>
