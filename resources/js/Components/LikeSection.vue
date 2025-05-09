<script setup>
import {computed, toRefs} from "vue";
import {usePage} from "@inertiajs/vue3";

import HeartOutline from 'vue-material-design-icons/HeartOutline.vue';
import Heart from 'vue-material-design-icons/Heart.vue';
import CommentOutline from 'vue-material-design-icons/CommentOutline.vue';
import SendOutline from 'vue-material-design-icons/SendOutline.vue';
import BookmarkOutline from 'vue-material-design-icons/BookmarkOutline.vue';

const props=defineProps(['post'])
const {post} =toRefs(props)
const emit =defineEmits(['like'])

const user =usePage().props.auth.user
const isHeartActiveComputed = computed( ()=>{
    let isTrue=false
for (let i =0; i<post.value.likes.length; i++){
    const element = array[i];
    if(like.user.id===user.id && like.post.id === post.value.id){
        isTrue=true;
    }
}
return isTrue
})
</script>

<template>
    <div class="flex z-20 items-center justify-between border-t " >
        <div class="flex items-center ">
            <button @click="$event=>$emit('like', {post, user})" class="mt-[10px] pl-3">
                <HeartOutline v-if="!isHeartActiveComputed" class=" cursor-pointer" :size="24"/>
                <Heart v-else class="fill-red-600" :size="24"/>
            </button>
            <CommentOutline class="pl-3 pt-[10px] cursor-pointer" :size="24"/>
            <SendOutline class="pl-3 pt-[10px] cursor-pointer" :size="24"/>
        </div>
        <bookmark-outline class="pl-3 pt-[10px] cursor-pointer" :size="24"/>
    </div>
</template>
