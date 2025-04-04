<script setup>
defineProps({
    stats: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <div class="bg-white shadow-sm sm:rounded-lg p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-2">📊 Статистика за последний месяц</h3>
        <p>💸 Сумма: <strong>{{ stats.total }} ₽</strong></p>
        <p>🧾 Кол-во трат: <strong>{{ stats.count }}</strong></p>
    </div>
</template>
