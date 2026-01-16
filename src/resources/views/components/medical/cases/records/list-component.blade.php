@if(count($records)>0)
<div class="row" >
    <div class="col-12 mb-4">
        @if($current['disabled'])
        <button class="btn btn-muted" title="Novo Registro Desabilitado" disabled="disabled">
            <i class="fa-solid fa-notes-medical me-2"></i>
            Novo Registro
        </button>
        @else
        <a class="btn btn-primary" href="{{ route('medical.case.record.create', [ 'medicalCase' => $current['id'] ]) }}" >
            <i class="fa-solid fa-notes-medical me-2"></i>
            Novo Registro
        </a>
        @endif
    </div>
</div>

<div class="row" >
    <div class="col-12">

        <div class="card mb-3">
            <div class="card-body">
                <h2 class="card-title h3">{{ $current['title'] }}</h2>
                <p><strong>Responsável:</strong>
                    <a href="{{ route('scheduler.contacts', [ 'contact_id' => $current['responsible']['id'] ] ) }}">
                        <i class="fa-solid fa-user mr-2"></i>
                        {{ $current['responsible']['name'] }}
                    </a>
                </p>
                <p class="card-text">{{ $current['description'] }}</p>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-white border-0 pt-3 ps-4">
                <h2 class="card-title h3 text-secondary text-capitalize">Registros</h2>
            </div>
            <div class="card-body ps-5">
                <div class="row border-secondary-subtle border-5 border-start" >
                    @foreach($records as $key => $record)
                    <div class="col-12 ps-4">
                        <div class="card h-100 bg-transparent rounded-0 card-record"
                            data-url="{{ route('medical.case.record', [ 'medicalCase' => $current['id'], 'medicalCaseRecord' => $record['id'] ]) }}"
                        >
                            <div class="card-body d-flex flex-column">
                                <p>{{ $record['created_at'] }}</p>
                                <span class="position-absolute translate-middle py-2 px-3 bg-{{ $record['type_color'] }} text-white rounded-circle record-badge">{{ count($records) - $key }}</span>
                                <h2 class="card-title text-capitalize text-{{ $record['type_color'] }}">{{ $record['type'] }}</h2>
                                <div class="card-text">
                                    <p>{{ $record['title'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Nenhum Registro Criado</h2>
        </div>
    </div>
</div>
@endif

@push('footer_scripts')
<script type="text/javascript" >
$(function(){
    cardLink('card-record');
});
</script>
@endpush