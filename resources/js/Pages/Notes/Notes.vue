<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Notes
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg notes-list py-6">
                    {{ notes }}
                    <!--                    <single-note></single-note>-->
                    <!--                    <single-note></single-note>-->
                    <!--                    <single-note></single-note>-->
                    <!--                    <single-note></single-note>-->
                    <!--                    <single-note></single-note>-->
                    <!--                    <single-note></single-note>-->
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
</style>

<script>
import AppLayout from '@/Layouts/AppLayout';
import SingleNote from '@/Pages/Notes/SingleNote';

export default {
    components: {
        AppLayout,
        SingleNote
    },
    props: ['notes'],
}
</script>
