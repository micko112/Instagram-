<script setup>
import { ref, computed } from 'vue';
import Photo from 'vue-material-design-icons/ImageMultiple.vue';
import Close from 'vue-material-design-icons/Close.vue';
import ArrowLeft from 'vue-material-design-icons/ArrowLeft.vue';
import MapMarkerOutline from 'vue-material-design-icons/MapMarkerOutline.vue';
import AccountPlusOutline from 'vue-material-design-icons/AccountPlusOutline.vue';

const step = ref(1);
const selectedFile = ref(null);
const fileDisplay = ref('');
const isImage = ref(true);
const selectedFilter = ref('Original');
const caption = ref('');

const user = {
    username: '_micko_01',
    profileImage: 'https://example.com/profile.jpg'
};

const filters = [
    'Original', 'Aden', 'Clarendon', 'Crema', 'Gingham',
    'Juno', 'Lark', 'Ludwig', 'Moon', 'Perpetua', 'Reyes', 'Slumber'
];

const headerText = computed(() => {
    return {
        1: 'Create new post',
        2: 'Edit',
        3: 'Create new post'
    }[step.value];
});

//ovo uzimam
const handleFileUpload = (e) => {
    const file = e.target.files[0];
    if (!file) return;

    selectedFile.value = file;
    fileDisplay.value = URL.createObjectURL(file);
    isImage.value = file.type.includes('image');
    step.value = 2;
};

const closeModal = () => {
    step.value = 1;
    selectedFile.value = null;
    fileDisplay.value = '';
    caption.value = '';
};

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
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl max-w-4xl w-full max-h-[90vh] flex flex-col">
            <!-- Header -->
            <div class="border-b border-gray-300 p-4 flex items-center justify-between">
                <button v-if="step > 1" @click="step--">
                    <ArrowLeft :size="24" />
                </button>
                <div class="font-semibold text-lg mx-auto">{{ headerText }}</div>
                <button v-if="step === 3" class="text-blue-500 font-semibold" @click="sharePost">Share</button>
                <button v-else-if="step === 2 && selectedFile" class="text-blue-500 font-semibold" @click="step++">Next</button>
                <Close v-else :size="24" @click="closeModal" class="ml-auto" />
            </div>

            <!-- Content Area -->
            <div class="flex-1 overflow-auto">
                <!-- Step 1: Upload -->
                <div v-if="step === 1" class="flex flex-col items-center justify-center h-full p-8 text-center">
                    <Photo :size="80" class="mb-4"/>
                    <div class="text-xl mb-6">Drag photos and videos here</div>
                    <label for="file-upload" class="btn-primary cursor-pointer">
                        Select from computer
                    </label>
                    <input
                        id="file-upload"
                        type="file"
                        class="hidden"
                        accept="image/*,video/*"
                        @change="handleFileUpload"
                    >
                </div>

                <!-- Step 2: Edit -->
                <div v-if="step === 2" class="flex h-full">
                    <div class="w-3/4 border-r border-gray-300 flex items-center justify-center bg-black">
                        <img v-if="selectedFile && isImage" :src="fileDisplay" class="max-h-full max-w-full object-contain"/>
                        <video v-else-if="selectedFile" :src="fileDisplay" controls class="max-h-full max-w-full"></video>
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
                    <div class="w-3/4 border-r border-gray-300 flex items-center justify-center bg-black">
                        <img v-if="selectedFile && isImage" :src="fileDisplay" class="max-h-full max-w-full object-contain"/>
                        <video v-else-if="selectedFile" :src="fileDisplay" controls class="max-h-full max-w-full"></video>
                    </div>
                    <div class="w-1/4 p-4 overflow-y-auto">
                        <div class="flex items-center mb-4">
                            <img :src="user.profileImage" class="w-8 h-8 rounded-full mr-2"/>
                            <span class="font-semibold">{{ user.username }}</span>
                        </div>

                        <textarea
                            v-model="caption"
                            placeholder="Write a caption..."
                            class="w-full border-b border-gray-300 pb-2 mb-4 focus:outline-none"
                            rows="3"
                        ></textarea>

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
</template>
<div class="max-w-5xl mx-auto px-4 py-8">
<!-- Header -->
<div class="flex flex-col md:flex-row md:items-center md:space-x-16">

    <!-- Profile picture -->
    <div class="flex justify-center mb-4 md:mb-0">
        <img class="w-24 h-24 md:w-36 md:h-36 rounded-full object-cover" src="https://picsum.photos/id/1005/200/200" alt="Profile Picture">
    </div>

    <!-- Profile Info -->
    <div class="flex flex-col w-full">

        <!-- Username + Edit profile button -->
        <div class="flex flex-col items-center md:flex-row md:items-center md:justify-start md:space-x-4">
            <h2 class="text-2xl font-light">username_here</h2>
            <button class="mt-2 md:mt-0 px-4 py-1 border rounded text-sm font-semibold">Prati</button>
            <button class="mt-2 md:mt-0 px-2 py-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12h12M6 12l4-4m-4 4l4 4" />
                </svg>
            </button>
        </div>

        <!-- Stats -->
        <div class="flex justify-center md:justify-start space-x-6 mt-4 text-sm">
            <div><span class="font-semibold">54</span> postova</div>
            <div><span class="font-semibold">834</span> pratilaca</div>
            <div><span class="font-semibold">162</span> prati</div>
        </div>

        <!-- Bio -->
        <div class="mt-4 text-center md:text-left text-sm">
            <div class="font-semibold">Ime i Prezime</div>
            <div>Bio tekstić ovde ✌️</div>
        </div>

    </div>
