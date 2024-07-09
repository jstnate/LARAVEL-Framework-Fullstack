<template>
    <MusicLayout>
        <template #title> </template>
        <template #action >
            <div class="flex justify-between items-center p-6 pl-0">
                <h1 class="mx-6">Liste de mes musiques</h1>
                <Link
                    :href="route('tracks.create')"
                    class="font-900 text-md bg-blue-700 hover:bg-blue-900 text-white capitalize rounded py-2 px-4 text-center"
                >
                    Ajouter une musique
                </Link>
            </div>
        </template>
        <template #content>
            <div>
                <input
                    v-model="filter"
                    type="search"
                    class="mx-6"
                    placeholder="Search tracks..."
                />
                <!-- {{ tracks }} -->
                <div>
                    <ul class="grid grid-cols-4 gap-4 px-8 py-4">
                        <!-- <li v-for="track in tracks" :key="track.uuid">
                            {{ track.title }} - {{ track.artist }}
                        </li> -->
                        <Track
                            v-for="track in filteredTracks"
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
import { Link } from "@inertiajs/vue3";

export default {
    name: "TrackIndex",
    components: {
        Link,
        MusicLayout,
        Track,
    },
    props: {
        tracks: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            audio: null,
            currentTrack: null,
            filter: "",
        };
    },
    computed: {
        filteredTracks() {
            return this.tracks.filter(
                (track) =>
                    track.title
                        .toLowerCase()
                        .includes(this.filter.toLowerCase()) ||
                    track.artist
                        .toLowerCase()
                        .includes(this.filter.toLowerCase())
            );
        },
    },
    methods: {
        play(track) {
            const url = "storage/" + track.music;
            if (!this.currentTrack) {
                this.audio = new Audio(url);
                this.audio.play();
            } else if (this.currentTrack !== track.uuid) {
                this.audio.pause();
                this.audio.src = url;
                this.audio.play();
            } else {
                this.audio.paused ? this.audio.play() : this.audio.pause();
            }

            this.currentTrack = track.uuid;
            this.audio.addEventListener(
                "ended",
                () => (this.currentTrack = null)
            );
        },
    },
};
</script>
