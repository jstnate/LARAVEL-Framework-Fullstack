<template>
    <MusicLayout>
        <template #title>
            <p>Wishify</p>
        </template>
        <template #action>
            <p>Ajouter une musique</p>
        </template>
        <template #content>
            <div>
                <h1>Liste de mes tracks</h1>

                <!-- {{ tracks }} -->
                <div>
                    <ul class="grid grid-cols-4 gap-4 px-8 py-4">
                        <!-- <li v-for="track in tracks" :key="track.uuid">
                            {{ track.title }} - {{ track.artist }}
                        </li> -->
                        <Track
                            v-for="track in tracks"
                            :key="track.uuid"
                            :track="track"
                            @played="play"
                        />
                    </ul>
                </div>
            </div>
        </template>
    </MusicLayout>
</template>

<script>
import MusicLayout from "@/Layouts/MusicLayout.vue";
import Track from "@/Components/Track/Track.vue";

export default {
    name: "TrackIndex",
    components: {
        MusicLayout,
        Track,
    },
    props: {
        tracks: {
            type: Array,
            required: true,
        },
    },
    methods: {
        play(track) {
            const audio = new Audio(`storage/${track.music}`);
            audio.play();
        },
    },
};
</script>
