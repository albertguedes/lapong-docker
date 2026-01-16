@if(count($contacts)>0)
<div class="contacts-element overflow-y-auto">
    @foreach($contacts as $contact)
        <div class="card card-contact pt-2 mb-4 @if($contact['current']) active @endif"
            data-url="{{ route('scheduler.contacts', [ 'contact_id' => $contact['id'] ]) }}"
        >
            <div class="card-body">
                <div class="row p-0">
                    <div class="col-1 px-3 text-center align-self-center" >
                        <i class="fa-solid @if(in_array($contact['roles'],['professional'] )) fa-user-doctor @else fa-user @endif" ></i>
                    </div>
                    <div class="col-11 px-3 align-self-center">
                        <h3 class="card-title h6 text-capitalize" >
                            {{ $contact['name'] }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@else
<div class="card my-3" >
    <div class="card-body">
        <h3 class="card-title" >
            Não há contatos adicionados na sua agenda.
        </h3>
    </div>
</div>
@endif

@push('footer_scripts')
<script type="text/javascript" src="{{ asset('assets/js/script.js') }}" ></script>
<script>
$(function() {
    cardLink('card-contact');
});
</script>
@endpush