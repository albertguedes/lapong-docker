<x-layouts.main>
    <div class="card" >
        <div class="card-body">
            <h1 class="card-title">Medical Case Create</h1>
        </div>
    </div>

    <div class="card mt-4" >
        <div class="card-body">
            <form action="{{ route('medical.case.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="customer_id">{{ __('messages.patient') }}</label>
                            <select class="form-control @error('contact_id') is-invalid @enderror" id="contact_id" name="contact_id" >
                                <option value="">{{ __('messages.select') }}</option>
                                @foreach($contacts as $contact)
                                    <option value="{{ $contact->id }}">{{ $contact->profile->name() }}</option>
                                @endforeach
                            </select>
                            @error('contact_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">{{ __('messages.title') }}</label>
                    <input class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" ></input>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">{{ __('messages.case_description') }}</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" value="{{ old('description') }}"></textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>

            </form>
        </div>
    </div>
</x-layouts.main>
