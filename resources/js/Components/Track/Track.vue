<template>
    <div class="max-w-sm rounded overflow-hidden shadow-lg cursor-pointer">
        <div class="w-full relative">
            <!-- Use the computed property for the src -->
            <img :src="imageUrl" alt=""/>
            <div class="px-6 py-4 bottom-0 left-0 w-full">
                <div class="font-900 text-xl">{{ track.title }}</div>
                <div class="font-700 text-sm mb-4">{{ track.artist }}</div>
                <button
                    class="font-900 bg-blue-700 hover:bg-blue-900 text-white capitalize w-full rounded py-2 px-4 text-center"
                    @click="handleClick"
                >
                    Jouer la musique
                </button>
                <Link
                    :href="route('tracks.edit', { track: track })"
                    class="flex justify-center font-900 bg-green-700 hover:bg-green-900 text-white capitalize w-full rounded py-2 px-4 text-center my-2"
                >Modifier
                </Link>
                <Link
                    :href="route('tracks.destroy', { track: track })"
                    class="flex justify-center font-900 bg-red-700 hover:bg-red-900 text-white capitalize w-full rounded py-2 px-4 text-center"
                    as="button"
                    method="delete"
                >Supprimer
                </Link>
            </div>
        </div>
    </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";
export default {
    name: "Track",
    props: {
        track: {
            type: Object,
            required: true
        }
    },
    components: {
        Link
    },
    computed: {
        imageUrl() {
            return `storage/${this.track.image}`;
        },
    },
    methods: {
        handleClick() {
            this.$emit('played', this.track);
        },
    },
};
</script>
