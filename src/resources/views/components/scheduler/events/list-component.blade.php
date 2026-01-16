@if(count($events)>0)
    <div class="events-element" style="max-height: 500px; overflow-y: auto;">
        @foreach($events as $event)
        <div class="card card-event pt-3 pb-2 mb-4 @if($event['is_current']) active @endif @if($event['is_ended']) bg-light @endif"
            data-url="{{ $event['route'] }}"
            >
            <div class="card-body">
                <div class="row p-0 @if($event['is_ended']) text-muted @else text-dark @endif">
                    <div class="col-1 px-4 text-center fw-semibold align-self-center" >
                    <i class="fa-solid fa-calendar-day h4"></i>
                    </div>
                    <div class="col ps-4 align-self-center">
                        <h3 class="card-title h6 fw-semibold text-capitalize " >
                            {{ $event['title'] }}
                        </h3>
                        <p class="h6" >{{ $event['begin'] }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@else
<div class="card" >
    <div class="card-body">
        <h3 class="card-title" >
            Não há eventos agendados para hoje.
        </h3>
    </div>
</div>
@endif

@push('footer_scripts')
<script type="text/javascript" src="{{ asset('assets/js/script.js') }}" ></script>
<script>
$(function() {
    cardLink('card-event');
});
</script>
@endpush