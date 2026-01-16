<div class="row">
    <div class="col-12 justify-content-end mb-4">
        <a href="{{ route('medical.case.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-file-medical mr-2"></i>
            Novo Caso
        </a>
    </div>
    @if(count($cases)>0)
        @foreach($cases as $case)
        <div class="col-12 mb-4">
            <div class="card card-case h-100 @if($case['current']) border-start border-5 border-{{ $case['status_color'] }} @endif"
                data-url="{{ route('medical.cases', [ 'medical_case_id' => $case['id'] ]) }}">

                <div class="card-header border-0 h6 bg-white text-muted py-2 ps-3">
                    <div class="float-start" >
                        <i class="fa-solid fa-file-medical mr-2"></i>
                        {{ $case['id'] }}
                    </div>
                    <div class="float-end" >
                        <i class="fa-solid fa-calendar-day me-2"></i>
                        {{ $case['created_at'] }}
                    </div>
                </div>

                <div class="card-body d-flex flex-column">
                    <h2 class="card-title h5 text-capitalize @if($case['current']) text-{{ $case['status_color'] }} @endif">
                        {{ $case['title'] }}
                    </h2>
                    <p class="card-subtitle h6 mb-3">
                        <span class="badge bg-{{ $case['status_color'] }} text-capitalize">
                            {{ $case['status'] }}
                            @if($case['status']=='paused' || $case['status']=='closed' || $case['status']=='finished')
                            {{ $case['updated_at'] }}
                            @endif
                        </span>
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    @else
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Nenhum Caso Criado</h2>
            </div>
        </div>
    </div>
    @endif
</div>