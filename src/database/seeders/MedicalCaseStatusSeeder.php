<?php declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MedicalCaseStatus;

class MedicalCaseStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                'created_at' => now(),
                'updated_at' => now(),
                'title' => 'active',
                'description' => 'Caso médico em andamento',
                'is_active' => true
            ],
            [
                'created_at' => now(),
                'updated_at' => now(),
                'title' => 'closed',
                'description' => 'Caso médico não resolvido e abandonado',
                'is_active' => true
            ],
            [
                'created_at' => now(),
                'updated_at' => now(),
                'title' => 'expired',
                'description' => 'Caso médico pausado cujo prazo de continuidade foi excedido',
                'is_active' => true
            ],
            [
                'created_at' => now(),
                'updated_at' => now(),
                'title' => 'finished',
                'description' => 'Caso médico totalmente resolvido',
                'is_active' => true
            ],
            [
                'created_at' => now(),
                'updated_at' => now(),
                'title' => 'open',
                'description' => 'Caso médico em aberto e em andamento',
                'is_active' => true,
            ],
            [
                'created_at' => now(),
                'updated_at' => now(),
                'title' => 'paused',
                'description' => 'Caso médico não resolvido, mas temporariamente pausado',
                'is_active' => true
            ]
        ];

        MedicalCaseStatus::insert($statuses);
    }
}
