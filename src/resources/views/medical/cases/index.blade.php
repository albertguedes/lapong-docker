<x-layouts.main>

    <div class="row my-4 d-flex justify-content-between align-items-center" >
        <h1>
            <div class="float-start">
                Casos Médicos
            </div>
        </h1>
    </div>

    <div class="row">
        <div class="col-4 pe-4" >
            <x-medical.cases.list-component :cases="$cases" :current="$current_case"></x-medical.cases.list-component>
        </div>
        <div class="col-8 ps-4" >
            <x-medical.cases.records.list-component :current="$current_case" ></x-medical.cases.records.list-component>
        </div>
    </div>

    @push('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/js/script.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/medical/cases/index.js') }}" ></script>
    @endpush
</x-layouts.main>