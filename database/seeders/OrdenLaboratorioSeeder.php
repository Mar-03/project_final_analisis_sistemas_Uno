<?php

namespace Database\Seeders;

use App\Models\OrdenLaboratorio;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class OrdenLaboratorioSeeder extends Seeder
{
    public function run(): void
    {
        $tenant = Tenant::query()->first();

        if ($tenant === null) {
            return;
        }

        $estados = ['pendiente', 'completado', 'entregado'];

        foreach (range(1, 20) as $i) {
            OrdenLaboratorio::query()->create([
                'tenant_id' => $tenant->id,
                'paciente_nombre' => fake()->name(),
                'estado' => $estados[array_rand($estados)],
            ]);
        }
    }
}
