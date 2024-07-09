<template>
    <div class="max-w-sm rounded overflow-hidden shadow-lg cursor-pointer">
        <div class="w-full h-1/2 relative">
            <!-- Use the computed property for the src -->
            <img :src="imageUrl" alt=""/>
            <div class="px-6 py-4 bottom-0 left-0 w-full">
                <div class="font-900 text-xl">{{ track.title }}</div>
                <div class="font-700 text-sm mb-4">{{ track.artist }}</div>
                <button
                    class="font-900 bg-blue-700 hover:bg-blue-900 text-white uppercase w-full rounded py-2 px-4 text-center"
                    @click="handleClick"
                >
                    Lire la musique
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Track",
    props: {
        track: Object,
    },
    computed: {
        imageUrl() {
            return `storage/${this.track.image}`;
        },
    },
    methods: {
        handleClick() {
            this.$emit('played', this.track)
            
        },
    },
};
</script>