</div>

<!-- Story Highlights -->
<div class="flex space-x-6 overflow-x-auto py-6 mt-4 md:mt-10">
    <div class="flex flex-col items-center">
        <div class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center">
            <span class="text-sm">+</span>
        </div>
        <span class="text-xs mt-2">New</span>
    </div>
    <div class="flex flex-col items-center">
        <div class="w-16 h-16 rounded-full overflow-hidden">
            <img src="https://picsum.photos/id/1006/200/200" class="object-cover w-full h-full">
        </div>
        <span class="text-xs mt-2">Story 1</span>
    </div>
    <div class="flex flex-col items-center">
        <div class="w-16 h-16 rounded-full overflow-hidden">
            <img src="https://picsum.photos/id/1008/200/200" class="object-cover w-full h-full">
        </div>
        <span class="text-xs mt-2">Story 2</span>
    </div>
    <!-- Dodaj još ako treba -->
</div>

<!-- Tabs -->
<div class="border-t border-gray-300 mt-8 flex justify-center space-x-8 text-xs md:text-sm font-semibold uppercase text-gray-500">
    <button class="py-3 border-t-2 border-black text-black">Objave</button>
    <button class="py-3">Reels</button>
    <button class="py-3">Označeno</button>
</div>

<!-- Posts Grid -->
<div class="grid grid-cols-2 md:grid-cols-3 gap-1 mt-1">
    <div class="relative w-full aspect-square overflow-hidden group">
        <img src="https://picsum.photos/id/1012/400/400" class="object-cover w-full h-full group-hover:opacity-80 transition">
    </div>
    <div class="relative w-full aspect-square overflow-hidden group">
        <img src="https://picsum.photos/id/1013/400/400" class="object-cover w-full h-full group-hover:opacity-80 transition">
    </div>
    <div class="relative w-full aspect-square overflow-hidden group">
        <img src="https://picsum.photos/id/1015/400/400" class="object-cover w-full h-full group-hover:opacity-80 transition">
    </div>
    <div class="relative w-full aspect-square overflow-hidden group">
        <img src="https://picsum.photos/id/1020/400/400" class="object-cover w-full h-full group-hover:opacity-80 transition">
    </div>
    <div class="relative w-full aspect-square overflow-hidden group">
        <img src="https://picsum.photos/id/1025/400/400" class="object-cover w-full h-full group-hover:opacity-80 transition">
    </div>
</div>
</div>


