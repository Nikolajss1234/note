<template>

    <div class="max-w-lg w-full rounded-lg shadow-lg p-4 mt-2 mx-2 bg-yellow-200 note-single-view">
        <p contenteditable="true" class="text-gray-500 my-1 w-full"
           @input="onInput" :data-placeholder="placeholder">{{ note.text }}</p>
        <div class="flex justify-end note-single-view-buttons">

            <jet-button class="bg-red-700 mx-2" @click="deleteNote">
                delete
            </jet-button>

            <inertia-link :href="route('notes.show',{id:note.id})">
                <jet-button class="bg-blue-400">
                    comments
                </jet-button>
            </inertia-link>

        </div>
    </div>

</template>

<style>
p:empty:not(:focus)::before {
    content: attr(data-placeholder);
    cursor: text;
}

.note-single-view {
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.note-single-view-buttons {
    margin-top: auto;
}

</style>

<script>
import JetButton from '@/Jetstream/Button';
import axios from 'axios';
import notes_mixin from "../../mixins/notes_mixin";

export default {
    components: {
        JetButton,
    },
    mixins: [notes_mixin],
    methods: {
        deleteNote() {
            axios.delete(route('notes.delete', {note: this.note.id}))
                .then(response => {
                    if (response.data) {
                        this.$emit('noteDeleted', this.note.id);
                    }
                })
                .catch(e => console.error(e));
        },
    },
}
</script>
