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


