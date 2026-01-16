<div class="card contacts-element" >
    <div class="card-body">
        @if($current)
        <x-customer.profile-component :customer="$current" ></x-customer.profile-component>
        @else
        <h2 class="card-title" >
            Não há contatos registrados na agenda.
        </h2>
        @endif
    </div>
</div>
