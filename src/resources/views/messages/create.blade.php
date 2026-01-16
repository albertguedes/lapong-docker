<x-layouts.main>

    <div class="row my-4 d-flex justify-content-between align-items-center" >
        <h1>
            <div class="float-start">
                Compose
            </div>
        </h1>
    </div>

    <x-messages.nav></x-messages.nav>

    <div class="card">
        <div class="card-body">
            <x-messages.create.message-form-component :sender="$sender" :receiver="$receiver" ></x-messages.create.message-form-component>
        </div>
    </div>
</x-layouts.main>