<div class="card">
    <div class="card-body">

        <form action="{{ route('medical.case.record.store', [ 'medicalCase' => $medicalCase ]) }}" method="post">

            @csrf

            <input type="hidden" name="record[medical_case_id]" value="{{ $medicalCase->id }}">
            <input type="hidden" name="record[is_active]" value="1">

            <div class="form-group mb-3">
                <div class="input-group">
                    <label class="input-group-text text-center justify-content-center" for="type">
                        <i class="fa-solid fa-file-medical"></i>
                    </label>
                    <select class="form-control @error('type') is-invalid @enderror" id="type" name="record[medical_case_record_type_id]" required>
                        <option value="">Selecione o tipo de registro</option>
                        @foreach($medicalCaseRecordTypes as $medicalCaseRecordType)
                        <option value="{{ $medicalCaseRecordType->id }}">
                            {{ ucwords($medicalCaseRecordType->title) }}
                        </option>
                        @endforeach
                    </select>
                    @error('type')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group mb-3">
                <div class="input-group">
                    <label class="input-group-text justify-content-center" for="title">
                        <i class="fa-solid fa-file-signature"></i>
                    </label>
                    <input class="form-control @error('title') is-invalid @enderror" id="title" name="record[title]" value="{{ old('title') }}" required>
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group mb-3">
                <div class="input-group">
                    <label class="input-group-text justify-content-center" for="description">
                        <i class="fa-solid fa-file-lines"></i>
                    </label>

                    <textarea class="form-control @error('description') is-invalid @enderror"
                        id="description"
                        name="record[description]"
                        rows="5"
                        placeholder="Digite a descrição do registro"
                        required
                    >{{ old('description') }}</textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-floppy-disk me-2"></i>
                Registrar
            </button>

            @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </form>

    </div>
</div>

@push('footer_scripts')
<script type="text/javascript" src="{{ asset('assets/js/script.js') }}" ></script>
<script type="text/javascript" >
$(function(){
    setUniformWidth('input-group-text');
});
</script>
@endpush