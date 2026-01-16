<x-layouts.main>
    <div class="row mt-3 mb-4 px-3" >
        <div class="col-12 border-bottom p-0">
            <ul id="record-nav" class="nav w-100 d-flex justify-content-between" >
                <li class="nav-item" >
                    @if($previous_id)
                    <a class="nav-link fw-bold py-3 text-dark"
                        href="{{ route('medical.case.record',
                            [
                                'medicalCase' => $medicalCaseRecord->case->id,
                                'medicalCaseRecord' => $previous_id
                            ]
                        ) }}"
                    >
                        <i class="fa-solid fa-arrow-left me-2"></i>
                        Registro Anterior
                    </a>
                    @endif
                </li>
                <li class="nav-item" >
                    <a class="nav-link fw-bold py-3 text-dark"
                        href="{{ route('medical.cases', $medicalCaseRecord->case->id) }}"
                    >
                        <i class="fa-solid fa-file-medical me-2"></i>
                        Casos Médicos
                    </a>
                </li>
                <li class="nav-item" >
                    @if($next_id)
                    <a class="nav-link fw-bold py-3 text-dark"
                        href="{{ route('medical.case.record',
                            [
                                'medicalCase' => $medicalCaseRecord->case,
                                'medicalCaseRecord' => $next_id
                            ]
                        ) }}"
                    >
                        <i class="fa-solid fa-arrow-right me-2"></i>
                        Próximo Registro
                    </a>
                    @endif
                </li>

            </ul>
        </div>
    </div>

    <div class="row mt-3 mb-4 px-3" >
        <div class="col-12" >
            <x-medical.cases.records.record-card-component :record="$medicalCaseRecord" ></x-medical.cases.records.record-card-component>
        </div>
    </div>
</x-layouts.main>