<?php declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::factory()->create([
            'code' => 'PTN',
            'title' => 'patient',
            'description' => 'User that request a consultation or treatment',
            'is_active' => true
        ]);

        Role::factory()->create([
            'code' => 'CRG',
            'title' => 'caregiver',
            'description' => 'User that is responsible for a patient',
            'is_active' => true
        ]);

        Role::factory()->create([
            'code' => 'CLN',
            'title' => 'company shareholder',
            'description' => 'User that is legally one of the shareholder of a clinic',
            'is_active' => true
        ]);

        Role::factory()->create([
            'code' => 'OWN',
            'title' => 'company owner',
            'description' => 'User that is legally the owner of a clinic',
            'is_active' => true
        ]);

        Role::factory()->create([
            'code' => 'PRF',
            'title' => 'professional',
            'description' => 'User that is a professional of health',
            'is_active' => true
        ]);

        Role::factory()->create([
            'code' => 'EMP',
            'title' => 'employee',
            'description' => 'User that is an employee of a company',
            'is_active' => true
        ]);
    }
}
