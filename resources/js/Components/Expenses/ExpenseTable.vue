<script setup>
defineProps({
    expenses: {
        type: Array,
        required: true,
    },
});

import { ref, defineEmits } from 'vue';
import axios from 'axios';

const emit = defineEmits(['deleted']);
const loading = ref(false);

const deleteExpense = async (id) => {
    if (!confirm('Вы уверены, что хотите удалить эту трату?')) return;

    loading.value = true;
    try {
        await axios.delete(`/api/expenses/${id}`);
        emit('deleted', id);
    } catch (error) {
        alert('Ошибка при удалении. Попробуйте снова.');
    } finally {
        loading.value = false;
    }
};
</script>

<template>
    <div class="bg-white shadow-sm sm:rounded-lg p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">📋 Последние траты</h3>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Описание</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Сумма (₽)</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Дата</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Действия</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="expense in expenses" :key="expense.id">
                <td class="px-4 py-2">{{ expense.description }}</td>
                <td class="px-4 py-2">{{ expense.amount }}</td>
                <td class="px-4 py-2">{{ expense.date }}</td>
                <td class="px-4 py-2">
                    <button
                        class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600"
                        :disabled="loading"
                        @click="deleteExpense(expense.id)"
                    >Удалить</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
