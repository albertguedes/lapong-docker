<x-layouts.main>

    <div class="row mt-4 mb-5" >
        <div class="col-3" >
            <a class="btn btn-primary w-100 py-3" href="{{ route('medical.professional') }}">
                <i class="fa-solid fa-magnifying-glass"></i>
                {{ __('messages.search') }} {{ __('messages.professionals') }}
            </a>
        </div>
        <div class="col-3" >
            <a class="btn btn-primary w-100 py-3" href="{{ route('medical.consult') }}">
                <i class="fa-solid fa-calendar-days"></i>
                {{ __('messages.create') }} {{ __('messages.consultation') }}
            </a>
        </div>

        <div class="col-3" >
            <a class="btn btn-primary w-100 py-3" href="{{ route('medical.exam') }}">
                <i class="fa-solid fa-microscope"></i>
                {{ __('messages.create') }} {{ __('messages.exams') }}
            </a>
        </div>
        <div class="col-3" >
            <a class="btn btn-primary w-100 py-3" href="">
                <i class="fa-solid fa-pills"></i>
                {{ __('messages.pharmacy') }}
            </a>
        </div>
    </div>

    <div class="row mb-5" >
        <div class="col-4" >
            <div class="card" >
                <div class="card-header bg-white fw-bold">
                    <h2 class="card-title h5 pt-2">
                        <i class="fa-solid fa-calendar-days text-primary"></i>
                        {{ __('messages.next') }} {{ __('messages.events') }}
                    </h2>
                </div>
                <div class="card-body d-flex align-items-center card-dashboard">
                    <div class="row">
                        @if ( $next_event )
                        <div class="col-12 mb-3">
                            <h3 class="card-title h5 text-capitalize mb-0" >{{ $next_event->title }}</h3>
                        </div>
                        <div class="col-12">
                        <h4 class="card-subtitle text-muted h6 mb-0 ms-auto" >
                            {{ __('messages.begin') }}: {{ \Carbon\Carbon::parse($next_event->begin)->format('d M Y - H:i') }}<br>
                            {{ __('messages.end') }}: {{ \Carbon\Carbon::parse($next_event->end)->format('d M Y - H:i') }}
                        </h4>
                        </div>
                        @else
                        <div class="col-12">
                        <h4 class="card-subtitle text-muted h6 mb-0 ms-auto" >
                            {{ __('messages.no_events_today') }}
                        </h4>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card-footer bg-white pb-3 border-0">
                    @if($next_event)
                    <a class="btn btn-primary"
                        href="{{ route('scheduler.events', [
                            'current_event_id' => $next_event->id,
                            'year' => \Carbon\Carbon::parse($next_event->begin)->format('Y'),
                            'month' => \Carbon\Carbon::parse($next_event->begin)->format('m'),
                            'day' => \Carbon\Carbon::parse($next_event->begin)->format('d'),
                        ]) }}" >
                        Ver Detalhes
                    </a>
                    @else
                    <a class="btn btn-primary" href="{{ route('scheduler.events') }}">{{ __('messages.view_all') }}</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-4" >
            <div class="card" >
                <div class="card-header bg-white">
                    <h2 class="card-title h5 pt-2">
                        <i class="fa-solid fa-envelope text-primary"></i>
                        {{ __('messages.last') }} {{ __('messages.messages') }}
                    </h2>
                </div>
                <div class="card-body card-dashboard">
                    <h3 class="card-title h5 text-capitalize mb-3" >{{ $last_message->subject }}</h3>
                    <h4 class="card-subtitle text-muted h6 mb-4">{{ __('messages.sent_at') }} {{ $last_message->created_at->format('d M Y - H:i') }}<br> {{ __('messages.by') }} {{ $last_message->sender->profile->name() }}</h4>
                </div>
                <div class="card-footer bg-white pb-3 border-0">
                    <a class="btn btn-primary"
                        href="{{ route('message', [
                        'message' => $last_message->id
                        ]) }}" class="btn btn-primary">Ver Detalhes</a>
                </div>
            </div>
        </div>
        <div class="col-4" >
            <div class="card" >
                <div class="card-header bg-white">
                    <h2 class="card-title h5 pt-2">
                        <i class="fa-solid fa-bell text-primary"></i>
                        {{ __('messages.last') }} {{ __('messages.notifications') }}
                    </h2>
                </div>
                <div class="card-body card-dashboard">
                    <h3 class="card-title h5 text-capitalize mb-3" >{{ $last_notification->content }}</h3>
                    <h4 class="card-subtitle text-muted h6 mb-4" >{{ __('messages.sent_at') }} {{ $last_notification->created_at->format('d M Y - H:i') }}</h4>
                </div>
                <div class="card-footer bg-white pb-3 border-0">
                    <a class="btn btn-primary"
                        href="{{ route('notifications', [ 'filter' => 'unread']) }}"
                        class="btn btn-primary">
                        Ver Detalhes
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row" >

        <div class="col-12" >
            <h2 class="mb-4">
                <i class="fa-solid fa-newspaper"></i>
                {{ __('messages.latest') }} {{ __('messages.news') }}
            </h2>
        </div>

        @foreach ($latest_news as $new)
        <div class="col-4" >
            <div class="card" >
                <div class="card-header p-0">
                    <img class="card-img-top" src="https://picsum.photos/seed/{{ $new->id }}/400/300" alt="{{ $new->title }}">
                </div>
                <div class="card-body">
                    <h3>{{ $new->title }}</h3>
                    <p class="text-muted h6 mb-3">
                        {{ $new->created_at->format('d M Y - H:i') }}
                        por {{ $new->author->profile->name() }}
                    </p>
                    <p>{{ Str::limit($new->content, 140) }}</p>
                </div>
                <div class="card-footer bg-white pb-3 border-0">
                    <a href="{{ route('new', $new->id) }}" class="btn btn-primary">{{ __('messages.read_more') }}</a>
                </div>
            </div>
        </div>
        @endforeach

    </div>

    @push('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/js/script.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/dashboard.js') }}" ></script>
    @endpush
</x-layouts.main>
