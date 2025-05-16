<script setup>
import {ref, reactive, computed} from 'vue';
import {router, usePage} from "@inertiajs/vue3";

import Photo from 'vue-material-design-icons/ImageMultiple.vue';
import Close from 'vue-material-design-icons/Close.vue';
import ArrowLeft from 'vue-material-design-icons/ArrowLeft.vue';
import MapMarkerOutline from 'vue-material-design-icons/MapMarkerOutline.vue';
import ChevronDown from 'vue-material-design-icons/ChevronDown.vue';
import AccountPlusOutline from "vue-material-design-icons/AccountPlusOutline.vue";
import {nextTick} from 'vue';

const captionTextarea = ref(null);
const user =usePage().props.auth.user

const emit = defineEmits(['close'])
const form = reactive({
    text: null,
    file: null
})
const step = ref(1);
const selectedFile = ref(null);
const isImage = ref(true);
const selectedFilter = ref('Original');
const caption = ref('');
const isValidFile = ref(null);
const fileDisplay = ref('');
const createPostFunc = () => {
    error.text = null
    error.file = null

    form.text = caption.value // Dodajte caption u form objekat

    router.post('/posts', form, {
        forceFormData: true,
        preserveScroll: true,
        onError: errors => {
            if (errors) {
                error.text = errors.text || null
                error.file = errors.file || null
            }
        },
        onSuccess: () => {
            closeOverlay()
        }
    })
}

const filters = [
    'Original', 'Aden', 'Clarendon', 'Crema', 'Gingham',
    'Juno', 'Lark', 'Ludwig', 'Moon', 'Perpetua', 'Reyes', 'Slumber'
];



let textArea = ref('')
const error = reactive({
    text: null,
    file: null
})

