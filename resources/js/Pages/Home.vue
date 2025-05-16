<script setup>
import 'vue3-carousel/carousel.css'
import MainLayout from "@/Layouts/MainLayout.vue";
import {ref, onMounted, toRefs} from "vue";
import {Head, Link, router} from '@inertiajs/vue3';


import {Carousel, Slide, Navigation} from 'vue3-carousel'
import DotsHorizontal from 'vue-material-design-icons/DotsHorizontal.vue'
import LikeSection from '@/Components/LikeSection.vue'
import ShowPostOverlay from "@/Components/ShowPostOverlay.vue";

let wWidth = ref(window.innerWidth)
let currentSlide = ref(0)
let currentPost = ref(null)
let openOverlay = ref(false)
const props = defineProps({posts: Object, allUsers: Object})
const {posts, allUsers} = toRefs(props)
onMounted(() => {
    window.addEventListener('resize', () => {
        wWidth.value = window.innerWidth
    })
})
const addComment=(object)=>{
    router.post('/comments', {
        post_id: object.post.id,
        user_id: object.user.id,
        comment: object.comment
    }, {
        onFinish: () =>updatedPost(object),
        }
    )
}
const updateLike = (object) =>{
    let deleteLike =false
    let id=null
    for(let i=0; i< object.post.likes.length; i++){
        const like = object.post.likes[i];
        if(like.user.id ===object.user.id && like.post.id === object.post.id){
            deleteLike=true
            id=like.id
        }
    }
    if(deleteLike){
        router.delete('/likes/'+ id, {
            onFinish: ()=> updatedPost(object),
        } )
    }else {
        router.post('/likes', {
               post_id: object.post.id,
        }, {
            onFinish: () =>updatedPost(object),
        })
    }
}
const updatedPost = (object)=>{
    for (let i=0; i<posts.value.data.length; i++){
        const post = posts.value.data[i];
        if(post.id===object.post.id){
            currentPost.value=post;
        }
    }
}
const deleteFunc=(object)=>{
    let url=''
    if(object.deleteType==='Post'){
        url='/posts/'+ object.post.id
    }if(object.deleteType==='Comment'){
        url='/comments/'+ object.comment.id
    }

    router.delete(url, {
        onFinish: ()=> updatedPost(object),
    } )
}
const deleteComment = (id) => {
    console.log(id);
}
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
                :wrap-around="false"
                :transition="400"
                snap-align="start">

                <Slide v-for="user in allUsers" :key="user.id" class="h-32">
                    <Link :href="route('users.show', {id: user.id})" class="flex flex-col items-center space-y-1">
                        <div class="relative space-x-0">
                            <div
                                class="w-[58px] h-[58px] rounded-full p-[2px] bg-gradient-to-tr from-yellow-400 via-pink-500 to-purple-600">
                                <div class="w-full h-full rounded-full bg-white p-[1px]">
                                    <img :src="user.file" alt="profilna"
                                         class="rounded-full object-cover w-full h-full">
                                </div>
                            </div>
                        </div>
                        <div class="text-xs ">{{ user.name }}</div>
                    </Link>
                </Slide>
                <template #addons>
                    <Navigation/>
                </template>
            </Carousel>

            <!--  POSTS -->
            <div id="Posts" class="px-14 max-w-[600px] mx-auto" v-for="post in posts.data" :key="post">
                <div class="flex items-center justify-between py-2">
                    <div class="flex items-center">
                        <Link :href="route('users.show', {id: post.user.id})" class="flex items-center">
                            <img class="rounded-full z-10 w-[38px] h-[38px]" :src="post.user.file">
                            <div class="text-black font-extrabold text-sm ml-4">{{ post.user.name }}</div>
                        </Link>
                        <div class="flex items-center text-[15px] text-gray-500">
                            <span class="-mt-5 ml-2 mr-[0.5px] text-[35px]">.</span>
                            <div>{{ post.created_at }}</div>
                        </div>

                    </div>
                    <DotsHorizontal class="cursor-pointer" :size="27"/>
                </div>
                <div class="rounded-lg w-full min-h-[400px] flex items-center">
                    <img class=" w-min-[468px] h-min-[585px] mx-auto" :src="post.file" alt="">
                </div>
                <LikeSection
                    :post="post"
                    @like="$event=>updateLike($event)"
                />

                <div class="text-black text-[13px] font-extrabold py-1 pl-3">{{ post.likes.length }}</div>
                <div class="text-black text-[13px] ">
                    <span class="text-black text-[13px] font-extrabold  pl-3 pr-2">{{ post.user.name }}</span>
                    {{ post.text }}
                </div>
                <!--v-if="post.comments.length > 0"-->
                <button
                    class="text-gray-500 pl-3 text-sm"
                    @click="() => { currentPost = post; openOverlay = true; }"
                >
                    View all {{ post.comments.length }} comments
                </button>

                <div class="pb-20"></div>
            </div>
        </div>
    </MainLayout>
    <ShowPostOverlay
        v-if="openOverlay"
        :post="currentPost"
        @addComment="$event=>addComment($event)"
        @updateLike="$event=>updateLike($event)"
        @deleteSelected="$event=>{deleteFunc($event);
            openOverlay=false}"
        @CloseOverlay="$event=>openOverlay=false"
    />
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
