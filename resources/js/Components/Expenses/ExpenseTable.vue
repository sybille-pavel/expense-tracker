<script setup>
defineProps({
    expenses: {
        type: Array,
        required: true,
    },
});
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
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="expense in expenses" :key="expense.id">
                <td class="px-4 py-2">{{ expense.description }}</td>
                <td class="px-4 py-2">{{ expense.amount }}</td>
                <td class="px-4 py-2">{{ expense.date }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
