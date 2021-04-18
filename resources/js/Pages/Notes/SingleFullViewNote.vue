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
import debounce from 'debounce';
import axios from 'axios';

export default {
    created() {
        this.submitText = debounce(this.submitText, 1000);
    },
    components: {
        JetButton,
        AppLayout,
    },
    props: ['note'],
    methods: {
        onInput(e) {
            this.note.text = e.target.innerText;
            this.submitText();
        },
        submitText() {
            axios.put(route('notes.update', {note: this.note.id}), {text: this.note.text})
                .catch(e => console.error(e));
        },
        deleteNote() {
            axios.delete(route('notes.delete', {note: this.note.id}))
                .then(response => {
                    if (response.data) {
                        this.$emit('noteDeleted', this.note.id);
                    }
                })
                .catch(e => console.error(e));
        },
        share() {
            alert('SHARE');
        }
    },
}
</script>
