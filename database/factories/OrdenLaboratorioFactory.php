<?php

namespace Database\Factories;

use App\Models\OrdenLaboratorio;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrdenLaboratorio>
 */
class OrdenLaboratorioFactory extends Factory
{
    protected $model = OrdenLaboratorio::class;

    public function definition(): array
    {
        return [
            'tenant_id' => Tenant::factory(),
            'paciente_nombre' => fake()->name(),
            'estado' => fake()->randomElement(['pendiente', 'completado', 'entregado']),
        ];
    }
}
