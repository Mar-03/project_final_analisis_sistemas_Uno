<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $tenant = Tenant::query()->first();

        if ($tenant === null) {
            return;
        }

        User::query()->firstOrCreate(
            ['email' => 'admin@hospital.com'],
            [
                'tenant_id' => $tenant->id,
                'name' => 'Admin',
                'password' => Hash::make('password'),
            ]
        )->assignRole('Admin');
    }
}
