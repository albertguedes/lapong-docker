<x-layouts.main>

    <div class="row my-4 d-flex justify-content-between align-items-center" >
        <h1>
            <div class="float-start">
                Notificações
            </div>
        </h1>
    </div>

    <x-notifications.nav-component></x-notifications.nav-component>

    @if($notifications->count() > 0)
        @foreach ( $notifications as $i => $notification )
        <div class="card card-notification mb-2 @if($notification->is_read) bg-dark-subtle @endif"
            data-url="{{ route('notification.update', $notification) }}" >
            <div class="card-body ps-5">
                <i class="fa-solid fa-bell @if($notification->is_read) text-secondary @else text-{{ $notification->type->title }} @endif"></i>
                <span class="text-muted ms-5" >{{ $notification->created_at->format('d M Y - H:i') }}</span>
                <span class="ms-5" >{{ $notification->content }}</span>
            </div>
        </div>
        @endforeach
    @else
    <div class="card" >
        <div class="card-body">
            <h2 class="card-title text-center" >Nenhuma notificação nova.</h2>
        </div>
    </div>
    @endif

    @push('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/js/script.js') }}" ></script>
    <script>
    $(function() {
        cardLink('card-notification');
    });
    </script>
    @endpush
</x-layouts.main>