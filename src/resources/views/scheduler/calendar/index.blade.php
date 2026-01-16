<x-layouts.main>

    <div class="row my-4 d-flex justify-content-between align-items-center" >
        <h1>
            <div class="float-start">
                Agenda
            </div>
        </h1>
    </div>

    <x-scheduler.nav-component ></x-scheduler.nav-component>

    <div class="row" >
        <div class="col-12" >
            <x-scheduler.calendar-component :events="$events" :current="$current_date" ></x-scheduler.calendar-component>
        </div>
    </div>

    @push('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/js/script.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/scheduler/calendar/calendar.js') }}" ></script>
    @endpush
</x-layouts.main>