<script setup>
import {ref, toRefs} from "vue";
import {Link, usePage} from "@inertiajs/vue3";
import ShowPostOptionsOverlay from "@/Components/ShowPostOptionsOverlay.vue";
import LikeSection from "@/Components/LikeSection.vue";
import Close from "vue-material-design-icons/Close.vue";
import DotsHorizontal from "vue-material-design-icons/DotsHorizontal.vue";
import EmoticonHappyOutLine from "vue-material-design-icons/EmoticonHappyOutLine.vue";
import HeartOutLine from "vue-material-design-icons/HeartOutLine.vue";

let comment = ref('')
let deleteType = ref(null)
let id = ref(null)

const user = usePage().props.auth.user
const props = defineProps(['post']);
const {post} = toRefs(props)

defineEmits(['CloseOverlay', 'addComment', 'updateLike', 'deleteSelected'])
const textareaInput = (e) => {
    textarea.value.style.height = "auto";
    textarea.value.style.height = `${e.target.scrollHeight}px`;
}
</script>
<template>
    <div id="OverlaySection" class="fixed z-50 top-0 left-0 w-full h-full bg-black bg-opacity-50 p-3">
        <button class="absolute top-3 right-3 " @click="$event=>$emit('CloseOverlay')">
            <Close :size="27" fill-color="#FFFFFF"/>
        </button>
        <div class="bg-white max-w-6xl h-[calc(100%-100px)] mx-auto  ">
            <!--            Deo za sliku sa leve strane-->
            <div class="w-full md:flex h-full overflow-auto">
                <div class="flex items-center bg-black w-full">
                    <img class="mx-auto min-w-[400px] p-4" src="https://picsum.photos/id/58/700/800" alt="">
                </div>
                <!--                Desni deo posta sa komentarima i ostlaim glupostima-->
                <div class="w-full relative md:max-w-[500px] ">
                    <!--                User photo, ime, datum-->
                    <div class="flex items-center justify-between p-3 border-b ">
                        <div class="flex items-center">
                            <img class="rounded-full z-10 w-[58px] h-[58px]" src="https://picsum.photos/id/50/300/320">
                            <div class="text-black font-extrabold ml-4">Name Here</div>
                            <div class="flex items-center">
                                <span class="-mt-5 mx-2 text-[35px] text-gray-400">.</span>
                                <div class="text-gray-400">Date Here</div>
                            </div>
                        </div>
                        <button>
                            <DotsHorizontal class="cursor-pointer" :size="26"/>
                        </button>
                    </div>
                    <!--                    Komentar ili opis osobe koja pravi post-->
                    <div class="">
                        <div class="flex items-center justify-between p-3 ">
                            <div class="flex items-center">
                                <img class="rounded-full z-10 w-[45px] h-[45px]"
                                     src="https://picsum.photos/id/50/300/320">
                                <div class="flex flex-col ml-4">
                                    <div class="flex items-center">
                                        <div class="text-black font-extrabold  text-sm">Name Here</div>
                                        <div class="text-sm text-gray-900 ml-3.5">
                                            Commentar bas mi smrde noge
                                        </div>
                                    </div>
                                    <div class="text-xs text-gray-500 flex items-center gap-3">
                                        <div>1w</div>
                                        <div>12 likes</div>
                                        <Button>Reply</Button>
                                    </div>
                                </div>
                            </div>
                            <button>
                                <HeartOutLine class="cursor-pointer" :size="20" fill-color="#8d9399"/>
                            </button>
                        </div>
                        <!--   Obican Komentar osobe koja komentarise-->
                        <div class="flex items-center justify-between p-3 ">
                            <div class="flex items-center">
                                <img class="rounded-full z-10 w-[45px] h-[45px]"
                                     src="https://picsum.photos/id/50/300/320">
                                <div class="flex flex-col ml-4">
                                    <div class="flex items-center">
                                        <div class="text-black font-extrabold  text-sm">Name Here</div>
                                        <div class="text-sm text-gray-900 ml-3.5">
                                            Commentar bas mi smrde noge
                                        </div>
                                    </div>
                                    <div class="text-xs text-gray-500 flex items-center gap-3">
                                        <div>1w</div>
                                        <div>12 likes</div>
                                        <Button>Reply</Button>
                                    </div>
                                </div>
                            </div>
                            <button>
                                <HeartOutLine class="cursor-pointer" :size="20" fill-color="#8d9399"/>
                            </button>
                        </div>
                        <div class="pb-80 "></div>
                    </div>
                    <LikeSection class="px-2 mb-2  "/>
                    <div class="flex absolute bottom-0  border  w-full max-h-[200px] bg-white overflow-auto">
                        <EmoticonHappyOutLine class="pl-3 pt-[10px]" :size="30"/>
                        <textarea
                        ref="textarea"
                        :oninput="textareaInput"
                        v-model="comment"
                        placeholder="Add a comment..."
                        rows="1"
                        class="w-full border-0 mt-2 mb-2 text-sm z-50 focus:ring-0 text-gray-700 text-[18px]">
                        </textarea>
                        <button
                        v-if="comment"
                        class="text-blue-600 font-extrabold pr-4">
                            Post
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <ShowPostOptionsOverlay/>
</template>
