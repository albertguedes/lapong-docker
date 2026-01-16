@if($messages->count() > 0)
    @foreach ( $messages as $i => $message )
    <div class="card card-message pt-2 my-2 @if($message->is_read) bg-dark-subtle @endif"
            data-url="{{ route('message', $message) }}"
        >
        <div class="card-body">
            <div class="row p-0">
                <div class="col-1 text-center align-self-center" >
                    <i class="fa-solid @if($message->is_read) fa-envelope-open text-secondary @else fa-envelope text-primary @endif"></i>
                </div>
                <div class="col-11">
                    <h3 class="card-title h6 text-capitalize text-muted" >
                        {{ $message->created_at->format('d M Y - H:i') }} from <a href="{{ route('scheduler.contacts', [ 'contact_id' => $message->sender->id ] ) }}"><i class="fa-solid fa-user mr-2"></i> {{ $message->sender->profile->name() }}</a></h3>
                    <h2 class="h4" >{{ $message->subject }}</h2>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@else
<div class="card card-message pt-2 my-2">
    <div class="card-body">
        <div class="row p-0">
            <div class="col-11">
                <h2 class="h4 text-center" >Não há mensagens novas.</h2>
            </div>
        </div>
    </div>
</div>
@endif

@push('footer_scripts')
<script type="text/javascript" src="{{ asset('assets/js/script.js') }}" ></script>
<script>
$(function() {
    cardLink('card-message');
});
</script>
@endpush