<template>

    <div class="max-w-lg w-full rounded-lg shadow-lg p-4 mt-2 mx-2 bg-yellow-200">
        <p class="text-gray-500 my-1">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci assumenda consequuntur debitis ea
            eius eligendi enim, ex exercitationem explicabo fugiat impedit iusto magnam molestiae nihil nostrum
            officiis optio perspiciatis praesentium quae quam quidem reiciendis, rem reprehenderit repudiandae
            tempore totam unde vel vitae voluptate voluptatum? Alias aperiam autem, cupiditate doloremque doloribus
            ducimus ea eligendi ex exercitationem facilis iusto laborum necessitatibus nesciunt nisi nobis nostrum
            placeat provident quas quis, quisquam quod recusandae, saepe soluta temporibus ullam vero voluptas! A ab
            doloribus dolorum ex, exercitationem hic, modi obcaecati odit perferendis possimus praesentium quae
            ratione recusandae sapiente sit ullam voluptatem! Ad at aut, blanditiis consectetur culpa dolor dolores,
            earum eius error esse eum ex exercitationem ipsa modi nemo nihil non numquam odit omnis quia quo sint
        </p>
        <div class="mt-2 flex justify-end">
            <jet-button class="bg-green-600">
                Save
            </jet-button>

            <jet-button class="bg-red-700 mx-2">
                delete
            </jet-button>

            <jet-button class="bg-blue-400">
                share
            </jet-button>

        </div>
    </div>

</template>

<script>
import JetButton from '@/Jetstream/Button';

export default {
    components: {
        JetButton,
    },
}
</script>
