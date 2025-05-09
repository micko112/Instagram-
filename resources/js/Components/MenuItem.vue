<script setup>
import { toRefs } from 'vue';
import {usePage} from '@inertiajs/vue3' ;


import Magnify from 'vue-material-design-icons/Magnify.vue';
import Home from 'vue-material-design-icons/Home.vue';
import HeartOutline from 'vue-material-design-icons/HeartOutline.vue';
import Compass from 'vue-material-design-icons/Compass.vue';
import SendOutLine from 'vue-material-design-icons/SendOutLine.vue';
import Plus from 'vue-material-design-icons/Plus.vue';
import AccountOutLine from 'vue-material-design-icons/AccountOutLine.vue';
import ChevronLeft from 'vue-material-design-icons/ChevronLeft.vue';
import AccountPlusOutLine from 'vue-material-design-icons/AccountPlusOutLine.vue';
import Menu from "vue-material-design-icons/Menu.vue";
import Reels from 'vue-material-design-icons/MoviePlayOutline.vue';

const props = defineProps({iconString: String})
const {iconString} = toRefs(props)

//const user = usePage().props.auth.user


const iconMap = {
    'Home': Home,
    'Search': Magnify,
    'Explore': Compass,
    'Reels': Reels,
    'Messages': SendOutLine,
    'Notification': HeartOutline,
    'Create': Plus,
    'Profile': AccountOutLine,
    'Log out': Menu
};
const iconComponent = iconMap[iconString.value];

</script>

<template>
    <div class="w-full p-2 hover:bg-gray-100
                md:hover:rounded-lg
                xl:hover:rounded-full  transition duration-150 ease-in-out cursor-pointer">
        <div class="flex items-center">
            <!-- Profile Image -->
            <img v-if="iconString === 'Profile'"
                 class="rounded-full ml-[2px] w-[27px] h-[27px] cursor-pointer"
                 src="https://picsum.photos/id/50/300/320"
                 alt="Profile">

            <!-- Icon -->
            <component v-else :is="iconComponent" fillColor="#000000" :size="27" />

            <!-- Text (hidden on mobile) -->
            <span class="hidden xl:block text-black  text-[14px] pl-2 mt-0.5">
                {{ iconString }}
            </span>
        </div>
    </div>
</template>

