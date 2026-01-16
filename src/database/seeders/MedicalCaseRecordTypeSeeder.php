<?php declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MedicalCaseRecordType;

class MedicalCaseRecordTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                "title" => "conclusão",
                "description" => "Conclusão de um caso médico é o resultado final do tratamento de uma doença ou condição médica, podendo ser um diagnóstico definitivo, um plano de tratamento, um prognóstico, um relatório de alta ou outro resultado.",
                "is_active" => true
            ],
            [
                "title" => "consulta",
                "description" => "Atendimento médico em que o profissional de saúde avalia o paciente e estabelece um diagnóstico, plano de tratamento e/ou prescreve medicamentos.",
                "is_active" => true
            ],

            [
                "title" => "diagnóstico",
                "description" => "O diagnóstico   o processo de avalia o que tem como objetivo identificar a natureza da doen a ou les o. O diagnóstico pode ser clínico, baseado em sinais e sintomas, ou pode ser complementado por exames laboratoriais e de imagem.",
                "is_active" => true
            ],

            [
                "title" => "exame",
                "description" => "Exame médico é um procedimento utilizado para avaliar a saúde do paciente, identificar doenças ou condições médicas, e monitorar o progresso do tratamento. Ele pode incluir testes físicos, laboratoriais e de imagem.",
                "is_active" => true
            ],

            [
                "title" => "medicação",
                "description" => "Medicação médica é o uso de substâncias químicas para prevenir, aliviar ou curar doenças ou condições médicas. Isso pode incluir medicamentos prescritos, suplementos nutricionais, vacinas e outros produtos farmacêuticos.",
                "is_active" => true
            ],

            [
                "title" => "outro",
                "description" => "Outro tipo de registro médico não especificado anteriormente",
                "is_active" => true
            ],

            [
                "title" => "procedimento",
                "description" => "Procedimento médico   um ato ou série de atos realizados por um profissional de saúde para prevenir, diagnosticar, tratar ou reabilitar uma doença ou les o. Isso pode incluir procedimentos cirúrgicos, inje es, retirada de amostras, entre outros.",
                "is_active" => true
            ],

            [
                "title" => "prognóstico",
                "description" => "Prognóstico médico é uma previsão do curso e resultado esperado de uma doença, incluindo a chance de recuperação ou recorrência. Ele é baseado em informações como o tipo de doença, estágio, resposta ao tratamento e condições de saúde do paciente.",
                "is_active" => true
            ],

            [
                "title" => "retorno",
                "description" => "Retorno médico é o ato de um paciente retornar ao consultório ou hospital após uma consulta, exame, tratamento ou procedimento médico para avaliar o resultado, realizar ajustes no tratamento ou realizar novas avaliações.",
                "is_active" => true
            ],

            [
                "title" => "tratamento",
                "description" => "Tratamento médico   o plano de a o desenvolvido pelo profissional de saúde para aliviar ou curar uma doença ou les o. O tratamento pode incluir medicamentos, cirurgias, terapias, mudan as de estilo de vida ou outros procedimentos médicos.",
                "is_active" => true
            ]
        ];

        MedicalCaseRecordType::factory()->createMany($types);
    }
}
