<x-layouts.main>

    <div class="row my-4 d-flex justify-content-between align-items-center" >
        <h1>
            <div class="float-start">
                Novo Registro
            </div>
        </h1>
    </div>

    <div class="row" >
        <div class="col-12">
            <x-medical.cases.records.record-form-component :medicalCase="$medicalCase" ></x-medical.cases.records.record-form-component>
        </div>
    </div>
</x-layouts.main>