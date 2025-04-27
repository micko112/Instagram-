<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import Magnify from 'vue-material-design-icons/Magnify.vue';
import HeartOutline from 'vue-material-design-icons/HeartOutline.vue';
import Compass from 'vue-material-design-icons/Compass.vue';
import SendOutLine from 'vue-material-design-icons/SendOutLine.vue';
import Plus from 'vue-material-design-icons/Plus.vue';
import AccountOutLine from 'vue-material-design-icons/AccountOutLine.vue';
import ChevronLeft from 'vue-material-design-icons/ChevronLeft.vue';
import Home from 'vue-material-design-icons/Home.vue';
import Reels from 'vue-material-design-icons/MoviePlayOutline.vue';
import Menu from "vue-material-design-icons/Menu.vue";
import MenuItem from "@/Components/MenuItem.vue";

import CreatePostOverlay from '@/Components/CreatePostOverlay.vue'
let showCreatePost = ref(false);
</script>

<template>
    <div id="MainLayout" class="w-full h-screen flex">
        <!-- Mobile Top Navigation -->
        <div v-if="$page.url === '/'" id="TopNavHome"
             class="fixed z-30 md:hidden block w-full bg-white h-[81px] border-b border-b-gray-300">
            <div class="flex items-center justify-between h-full">
                <Link href="/">
                    <img class="w-[105px] ml-6 mt-10 cursor-pointer" src="/insta-logo.png">
                </Link>
                <div class="flex items-center w-[50%] mt-7">
                    <div class="flex items-center w-full bg-gray-100 rounded-lg">
                        <Magnify class="pl-4" fill-color="#8E8E8E" :size="27"/>
                        <input type="text"
                               placeholder="Search"
                               class="bg-transparent w-full placeholder-[#8E8E8E] border-0 ring-0 focus:ring-0">
                    </div>
                    <HeartOutline class="pl-4 pr-3" fill-color="#000000" :size="27"/>
                </div>
            </div>
        </div>

        <!-- User Page Top Navigation -->
        <div v-if="$page.url!=='/'" id="TopNavUser"
             class="md:hidden fixed flex items-center justify-between z-30 w-full bg-white h-[61px] border-b border-b-gray-300">
            <Link href="/" class="px-4">
                <ChevronLeft :size="30" class="cursor-pointer"/>
            </Link>
            <div class="font-extrabold text-lg">NAME HERE</div>
            <AccountOutLine :size="30" class="cursor-pointer px-4"/>
        </div>

        <!-- Sidebar -->
        <div id="SideBar" class="fixed h-full bg-white xl:w-[280px] w-[90px] md:block hidden border-r border-r-gray-300 overflow-y-auto">
            <div class="flex flex-col h-full">
                <!-- Logo -->
                <Link href="/" class="h-[80px] flex items-center justify-center xl:justify-start xl:pl-6">
                    <img src="/insta-logo.png" alt="Instagram" class="xl:block hidden w-[104px] cursor-pointer">
                    <img src="/insta-logo-small.png" alt="Instagram" class="xl:hidden block w-[34px] cursor-pointer">
                </Link>

                <!-- Menu Items -->
                <div class="flex-1 px-4 pt-4">
                    <Link href="/">
                        <MenuItem icon-string="Home" class="mb-4"/>
                    </Link>
                    <MenuItem icon-string="Search" class="mb-4"/>
                    <MenuItem icon-string="Explore" class="mb-4"/>
                    <MenuItem icon-string="Reels" class="mb-4"/>
                    <MenuItem icon-string="Messages" class="mb-4"/>
                    <MenuItem icon-string="Notification" class="mb-4"/>
                    <MenuItem @click="$event=>showCreatePost =true" icon-string="Create" class="mb-4"/>
                    <Link href="/">
                        <MenuItem icon-string="Profile" class="mb-4"/>
                    </Link>
                </div>

                <!-- Logout -->
                <div class="px-4 pb-4">
                    <MenuItem icon-string="Log out"/>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 h-full overflow-auto pt-0 md:pt-0 pl-4 xl:pl-12">
F
        <div class="mx-auto md:pt-6 pt-20" :class="$page.url==='/' ? 'lg:w-6/12 w-full mr-auto ' : 'max-w-[1200px]'">
                <slot />
            </div>
        </div>
            <!-- Suggestions Section -->
            <div v-if="$page.url==='/'" id="SuggestionsSection" class="lg:w-[35%] lg:block hidden fixed right-0 top-0 h-full text-black mt-14 pl-16">
                <Link href="/" class="flex items-center justify-between max-w-[300px]">
                    <div class="flex items-center ">
                        <img class="rounded-full z-10 w-[58px] h-[58px]" src="https://picsum.photos/id/50/300/320">
                        <div class="pl-4">
                            <div class="text-black font-extrabold">NAME HERE</div>
                            <div class="text-gray-500 font-extrabold text-sm">NAME HERE</div>
                        </div>
                    </div>
                    <button class="text-blue-500 hover:text-gray-900 text-sm font-extrabold">
                        Switch
                    </button>
                </Link>
                <div class="max-w-[300px] flex items-center justify-between py-3">
                    <div class="text-gray-500 font-extrabold text-sm">
                        Suggested for you
                    </div>
                    <div class="text-black text-xs">Show all</div>
                </div>
                <Link href="/" class="flex items-center justify-between max-w-[300px]">
                    <div class="flex items-center ">
                        <img class="rounded-full z-10 w-[58px] h-[58px]" src="https://picsum.photos/id/50/300/320">
                        <div class="pl-4">
                            <div class="text-black font-extrabold">NAME HERE</div>
                            <div class="text-gray-500 font-extrabold text-xs">Followed by</div>
                        </div>
                    </div>
                    <button class="text-blue-500 hover:text-gray-900 text-sm font-extrabold">
                        Follow
                    </button>
                </Link>
                <div class="max-w-[300px] mt-5">
                    <div class="text-xs text-gray-400">Информације Помоћ Штампа API Послови Приватност Услови коришћења Локације Језик Meta Verified</div>
                </div>
                <div class="max-w-[300px] mt-5">
                    <div class="text-xs text-gray-400">© 2025 INSTAGRAM FROM META</div>
                </div>
            </div>

        <div id="BottomNavBar" class="px-6 fixed z-30 w-full md:hidden bottom-0 flex items-center justify-between py-4 border-t bg-white border-t-gray-300 ">

                <Link href="/">
                    <Home fill-color="#00000" :size="33" class="cursor-pointer"/>
                </Link>

            <Compass fill-color="#00000" :size="33" class="cursor-pointer"/>
            <Reels fill-color="#00000" :size="33" class="cursor-pointer"/>
            <Plus @click="$event=>showCreatePost=true" fill-color="#00000" :size="33" class="cursor-pointer"/>
            <SendOutLine fill-color="#00000" :size="33" class="cursor-pointer"/>
            <Link href="/">
                <img class="rounded-full z-10 w-[33px] h-[33px]" src="https://picsum.photos/id/50/300/320">
            </Link>
        </div>
    </div>
<!--    ako je showcreatepost = true, zatvori overlay-->
    <CreatePostOverlay v-if="showCreatePost" @close="$event=>showCreatePost=false"/>
</template>
