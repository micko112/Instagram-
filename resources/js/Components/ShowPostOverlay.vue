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

    <div v-if="post" id="OverlaySection" class="fixed z-50 top-0 left-0 w-full h-full bg-black bg-opacity-50 p-3">

        <button class="absolute top-3 right-3 " @click="$event=>$emit('CloseOverlay')">
            <Close :size="27" fill-color="#FFFFFF"/>
        </button>
        <div class="bg-white max-w-6xl h-[calc(100%-100px)] mx-auto  ">
            <!--            Deo za sliku sa leve strane-->
            <div class="w-full md:flex h-full overflow-auto">
                <div class="flex items-center bg-black w-full">
                    <img class="mx-auto min-w-[400px] p-4" :src="post.file" alt="">
                </div>
                <!--                Desni deo posta sa komentarima i ostlaim glupostima-->
                <div class="w-full relative md:max-w-[500px] flex flex-col h-full">
                    <!--                User photo, ime, datum-->
                    <div class="flex items-center justify-between p-3 border-b ">
                        <div class="flex items-center">
                            <img class="rounded-full z-10 w-[58px] h-[58px]" :src="post.user.file">
                            <div class="text-black font-extrabold ml-4">{{ post.user.name }}</div>
                            <div class="flex items-center">
                                <span class="-mt-5 mx-2 text-[35px] text-gray-400">.</span>
                                <div class="text-gray-400">{{ post.created_at }}</div>
                            </div>
                        </div>
                        <button
                            v-if="user && post && user.id === post.user.id"
                            @click="() => { if (post) { deleteType = 'Post'; id = post.id } }">
                            <DotsHorizontal class="cursor-pointer" :size="26"/>
                        </button>
                    </div>
                    <!--                    Description osobe koja pravi post-->
                    <div class="flex-1 overflow-y-auto ">
                        <div v-if="post.text" class="flex items-center justify-between p-3 ">
                            <div class="flex items-start gap-3">
                                <!-- Slika (levo) -->
                                <img
                                    class="rounded-full w-[32px] h-[32px] flex-shrink-0"
                                    :src="post.user.file">
                                <!-- Tekst komentara (ime + tekst u istoj liniji) -->
                                <div class="leading-5 text-sm break-words min-w-0  ">
                                    <a class="font-bold text-black cursor-pointer flex flex-wrap">
                                        {{ post.user.name }}</a>
                                    <div class="text-gray-900 pl-3 whitespace-pre-wrap break-words max-w-[300px]">
                                        {{ post.text }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--   Obican Komentar osobe koja komentarise-->
<!--                        <div class="flex items-start space-x-2 text-sm py-2 px-4"-->
<!--                             v-if="post.comments"-->
<!--                             v-for="comment in post.comments"-->
<!--                             :key="comment.id"-->
<!--                        >-->
<!--                            &lt;!&ndash; Avatar &ndash;&gt;-->
<!--                            <div class="w-8 h-8 rounded-full bg-gray-300"></div>-->

<!--                            &lt;!&ndash; Tekstualni deo &ndash;&gt;-->
<!--                            <div class="flex-1">-->
<!--                                <div class="mb-1">-->
<!--                                    <a class="font-semibold">{{ comment.user.name }}</a>-->
<!--                                    <span class="ml-1">{{comment.text}}</span>-->
<!--                                </div>-->
<!--                                <div class="flex items-center text-gray-500 text-xs space-x-3">-->
<!--                                    <span>5w</span>-->
<!--                                    <span>34 likes</span>-->
<!--                                    <span>Reply</span>-->
<!--                                    <span class="text-lg font-bold">⋯</span>-->
<!--                                </div>-->
<!--                                <div class="text-gray-500 text-xs mt-1">─── View replies (2)</div>-->
<!--                            </div>-->
<!--                        </div>-->
                        <div v-if="post.comments"
                             v-for="comment in post.comments"
                             :key="comment"
                             class="flex items-center justify-between p-3 ">

                            <div class="flex items-center">
                                <img
                                    class="rounded-full w-[32px] h-[32px] flex-shrink-0"
                                    :src="comment.user.file">
                                <div class="flex flex-col ml-4">
                                    <div class="flex items-center ">
                                        <a class="text-black font-extrabold  text-sm">{{ comment.user.name }}</a>
                                        <div
                                            class="text-sm text-gray-900 ml-3.5 whitespace-pre-wrap break-words max-w-[300px] ">
                                            {{ comment.text }}
                                        </div>
                                        <!--                                        mozda je ovde greska, umesto content mozda treba text-->
                                    </div>
                                    <div v-if="comment.created_at"
                                         class="text-xs text-gray-500 flex items-center gap-3 ">
                                        <div>{{ comment.created_at }}</div>
                                        <!--                                        <div>{{ comment.likes.length }}</div>-->
                                        <Button>Reply</Button>
                                        <button
                                            v-if="user.id===post.user.id"
                                            @click="() => {deleteType ='Comment' ; id=comment.id}">
                                            <DotsHorizontal class="cursor-pointer" fill-color="black" :size="26"/>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <button>
                                <HeartOutLine class="cursor-pointer" :size="20" fill-color="#8d9399"/>
                            </button>
                        </div>
                    </div>
                    <div>
                        <LikeSection class="px-2 mb-2"
                                     v-if="post"
                                     :post="post"
                                     @like="$event=>$emit('updateLike', $event)"/>
                        <div class="flex items-center justify-between ">
                            <EmoticonHappyOutLine class="pl-3 pt-[10px]" :size="30"/>
                            <textarea
                                ref="textarea"
                                v-model="comment"
                                :oninput="textareaInput"
                                placeholder="Add a comment..."
                                rows="1"
                                class="w-full border-0 mt-2 mb-2 text-sm z-50 focus:ring-0 text-gray-700 text-[18px]
           whitespace-pre-wrap overflow-hidden resize-none break-words min-h-[50px]">
                           </textarea>
                            <button
                                v-if="comment"
                                class="text-blue-600 font-extrabold pr-4"
                                @click="$event => {
                            $emit('addComment', {post, user, comment});
                          comment = ''
                          }"
                            >Post
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <ShowPostOptionsOverlay
        v-if="deleteType"
        :delete-type="deleteType"
        :id="id"
        @deleteSelected="$event=>{
            $emit('deleteSelected', {
                deleteType: $event.deleteType,
                id: $event.id,
                post: post
            });
            deleteType=null;
            id=null;
        }"
        @close="$event=>{deleteType=null; id=null}"
    />

</template>
