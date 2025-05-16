<script setup>
import {ref, toRefs} from "vue";

import Heart from 'vue-material-design-icons/Heart.vue';
import Comment from 'vue-material-design-icons/Comment.vue';
import {usePage} from "@inertiajs/vue3";

defineEmits(['selectedPost'])
const props = defineProps(['postByUser']);
const {postByUser} = toRefs(props);
let isHover = ref(false)
</script>

<template>
    <div @mouseenter="$event=> isHover=true"
         @mouseleave="$event=> isHover=false"
         @click="$event=> $emit('selectedPost', postByUser.id)"
         class="flex items-center justify-center cursor-pointer relative">
        <div v-if="isHover"
             :class="isHover ? 'bg-black bg-opacity-40' : '' "
             class="absolute w-full h-full z-50 flex items-center justify-around text-lg font-extrabold text-white">
            <div class="flex items-center justify-around w-[50%]">
                <div class="flex items-center justify-center">
                    <Heart fill-color="#FFFFFF" :size="30"/>
                    <div class="pl-1">{{postByUser.likes.length}}</div>
                </div>
            </div>
            <div class="flex items-center justify-around w-[50%]">
                <div class="flex items-center justify-center">
                    <Comment fill-color="#FFFFFF" :size="30"/>
                    <div class="pl-1">{{postByUser.comments.length}}</div>
                </div>
            </div>

        </div>

        <img class="aspect-squaremx-auto z-0 object-cover cursor-pointer h-[410px] w-[308px]"
             :src="postByUser.file"
        >

    </div>

</template>
