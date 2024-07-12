<template>
    <div>
        <h1>Create API Key</h1>
        <form @submit.prevent="createKey">
            <input v-model="name" placeholder="API Key Name" />
            <button type="submit">Create</button>
        </form>
    </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';

export default {
    data() {
        return {
            name: 'CreateApiKey'
        };
    },
    methods: {
        createKey() {
            Inertia.post('/api-keys', { name: this.name });
        }
    }
};
</script>
