<template>
    <MusicLayout>
        <template #title>
        </template>
        <template #action >
            <div class="flex justify-between items-center p-4">
                <h1 class="mx-6">Ajouter une musique</h1>
                <Link
                    :href="route('tracks.index')"
                    class="font-900 text-md bg-blue-700 hover:bg-blue-900 text-white capitalize rounded py-2 px-4 text-center"
                >
                    retour
                </Link>
            </div>
        </template>
        <template #content>
            <div>
                <form action="">
                    <p>Formulaire de création</p>
                </form>
            </div>
        </template>
    </MusicLayout>
</template>

<script>
import MusicLayout from "@/Layouts/MusicLayout.vue";
import Track from "@/Components/Track/Track.vue";
import { Link } from "@inertiajs/vue3";

export default {
    name: "TrackCreate",
    components: {
        Link,
        MusicLayout,
        Track,
    },
    props: {},
    data() {
        return {};
    },
    computed: {},
    methods: {},
};
</script>
./create.vue
