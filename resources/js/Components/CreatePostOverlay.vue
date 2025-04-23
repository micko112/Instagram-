<script setup>
import {ref, reactive} from 'vue';
import {router, usePage} from "@inertiajs/vue3";

import Photo from 'vue-material-design-icons/ImageMultiple.vue';
import Close from 'vue-material-design-icons/Close.vue';
import ArrowLeft from 'vue-material-design-icons/ArrowLeft.vue';
import MapMarkerOutline from 'vue-material-design-icons/MapMarkerOutline.vue';
import ChevronDown from 'vue-material-design-icons/ChevronDown.vue';
// user =usePage().props.auth.user
const emit = defineEmits(['close'])
const form = reactive({
        text: null,
        file: null
    }
)
let isValidFile = ref(null)
let fileDisplay = ref('')
let textArea = ref('')
let Error = ref({
    text: null,
    file: null
})
const closeOverlay = () => {
    form.text = null
    form.file = null
    fileDisplay.value = ''
    emit('close')
}
const getUploadedImage = (e) => {
    form.file = e.target.files[0]
    let extension = form.file.name.substring(form.file.name.lastIndexOf('.')+1);
    // Obradi odabrane fajlove ovde
    console.log(extension);
    if (extension == 'png' || extension == 'jpg' || extension == 'jpeg') {
        isValidFile.value = true
    } else {
        isValidFile.value = false
        return
    }
    fileDisplay.value = URL.createObjectURL(e.target.files[0])
    setTimeout(()=>{
        document.getElementById('TextAreaSection').scrollIntoView({behavior:'smooth'});
    }, 300);
};
</script>

<template>
    <div id="OverlaySection" class="fixed z-50 top-0 left-0 w-full h-screen bg-[#000000] bg-opacity-60 p-3">
        <button class="absolute right-3" @click="$event=>closeOverlay()">
            <Close :size="26" fill-color="FFFFFF"/>
        </button>
        <div class="max-w-2xl h-[calc(100%-120px)] mx-auto mt-14 bg-white rounded-xl   justify-center">
            <div class="flex items-center justify-center w-full mx-auto border-b p-3 border-b-gray-300 font-extrabold">
                <div>Create new post</div>
            </div>

            <div class="w-full md:flex h-[calc(100%-55px)] rounded-xl overflow-auto ">
                <div class="flex items-center w-full h-full overflow-hidden">
                    <div class="flex flex-col items-center mx-auto space-y-4">
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
                        <div v-if="error && error.file" class="text-red text-center p-2 font-extrabold">{{error.file}}</div>
                        <div v-if="!fileDisplay &&isValidFile===false" class="text-red text-center p-2 font-extrabold">File not accepted</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>
