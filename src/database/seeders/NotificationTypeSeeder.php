<?php declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NotificationType;

class NotificationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                "title" => "success",
                "description" => "Aviso de sucesso"
            ],
            [
                "title" => "warning",
                "description" => "Aviso importante"
            ],
            [
                "title" => "danger",
                "description" => "Aviso critico"
            ],
            [
                "title" => "info",
                "description" => "Aviso informativo"
            ],
            [
                "title" => "primary",
                "description" => "Aviso padrão"
            ]
        ];

        NotificationType::factory()->createMany($types);
    }
}
