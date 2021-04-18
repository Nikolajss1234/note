import debounce from "debounce";
import axios from "axios";

export default {
    data() {
        return {
            placeholder: 'Click here to write...',
        }
    },
    created() {
        this.submitText = debounce(this.submitText, 1000);
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

    },
}