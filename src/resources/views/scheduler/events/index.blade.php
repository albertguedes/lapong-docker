<x-layouts.main>
    <div class="row my-4 d-flex justify-content-between align-items-center" >
        <h1>
            <div class="float-start">
                Agenda
            </div>
            <div class="float-end">
                <a href="{{ route('scheduler.event.create') }}" class="btn btn-primary float-end">
                    <i class="fa-solid fa-calendar-plus mr-2"></i>
                    Novo Evento
                </a>
            </div>
        </h1>
    </div>

    <x-scheduler.nav-component ></x-scheduler.nav-component>

    <div class="row" >
        <div class="col-12" >
            <h2 class="text-center pt-3 pb-4" >Eventos {{ $current_date->format('d \d\e M \d\e Y') }}</h2>
        </div>

        @if($events->isEmpty())
        <div class="col-12" >
            <div class="alert alert-info text-center" >
                Não há eventos agendados para essa data
            </div>
        </div>
        @else
        <div class="col-4 pe-4" >
            <x-scheduler.events.list-component :events="$events" :current="$current_event" ></x-scheduler.events.list-component>
        </div>
        <div class="col-8 ps-4" >
            <x-scheduler.events.event-component :current="$current_event" ></x-scheduler.events.event-component>
        </div>
        @endif
    </div>

    @push('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/js/script.js') }}" ></script>
    <script>
    $(function() {
        sameHeight('events-element');
    });
    </script>
    @endpush
</x-layouts.main>