<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Notes
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="notes-top-row">
                    <jet-button class="mb-3 bg-red-700 plus-button px-6 py-6"
                                @click="addNote">+
                    </jet-button>
                </div>

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg notes-list py-6">
                    <single-note v-for="note in allNotes" :note="note" @noteDeleted="removeDeletedNote"></single-note>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<style>
.notes-list {
    display: flex;
    flex-direction: row;
    justify-content: center;
    flex-wrap: wrap;
}

.notes-top-row {
    display: flex;
    flex-direction: row;
    justify-content: flex-end;
    align-items: center;
    font-size: 22pt;
}

.plus-button {
    font-size: 36px;
}

</style>

<script>
import AppLayout from '@/Layouts/AppLayout';
import SingleNote from '@/Pages/Notes/SingleNote';
import JetButton from '@/Jetstream/Button';
import axios from "axios";

export default {
    data() {
        return {
            allNotes: [],
        }
    },
    mounted() {
        this.allNotes = this.notes;
    },
    methods: {
        addNote() {
            axios.post(route('notes.create'))
                .then(response => {
                    this.allNotes.unshift(response.data.note);
                }).catch(e => console.error(e));
        },
        removeDeletedNote(id) {
            console.log(id);
            this.allNotes = this.allNotes.filter((note) => {
                return note.id !== id;
            })
        }
    },
    components: {
        AppLayout,
        SingleNote,
        JetButton,
    },
    props: ['notes'],
}
</script>
