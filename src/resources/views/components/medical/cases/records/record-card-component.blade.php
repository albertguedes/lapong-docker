<div class="card mb-4">

    <div class="card-header border-0 bg-white mb-3">
        <span class="float-start text-muted" >
            <i class="fa-solid fa-file-medical me-2"></i>
            <a href="{{ route('medical.cases', [ 'medical_case_id' => $record['case_id'] ]) }}" >
                Caso #{{ $record['case_id'] }}
            </a>
            / Registro #{{ $record['id'] }}
        </span>
        <span class="float-end text-muted" >
            <i class="fa-solid fa-calendar-day"></i>
            {{ $record['created_at'] }}
        </span>
    </div>

    <div class="card-body">

        <ul class="list-group list-group-flush">

            <li class="list-group-item border-0 pb-4" >
                <h2 class="badge bg-{{ $record['type_color'] }} text-uppercase" >{{ $record['type'] }}</h2>
            </li>

            <li class="list-group-item border-0 py-1" >
                <strong><i class="fa-solid fa-user me-3"></i> Responsável:</strong>
                <a href="{{ route('scheduler.contacts', [ 'contact_id' => $record['responsible']['id'] ] ) }}">
                    {{ $record['responsible']['name'] }}
                </a>
            </li>

            @if(count($record['participants']) > 0)
            <li class="list-group-item border-0 pb-4 py-1">
                <strong><i class="fa-solid fa-users me-2"></i> Participantes:</strong>
                @foreach ( $record['participants'] as $participant)
                <a href="{{ route('scheduler.contacts', [ 'contact_id' => $participant['id'] ] ) }}" >
                    {{ $participant['name'] }}
                </a>
                @endforeach
            </li>
            @endif

            <li class="list-group-item py-3" >
                {{ $record['description'] }}
            </li>
        </ul>
    </div>
</div>

<div class="card" >
    <div class="card-body">
        <ul class="list-group list-group-flush border-0">
            <li class="list-group-item border-0" >
                <h2 class="h5 py-1 fw-bold" >ANEXOS</h2>
            </li>

            <li class="list-group-item border-0">
                <a href="#" >
                    <i class="fa-solid fa-download"></i> Documento 1
                </a>
            </li>
            <li class="list-group-item border-0" >
                <a href="#" >
                    <i class="fa-solid fa-download"></i> Documento 2
                </a>
            </li>
        </ul>
    </div>
</div>
