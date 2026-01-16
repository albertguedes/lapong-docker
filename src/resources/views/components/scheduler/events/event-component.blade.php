<div class="card  @if($current_event['is_ended']) bg-secondary-subtle @endif events-element px-1" >
    <div class="card-body p-4">
        @if($current_event)
            <h2 class="card-title h3 fw-bold text-capitalize" >
                {{ $current_event['title'] }}
            </h2>

            <p class="h6 py-3 text-disabled" >
                <i class="fa-solid fa-calendar me-2"></i>
                {{ $current_event['begin'] }} - {{ $current_event['end'] }}
                @if($current_event['is_ended']) <span class="badge bg-danger">{{ __('messages.ended') }}</span>@endif
            </p>

            @if($current_event['participants'])
            <p class="pb-3" >
                <i class="fa-solid fa-users me-2"></i> {{ count($current_event['participants']) }} {{ __('messages.participants') }}:
                @foreach ( $current_event['participants'] as $participant)
                <a class="list-inline-link h6 fw-bolder text-primary" href="{{ route('scheduler.contacts', [ 'contact_id' => $participant['id'] ] ) }}" >
                    {{ $participant['name'] }}
                </a>,
                @endforeach
            </p>
            @endif

            <p>{{ $current_event['description'] }}</p>
        @else
            <h2 class="card-title" >
                {{ __('messages.no_events_to_view') }}
            </h2>
        @endif
    </div>
</div>
