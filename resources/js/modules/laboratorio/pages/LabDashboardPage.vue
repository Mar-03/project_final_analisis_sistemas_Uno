<template>
    <section class="lab-dashboard">
        <h1 class="lab-dashboard__title">
            Dashboard de Laboratorio
        </h1>

        <div class="lab-dashboard__grid">
            <div class="lab-dashboard__card">
                <span class="lab-dashboard__card-label">Total de Órdenes</span>
                <span class="lab-dashboard__card-value lab-dashboard__card-value--total">
                    {{ stats.total_ordenes }}
                </span>
            </div>

            <div class="lab-dashboard__card">
                <span class="lab-dashboard__card-label">Órdenes Pendientes</span>
                <span class="lab-dashboard__card-value lab-dashboard__card-value--pendiente">
                    {{ stats.ordenes_pendientes }}
                </span>
            </div>

            <div class="lab-dashboard__card">
                <span class="lab-dashboard__card-label">Órdenes Completadas</span>
                <span class="lab-dashboard__card-value lab-dashboard__card-value--completado">
                    {{ stats.ordenes_completadas }}
                </span>
            </div>

            <div class="lab-dashboard__card">
                <span class="lab-dashboard__card-label">Resultados Entregados</span>
                <span class="lab-dashboard__card-value lab-dashboard__card-value--entregado">
                    {{ stats.resultados_entregados }}
                </span>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import api from '@/plugins/axios';

const stats = ref({
    total_ordenes: 0,
    ordenes_pendientes: 0,
    ordenes_completadas: 0,
    resultados_entregados: 0,
});

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
        };
    }
});
</script>

<style scoped>
.lab-dashboard {
    max-width: 900px;
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
}

.lab-dashboard__card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 1.25rem;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.04);
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

.lab-dashboard__card-value--total {
    color: #2563eb;
}

.lab-dashboard__card-value--pendiente {
    color: #d97706;
}

.lab-dashboard__card-value--completado {
    color: #16a34a;
}

.lab-dashboard__card-value--entregado {
    color: #7c3aed;
}
</style>
