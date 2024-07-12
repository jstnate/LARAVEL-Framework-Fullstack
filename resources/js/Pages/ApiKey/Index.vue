<template>
    <MusicLayout>
        <template #title>
            API Keys
        </template>
        <template #action>

        </template>
        <template #content>
            <form @submit.prevent="submit">
                <input v-model="form.name" placeholder="API Key Name" class="shadow border rounded py-2 px-3 text-gray-700 appearance-none leading-tight focus:outline-none focus:shadow-outline mb-5"/>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold rounded py-2 px-4 mx-4">Créer une clé API</button>
            </form>
            <table class="table-auto border-separate border-spacing-4">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Clé API</th>
                    <th>Créée le</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody class="gap-2">
                <tr v-for="(key, i) in apiKeys" :key="key.uuid">
                    <td>{{ i + 1 }}</td>
                    <td>{{ key.name }}</td>
                    <td>{{ key.key }}</td>
                    <td>{{ $moment(key.created_at).format('DD/MM/YYYY hh:mm:ss') }}</td>
                    <td>
                        <Link :href="route('api-keys.destroy', {apiKey: key})"
                              class="bg-red-500 hover:bg-red-700 text-white font-bold rounded py-2 px-4"
                              as="button"
                              method="delete"
                        >
                            Supprimer
                        </Link>
                    </td>
                </tr>
                </tbody>
            </table>
        </template>
    </MusicLayout>
</template>

<script>
import { Link, useForm } from '@inertiajs/vue3';
import MusicLayout from "@/Layouts/MusicLayout.vue";

export default {
    name: 'ApiKeyIndex',
    props: {
        apiKeys: Array
    },
    components: {
        MusicLayout,
        Link,
    },
    data() {
        return {
            form: useForm({
                name: ''
            }),
        }
    },
    methods: {
        submit() {
            this.form.post(route('api-keys.store'), {
                onSuccess: () => this.form.reset(),
            });
        }
    }
};
</script>
