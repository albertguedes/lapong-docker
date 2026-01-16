<x-layouts.main>
    <div class="card" >
        <div class="card-body">
            <h1 class="card-title">Customer Contacts</h1>
        </div>
    </div>
</x-layouts.main>

<div class="card mt-4" >
    <div class="card-body pb-0">
        <ul class="list-inline">
            <li class="list-inline-item">
                <a href="{{ route('customer.schedulers') }}" class="btn btn-primary" >{{ __('messages.calendar') }}</a>
            </li>
            <li class="list-inline-item">
                {{ __('messages.contacts') }}
            </li>
        </ul>
    </div>
</div>
