<x-layouts.main>
    <div class="row my-4 d-flex justify-content-between align-items-center" >
        <h1>
            <div class="float-start">
                Messages Sent
            </div>
        </h1>
    </div>
    <x-messages.nav></x-messages.nav>
    <x-messages.list-component :messages="$messages" ></x-messages.list-component>
</x-layouts.main>
