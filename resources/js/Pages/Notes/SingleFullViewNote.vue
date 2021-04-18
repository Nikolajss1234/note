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

            </div>
        </div>
    </app-layout>


</template>

<style>
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
    components: {
        JetButton,
        AppLayout,
    },
    mixins: [notes_mixin],
    methods: {
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
