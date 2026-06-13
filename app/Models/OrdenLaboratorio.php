<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrdenLaboratorio extends Model
{
    use HasFactory;

    protected $table = 'ordenes_laboratorio';

    protected $fillable = [
        'tenant_id',
        'paciente_nombre',
        'estado',
    ];

    protected function casts(): array
    {
        return [
            'estado' => 'string',
        ];
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class, 'tenant_id', 'id');
    }
}
