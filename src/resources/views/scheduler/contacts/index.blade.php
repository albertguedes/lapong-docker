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
            <h2 class="text-center pt-3 pb-4" >Contatos</h2>
        </div>

        <div class="col-4 pe-4" >
            <x-scheduler.contacts.list-component :contacts="$contacts" :current="$current" ></x-scheduler.contacts.list-component>
        </div>
        <div class="col-8 ps-4" >
            <x-scheduler.contacts.profile-component :current="$current" ></x-scheduler.contacts.profile-component>
        </div>
    </div>

    @push('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/js/script.js') }}" ></script>
    <script>
    $(function() {
        cardLink('card-contact');
        sameHeight('contacts-element');
    });
    </script>
    @endpush
</x-layouts.main>