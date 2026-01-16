<form action="{{ route('message.store') }}" method="POST">

    @csrf

    <input type="hidden" name="sender_id" value="{{ $sender['id'] }}">

    <div class="mb-3">
        <div class="input-group">
            <span class="input-group-text message-input-label"><i class="fa-solid fa-user"></i></span>

            <select class="form-control @error('receiver_id') is-invalid @enderror" id="receiver_id" name="receiver_id"
            @if(count($sender['contacts']) == 1) disabled @endif
            required>
                <option value="" disabled selected>Selecione o destinatário</option>
                @if(count($sender['contacts']) == 1)
                <option value="{{ $sender['contacts'][0]['id'] }}" selected="selected">
                    {{ $sender['contacts'][0]['name'] }}
                </option>
                @else
                    @foreach ($sender['contacts'] as $contact)
                    <option value="{{ $contact['id'] }}" @if ($contact["id"] == old('receiver_id')) selected="selected" @endif>
                        {{ $contact['name'] }}
                    </option>
                    @endforeach
                @endif
            </select>

            @error('receiver_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <div class="input-group">
            <span class="input-group-text message-input-label"><i class="fa-solid fa-file-signature"></i></span>
            <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" value="{{ old('subject') }}" placeholder="Digite o assunto" required>
            @error('subject')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <div class="input-group">
            <span class="input-group-text message-input-label"><i class="fa-solid fa-comment"></i></span>
            <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="15" placeholder="Digite sua mensagem" required>{{ old('message') }}</textarea>
            @error('message')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="w-100 text-center">
        <button type="submit" class="btn btn-primary btn-lg">Send Message</button>
    </div>

</form>

@push('footer_scripts')
<script type="text/javascript" src="{{ asset('assets/js/script.js') }}" ></script>
<script>
$(function() {
    setUniformWidth('message-input-label');
})
</script>
@endpush