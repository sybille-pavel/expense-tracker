<script setup>
import { ref } from 'vue';

defineProps({
    loading: Boolean,
});
const emit = defineEmits(['submit']);

const form = ref({
    description: '',
    amount: '',
    date: new Date().toISOString().slice(0, 10),
});

const submitForm = () => {
    emit('submit', { ...form.value });
    form.value.description = '';
    form.value.amount = '';
};
</script>

<template>
    <div class="bg-white shadow-sm sm:rounded-lg p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">➕ Добавить трату</h3>
        <form @submit.prevent="submitForm" class="space-y-4">
            <div>
                <label class="block text-sm font-medium">Описание</label>
                <input v-model="form.description" class="w-full border border-gray-300 rounded px-3 py-2" type="text" />
            </div>
            <div>
                <label class="block text-sm font-medium">Сумма (₽)</label>
                <input v-model="form.amount" class="w-full border border-gray-300 rounded px-3 py-2" type="number" step="0.01" />
            </div>
            <div>
                <label class="block text-sm font-medium">Дата</label>
                <input v-model="form.date" class="w-full border border-gray-300 rounded px-3 py-2" type="date" />
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" :disabled="loading">
                {{ loading ? 'Добавление...' : 'Добавить' }}
            </button>
        </form>
    </div>
</template>
