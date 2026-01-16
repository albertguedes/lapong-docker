<x-layouts.main>
    <x-professionals.profile-component :professional="$professional" ></x-professionals.profile-component>
    @push('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/js/script.js') }}" ></script>
    <script>
    $(function() {
        sameHeight('profile-card');
    });
    </script>
    @endpush
</x-layouts.main>