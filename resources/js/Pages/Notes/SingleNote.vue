<template>

    <div class="max-w-lg w-full rounded-lg shadow-lg p-4 mt-2 mx-2 bg-yellow-200">
        <p contenteditable="true" class="text-gray-500 my-1 w-full"
           @input="onInput" data-placeholder="Write Here...">{{ text }}</p>
        <div class="mt-2 flex justify-end">

            <jet-button class="bg-red-700 mx-2" @click="deleteNote">
                delete
            </jet-button>

            <jet-button class="bg-blue-400">
                share
            </jet-button>

        </div>
    </div>

</template>

<style>
p:empty:not(:focus)::before {
    content: attr(data-placeholder);
    cursor: text;
}
</style>

<script>
import JetButton from '@/Jetstream/Button';
import debounce from 'debounce';

export default {
    created() {
        this.submitText = debounce(this.submitText, 1000);
    },
    components: {
        JetButton,
    },
    props: ['text'],
    methods: {
        onInput(e) {
            this.text = e.target.innerText;
            this.submitText();
        },
        submitText() {
            console.log('Submit: ' + this.text);
        },
        deleteNote() {
            alert('DELETE');
        },
        share() {
            alert('SHARE');
        }
    },
}
</script>
