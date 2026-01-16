<?php declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompanyServiceType;

class CompanyServiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                "title" => "consulta",
                "description" => "Atendimento médico em que o profissional de saúde avalia o paciente e estabelece um diagnóstico, plano de tratamento e/ou prescreve medicamentos.",
                "is_active" => true
            ],

            [
                "title" => "exame",
                "description" => "Procedimento que visa obter informações sobre o estado de saúde de um paciente. Pode ser realizado por meio de exames laboratoriais, de imagem ou outros procedimentos diagnósticos.",
                "is_active" => true
            ],

            [
                "title" => "tratamento",
                "description" => "Procedimento que visa aliviar ou curar uma doença ou lesão. Pode incluir medicamentos, cirurgias, terapias, mudanças de estilo de vida ou outros procedimentos.",
                "is_active" => true
            ],

            [
                "title" => "procedimento",
                "description" => "Procedimento que visa prevenir, diagnosticar, tratar ou reabilitar uma doença ou lesão. Pode incluir procedimentos cirúrgicos, injeções, retirada de amostras, entre outros.",
                "is_active" => true
            ]
        ];

        CompanyServiceType::factory()->createMany($types);
    }
}
