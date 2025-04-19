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
import AccountPlusOutLine from 'vue-material-design-icons/AccountPlusOutLine.vue';

let showCreatePost = ref(false);
</script>

<template>

    <div id="MainLayout" class="bg-red-600">
        <div>MainLayout</div>
    </div>
    <slot/>
</template>
