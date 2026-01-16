<?php declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RequestType;

class RequestTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                "title" => "contato",
                "description" => "Solicitação de contato",
                "is_active" => true
            ],
            [
                "title" => "consulta",
                "description" => "Solicitação de consulta médica",
                "is_active" => true
            ],
            [
                "title" => "exame",
                "description" => "Solicitação de exame",
                "is_active" => true
            ],
            [
                "title" => "agendamento",
                "description" => "Solicitação de agendamento",
                "is_active" => true
            ]
        ];

        RequestType::factory()->createMany($types);
    }
}
