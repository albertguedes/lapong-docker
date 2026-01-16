<x-layouts.main>
    <x-customer.profile-component :customer="$customer" ></x-customer.profile-component>
    @push('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/js/script.js') }}" ></script>
    <script>
    $(function() {
        sameHeight('profile-card');
    });
    </script>
    @endpush
</x-layouts.main>