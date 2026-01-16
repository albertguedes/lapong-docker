<div class="row">

    <div class="col-6 pb-3" >
        <div class="card profile-card" >
            <div class="card-body">
                <h3 class="h4 mb-3 fw-bold" ><i class="fa-solid fa-envelope text-primary mr-2"></i> Emails</h3>
                <ul class="list-unstyled">
                    @if(count($company['emails']) > 0)
                        @foreach($company['emails'] as $email)
                        <li class="text-secondary">
                            {{ $email['value'] }}
                            @if($email['label'] != '')
                            <strong class="text-success" >
                                ({{ $email['label'] }})
                            </strong>
                            @endif
                        </li>
                        @endforeach
                    @else
                    <li class="text-secondary">Nenhum email cadastrado</li>
                    @endif
                </ul>

                <h3 class="fw-bold h4 mt-5 mb-3" >
                    <i class="fa-solid fa-phone text-primary mr-2"></i>
                    Telefones
                </h3>
                <ul class="list-unstyled">
                    @if(count($company['phones']) > 0)
                        @foreach($company['phones'] as $phone)
                        <li class="text-secondary">
                            {{ $phone['value'] }} @if($phone['label'] != '') ({{ $phone['label'] }}) @endif
                        </li>
                        @endforeach
                    @else
                    <li class="text-secondary">Nenhum telefone cadastrado</li>
                    @endif
                </ul>

                <h3 class="h4 fw-bold mt-5 mb-3"><i class="fa-solid fa-file-alt text-primary mr-2"></i> Documentos</h3>
                <ul class="list-unstyled">
                    @if(count($company['documents']) > 0)
                        @foreach($company['documents'] as $document)
                        <li>
                            <p>
                                <strong class="text-uppercase" >{{ $document['type'] }}</strong><br>
                                <span class="text-secondary">{{ $document['value'] }}</span>
                            </p>
                        </li>
                        @endforeach
                    @else
                    <li class="text-secondary">Nenhum documento cadastrado</li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <div class="col-6" >
        <div class="card profile-card" >
            <div class="card-body">
                <h3 class="h4 fw-bold mb-3" >
                    <i class="fa-solid fa-location-dot text-primary mr-2"></i>
                    Endereços
                </h3>
                <ul class="list-unstyled">
                    @if(count($company['addresses']) > 0)
                        @foreach($company['addresses'] as $address)
                        <li class="text-secondary mb-3 border-bottom pb-3">
                            @if($address['label'] != '')
                            <h4 class="h6 mb-2 text-dark text-uppercase">{{ $address['label'] }}</h4>@endif
                            {{ $address['postal_code'] }},
                            {{ $address['address_line_1'] }},
                            {{ $address['address_line_2'] }}<br>
                            {{ $address['city'] }},
                            {{ $address['state_or_province'] }},
                            {{ $address['country'] }}
                        </li>
                        @endforeach
                    @else
                    <li class="text-secondary">Nenhum endereço cadastrado</li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
