<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';

import MonthlyStats from '@/Components/Expenses/MonthlyStats.vue';
import ExpenseForm from '@/Components/Expenses/ExpenseForm.vue';
import ExpenseTable from '@/Components/Expenses/ExpenseTable.vue';

const expenses = ref([]);
const loading = ref(false);

const fetchExpenses = async () => {
    const response = await axios.get('/api/expenses');
    expenses.value = response.data;
};

const addExpense = async (expenseData) => {
    loading.value = true;
    await axios.post('/api/expenses', expenseData);
    await fetchExpenses();
    loading.value = false;
};

const monthStats = computed(() => {
    const now = new Date();
    const lastMonth = new Date(now);
    lastMonth.setMonth(now.getMonth() - 1);

    const filtered = expenses.value.filter((e) => {
        const d = new Date(e.date);
        return d >= lastMonth && d <= now;
    });

    const total = filtered.reduce((sum, e) => sum + parseFloat(e.amount), 0);

    return {
        total: total.toFixed(2),
        count: filtered.length,
    };
});

const removeExpense = (id) => {
    expenses.value = expenses.value.filter(expense => expense.id !== id);
};

onMounted(fetchExpenses);
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Dashboard</h2>
        </template>

        <div class="py-12 space-y-8 max-w-4xl mx-auto">
            <MonthlyStats :stats="monthStats" />
            <ExpenseForm @submit="addExpense" :loading="loading" />
            <ExpenseTable :expenses="expenses" @deleted="removeExpense" />
        </div>
    </AuthenticatedLayout>
</template>
