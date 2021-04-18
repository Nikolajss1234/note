<template>

    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Notes
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="flex justify-end">

                    <jet-button class="bg-red-700 mx-0" @click="deleteNote">
                        delete
                    </jet-button>

                </div>

                <div class="w-full rounded-lg shadow-lg p-8 mt-2 mx-2 bg-yellow-200 note-single-full-view">
                    <p contenteditable="true" class="text-gray-500 my-1 w-full"
                       @input="onInput" data-placeholder="Write Here...">{{ note.text }}</p>
                </div>


                <div class="note-comments-section mt-6 mx-6">
                    <div class="note-comments-form">
                        <textarea cols="40" rows="5" v-model.trim="commentText" class="w-full"
                                  placeholder="write comment here"></textarea>

                        <jet-button class="bg-blue-400 m2-4 w-full justify-center"
                                    @click="submitComment"
                                    :disabled="!commentText.length">
                            submit
                        </jet-button>
                    </div>

                    <div class="note-comments-list mt-6 w-full">
                        <div class="note-comment-single bg-gray-200 my-2 p-6" v-for="comment in note.comments">
                            <p class="bg-gray-200 text-gray-500 self-end">{{ comment.created_at }}</p>
                            <p class="text-gray-900">{{ comment.text }}</p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </app-layout>


</template>

<style>
.note-comments-section {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.note-comment-single {
    display: flex;
    flex-direction: column;
    justify-content: center;
}

p:empty:not(:focus)::before {
    content: attr(data-placeholder);
    cursor: text;
}

.note-single-full-view {
    display: flex;
    flex-direction: column;
    justify-content: center;
}
</style>

<script>
import AppLayout from '@/Layouts/AppLayout';
import JetButton from '@/Jetstream/Button';
import axios from 'axios';
import notes_mixin from "../../mixins/notes_mixin";

export default {
    data() {
        return {
            commentText: '',
        }
    },
    components: {
        JetButton,
        AppLayout,
    },
    mixins: [notes_mixin],
    methods: {
        submitComment() {
            axios.post(route('notes.comments.create', {id: this.note.id}), {text: this.commentText})
                .then(response => {
                    const comment = response.data.comment;
                    if (comment && comment.text) {
                        this.note.comments.unshift(comment);
                        this.commentText = '';
                    }
                })
                .catch(e => console.error(e));
        },
        deleteNote() {
            axios.delete(route('notes.delete', {note: this.note.id}))
                .then(response => {
                    if (response.data) {
                        this.$inertia.get(route('notes'));
                    }
                })
                .catch(e => console.error(e));
        },
    },
}
</script>
