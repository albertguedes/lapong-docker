<x-layouts.main>

    <div class="row">
        <div class="col-12" >
            <div class="card bg-transparent" >
                <div class="card-body">
                    <h1 class="fw-bold mb-3" ><i class="fa fa-building"></i> {{ $company['trade_name'] }}</h1>
                    <ul class="list-inline" >
                        <li class="list-inline-item" >
                            <span class="text-secondary">{{ $company['legal_name'] }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <x-company.nav-component></x-company.nav-component>

    <x-company.info-component :company="$company"></x-company.info-component>

</x-layouts.main>