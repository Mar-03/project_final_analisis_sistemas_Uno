<template>
    <section class="lab-dashboard">
        <h1 class="lab-dashboard__title">
            Dashboard de Laboratorio
        </h1>

        <div class="lab-dashboard__grid">
            <div class="lab-dashboard__card lab-dashboard__card--total">
                <span class="lab-dashboard__card-label">Total de Órdenes</span>
                <span class="lab-dashboard__card-value">{{ stats.total_ordenes }}</span>
            </div>

            <div class="lab-dashboard__card lab-dashboard__card--pendiente">
                <span class="lab-dashboard__card-label">Órdenes Pendientes</span>
                <span class="lab-dashboard__card-value">{{ stats.ordenes_pendientes }}</span>
            </div>

            <div class="lab-dashboard__card lab-dashboard__card--completado">
                <span class="lab-dashboard__card-label">Órdenes Completadas</span>
                <span class="lab-dashboard__card-value">{{ stats.ordenes_completadas }}</span>
            </div>

            <div class="lab-dashboard__card lab-dashboard__card--entregado">
                <span class="lab-dashboard__card-label">Resultados Entregados</span>
                <span class="lab-dashboard__card-value">{{ stats.resultados_entregados }}</span>
            </div>
        </div>

        <div class="lab-dashboard__row">
            <div class="lab-dashboard__chart-box">
                <h2 class="lab-dashboard__section-title">Órdenes por Estado</h2>
                <OrdersChart
                    :pendientes="stats.ordenes_pendientes"
                    :completadas="stats.ordenes_completadas"
                    :entregadas="stats.resultados_entregados"
                />
            </div>

            <div class="lab-dashboard__table-box">
                <h2 class="lab-dashboard__section-title">Últimas Órdenes Procesadas</h2>
                <table class="lab-dashboard__table">
                    <thead>
                        <tr>
                            <th>Paciente</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="orden in stats.ultimas_ordenes" :key="orden.id">
                            <td>{{ orden.paciente_nombre }}</td>
                            <td>
                                <span class="lab-dashboard__badge" :class="'lab-dashboard__badge--' + orden.estado">
                                    {{ etiquetaEstado(orden.estado) }}
                                </span>
                            </td>
                            <td>{{ formatDate(orden.created_at) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import api from '@/plugins/axios';
import OrdersChart from '../components/OrdersChart.vue';

const stats = ref({
    total_ordenes: 0,
    ordenes_pendientes: 0,
    ordenes_completadas: 0,
    resultados_entregados: 0,
    ultimas_ordenes: [],
});

function etiquetaEstado(estado) {
    const mapa = {
        pendiente: 'Pendiente',
        completado: 'Completado',
        entregado: 'Entregado',
    };
    return mapa[estado] ?? estado;
}

function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('es-ES', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
    });
}

onMounted(async () => {
    try {
        const response = await api.get('/lab/dashboard');
        stats.value = response.data;
    } catch {
        stats.value = {
            total_ordenes: 0,
            ordenes_pendientes: 0,
            ordenes_completadas: 0,
            resultados_entregados: 0,
            ultimas_ordenes: [],
        };
    }
});
</script>

<style scoped>
.lab-dashboard {
    max-width: 1000px;
}

.lab-dashboard__title {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
}

.lab-dashboard__grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 1rem;
    margin-bottom: 2rem;
}

.lab-dashboard__card {
    border-radius: 12px;
    padding: 1.25rem;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.04);
}

.lab-dashboard__card--total {
    background: #eff6ff;
    border-left: 4px solid #2563eb;
}

.lab-dashboard__card--pendiente {
    background: #fffbeb;
    border-left: 4px solid #d97706;
}

.lab-dashboard__card--completado {
    background: #f0fdf4;
    border-left: 4px solid #16a34a;
}

.lab-dashboard__card--entregado {
    background: #f5f3ff;
    border-left: 4px solid #7c3aed;
}

.lab-dashboard__card-label {
    font-size: 0.85rem;
    color: #64748b;
    font-weight: 500;
}

.lab-dashboard__card-value {
    font-size: 2rem;
    font-weight: 700;
}

.lab-dashboard__card--total .lab-dashboard__card-value {
    color: #2563eb;
}

.lab-dashboard__card--pendiente .lab-dashboard__card-value {
    color: #d97706;
}

.lab-dashboard__card--completado .lab-dashboard__card-value {
    color: #16a34a;
}

.lab-dashboard__card--entregado .lab-dashboard__card-value {
    color: #7c3aed;
}

.lab-dashboard__row {
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 1.5rem;
}

.lab-dashboard__chart-box {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 1.25rem;
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.04);
}

.lab-dashboard__table-box {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 1.25rem;
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.04);
    overflow-x: auto;
}

.lab-dashboard__section-title {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.lab-dashboard__table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.9rem;
}

.lab-dashboard__table th {
    text-align: left;
    padding: 0.5rem 0.75rem;
    border-bottom: 2px solid #e2e8f0;
    font-weight: 600;
    color: #475569;
}

.lab-dashboard__table td {
    padding: 0.5rem 0.75rem;
    border-bottom: 1px solid #f1f5f9;
}

.lab-dashboard__badge {
    display: inline-block;
    padding: 0.2rem 0.6rem;
    border-radius: 999px;
    font-size: 0.8rem;
    font-weight: 600;
}

.lab-dashboard__badge--pendiente {
    background: #fef3c7;
    color: #92400e;
}

.lab-dashboard__badge--completado {
    background: #dcfce7;
    color: #166534;
}

.lab-dashboard__badge--entregado {
    background: #ede9fe;
    color: #5b21b6;
}
</style>
