<x-layouts.main>

    <div class="row my-4 d-flex justify-content-between align-items-center" >
        <h1>
            <div class="float-start">
                <i class="fa-solid fa-file-medical mr-2"></i> {{ $case_id }}
            </div>
            <div class="float-end">
                <a href="{{ route('medical.case.create') }}" class="btn btn-primary float-end">
                    <i class="fa-solid fa-hospital mr-2"></i>
                    Novo Caso
                </a>
            </div>
        </h1>
    </div>

    <div class="row">
        <x-medical.cases.records.list-component :records="$records" ></x-medical.cases.records.list-component>
    </div>

</x-layouts.main>