const getUploadedImage = (e) => {
    form.file = e.target.files[0];
    const file = e.target.files[0];
    let extension = file.name.substring(file.name.lastIndexOf('.') + 1);
    // Obradi odabrane fajlove ovde
    console.log(extension);
    if (extension == 'png' || extension == 'jpg' || extension == 'jpeg') {
        isValidFile.value = true
    } else {
        isValidFile.value = false
        return
    }
    selectedFile.value = file;
    isImage.value = file.type.includes('image');
    fileDisplay.value = URL.createObjectURL(e.target.files[0])
    nextTick(() => {
        console.log("scrolling");
        captionTextarea.value?.scrollIntoView({behavior: 'smooth'});
    });

    step.value = 2;
};
const closeOverlay = () => {
    form.text = null
    form.text = null
    step.value = 1;
    selectedFile.value = null;
    fileDisplay.value = '';
    caption.value = '';
    emit('close')
};
const headerText = computed(() => {
    return {
        1: 'Create new post',
        2: 'Edit',
        3: 'Create new post'
    }[step.value];
});
const sharePost = () => {
    // Logic to share the post
    console.log('Sharing post:', {
        file: selectedFile.value,
        filter: selectedFilter.value,
        caption: caption.value
    });
    closeModal();
};
</script>
<style>
.btn-primary {
    @apply bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md text-sm transition-colors;
}
</style>
<template>
    <div id="OverlaySection" class="fixed z-50 top-0 left-0 w-full h-screen bg-[#000000] bg-opacity-60 p-3">
        <button class="absolute right-3" @click="$event=>closeOverlay()">
            <Close :size="26" fill-color="FFFFFF"/>
        </button>
        <div class="max-w-4xl h-[calc(100%-80px)] mx-auto mt-14 bg-white rounded-lg   justify-center">
            <div
                class="flex  items-center justify-between w-full mx-auto rounded-lg border-b p-3 border-b-gray-300 font-extrabold bg-white">
                <button v-if="step > 1" @click="step--">
                    <ArrowLeft :size="24"/>
                </button>
                <div class="font-semibold text-lg mx-auto">{{ headerText }}</div>
                <button v-if="step === 3" class="text-blue-500 font-semibold" @click="$event=>createPostFunc()">Share
                </button>
                <button v-else-if="step === 2 && selectedFile" class="text-blue-500 font-semibold" @click="step++">
                    Next
                </button>

            </div>

            <!-- Content Area -->
            <div class="flex-1 w-full md:flex h-[calc(100%-55px)] rounded-xl overflow-auto items-center justify-center">

                <div class="flex  items-center justify-center h-full p-8 text-center">
                    <div v-if="step === 1" class="flex flex-col items-center mx-auto space-y-4">
                        <Photo :size="80"/>
                        <div class="text-xl">Drag photos and videos here</div>
                        <label for="file"
                               class=" bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md text-sm">
                            Select from computer
                        </label>
                        <input
                            id="file"
                            type="file"
                            class="hidden"
                            @input="$event=>getUploadedImage($event)"
                        >
                        <div v-if="error && error.file" class="text-red-600 text-center p-2 font-extrabold">
                            {{ error.file }}
                        </div>
                        <div v-if="!fileDisplay &&isValidFile===false"
                             class="text-red-600 text-center p-2 font-extrabold">File not accepted
                        </div>
                        <div v-else class="w-full h-full flex flex-col items-center justify-center p-4 space-y-4">
                            <img v-if="isValidFile ===true && fileDisplay" class="min-w-[400px]   " :src="fileDisplay">

                        </div>
                    </div>
                    <!-- Step 2: Edit -->
                    <div v-if="step === 2" class="flex h-full">
                        <div class="w-3/4 border-r border-gray-300 flex items-center justify-center ">
                            <img v-if="selectedFile && isImage" :src="fileDisplay"
                                 class="max-h-full max-w-full object-contain"/>
                            <video v-else-if="selectedFile" :src="fileDisplay" controls
                                   class="max-h-full max-w-full"></video>
                        </div>
                        <div class="w-1/4 p-4 overflow-y-auto">
                            <div class="font-semibold mb-4">Filters</div>
                            <div class="grid grid-cols-3 gap-2 mb-6">
                                <button v-for="filter in filters" :key="filter"
                                        class="h-16 w-full flex items-center justify-center"
                                        @click="selectedFilter = filter">
                                    <div class="text-xs">{{ filter }}</div>
                                </button>
                            </div>

                            <div class="font-semibold mb-4">Adjustments</div>
                            <!-- Adjustment controls would go here -->
                        </div>
                    </div>

                    <!-- Step 3: Details -->
                    <div v-if="step === 3" class="flex h-full">
                        <div class="w-3/4 border-r border-gray-300 flex items-center justify-center ">
                            <img v-if="selectedFile && isImage" :src="fileDisplay"
                                 class="max-h-full max-w-full object-contain"/>
                            <video v-else-if="selectedFile" :src="fileDisplay" controls
                                   class="max-h-full max-w-full"></video>
                        </div>
                        <div class="w-1/4 p-4 overflow-y-auto">
                            <div class="flex items-center mb-4">
                                <img :src="user.file" class="w-8 h-8 rounded-full mr-2"/>
                                <span class="font-semibold">{{ user.name }}</span>
                            </div>

                            <textarea
                                ref="captionTextarea"
                                v-model="caption"
                                placeholder="Write a caption..."
                                class="w-full border-b border-gray-300 pb-2 mb-4 focus:outline-none"
                                rows="3"
                            />


                            <div class="mb-4">
                                <div class="flex items-center text-gray-500 mb-2">
                                    <MapMarkerOutline :size="18" class="mr-2"/>
                                    <span>Add location</span>
                                </div>
                                <div class="flex items-center text-gray-500">
                                    <AccountPlusOutline :size="18" class="mr-2"/>
                                    <span>Add collaborators</span>
                                </div>
                            </div>

                            <div class="border-t border-gray-300 pt-4">
                                <div class="font-semibold mb-2">Share to</div>
                                <div class="flex items-center mb-2">
                                    <input type="checkbox" id="facebook" class="mr-2">
                                    <label for="facebook">Facebook - Friends</label>
                                </div>
                            </div>

                            <div class="border-t border-gray-300 pt-4">
                                <div class="font-semibold mb-2">Accessibility</div>
                                <div class="font-semibold mb-2">Advanced settings</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>
