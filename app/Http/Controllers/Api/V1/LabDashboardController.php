<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\OrdenLaboratorio;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LabDashboardController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $tenant = $request->attributes->get('tenant');

        $query = OrdenLaboratorio::query()->where('tenant_id', $tenant->id);

        return response()->json([
            'total_ordenes' => (clone $query)->count(),
            'ordenes_pendientes' => (clone $query)->where('estado', 'pendiente')->count(),
            'ordenes_completadas' => (clone $query)->where('estado', 'completado')->count(),
            'resultados_entregados' => (clone $query)->where('estado', 'entregado')->count(),
        ]);
    }
}
