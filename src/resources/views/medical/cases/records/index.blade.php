<x-layouts.main>
<div class="card mb-4" >
    <div class="card-body pb-0">
        <h1 class="card-title">Medical Records</h1>
    </div>
</div>

<div class="row">
    @foreach($records as $record)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <p><a class="badge bg-secondary text-white" href="#" >Caso #{{ $record->case->id }}</a> <span class="badge bg-success">Em Andamento</span></p>
                    <h2 class="card-title h4">Registro #{{ $record->id }}</h2>
                    <h3 class="card-title h6">
                        <a href="{{ route('medical.record', $record) }}">
                            <i class="fa-solid fa-user-doctor"></i> {{ $record->doctor->id }}
                        </a>
                    </h3>
                    <a href="{{ route('medical.record', $record) }}" class="btn btn-primary">Ver Detalhes</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

</x-layouts.main>