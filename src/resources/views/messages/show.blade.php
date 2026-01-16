<x-layouts.main>
    <div class="row my-4 d-flex justify-content-between align-items-center" >
        <h1>
            <div class="float-start">
                Message
            </div>
        </h1>
    </div>
    <x-messages.nav></x-messages.nav>
    <x-messages.message-component :message="$message" ></x-messages.message-component>
</x-layouts.main>
