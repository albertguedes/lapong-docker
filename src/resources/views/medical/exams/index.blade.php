<x-layouts.main>

    <div class="row my-4 d-flex justify-content-between align-items-center" >
        <div class="col-6">
            <h1>
                <div class="float-start">
                    Exames
                </div>
            </h1>
        </div>
    </div>

    <div class="row" >
        <div class="col-12" >
            <form action="{{ route('medical.exam.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <label for="date" class="form-label">Data</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="col-6">
                        <label for="time" class="form-label">Hora</label>
                        <input type="time" class="form-control" id="time" name="time" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <label for="professional_id" class="form-label">Profissional</label>
                        <select class="form-select" id="professional_id" name="professional_id" required>
                            <option value="">Selecione um profissional</option>
                            @foreach ($professionals as $professional)
                            <option class="text-white" value="{{ $professional->id }}" >{{ $professional->profile->name() }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <label for="reason" class="form-label">Motivo da Exame</label>
                        <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Marcar Exame</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</x-layouts.main>