<template>
    <div class="orders-chart">
        <Doughnut :data="chartData" :options="chartOptions" />
    </div>
</template>

<script setup>
import { computed } from 'vue';
import { Doughnut } from 'vue-chartjs';
import {
    Chart as ChartJS,
    ArcElement,
    Tooltip,
    Legend,
} from 'chart.js';

ChartJS.register(ArcElement, Tooltip, Legend);

const props = defineProps({
    pendientes: { type: Number, default: 0 },
    completadas: { type: Number, default: 0 },
    entregadas: { type: Number, default: 0 },
});

const chartData = computed(() => ({
    labels: ['Pendientes', 'Completadas', 'Entregadas'],
    datasets: [
        {
            data: [props.pendientes, props.completadas, props.entregadas],
            backgroundColor: ['#d97706', '#16a34a', '#7c3aed'],
            borderWidth: 0,
        },
    ],
}));

const chartOptions = {
    responsive: true,
    plugins: {
        legend: {
            position: 'bottom',
        },
    },
};
</script>

<style scoped>
.orders-chart {
    max-width: 300px;
    margin: 0 auto;
}
</style>
