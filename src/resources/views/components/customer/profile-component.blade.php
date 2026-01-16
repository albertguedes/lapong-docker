<div class="row">
    <div class="col-12 pb-3" >

        <div class="card bg-transparent" >
            <div class="card-body">
                <h1 class="fw-bold mb-3" ><i class="fa fa-user"></i> {{ $customer['name'] }}</h1>
                @if($customer['company'])
                <h2 class="h6 text-muted mb-4">
                    <i class="fa fa-building"></i>
                    {{ $customer['company']['trade_name'] }}
                </h2>
                @endif
                <ul class="list-inline" >
                    <li class="list-inline-item" >
                        @if($customer['gender'])
                        <i class="fa-solid fa-mars text-male"></i> <span class="text-secondary">{{ $customer['gender_name'] }}</span>
                        @else
                        <i class="fa-solid fa-venus text-female"></i> <span class="text-secondary">{{ $customer['gender_name'] }}</span>
                        @endif
                    </li>
                    <li class="list-inline-item" >
                        <i class="fa-solid fa-birthday-cake"></i>
                        <span class="text-secondary">{{ $customer['birthdate'] }} ({{ $customer['age'] }} anos)</span>
                    </li>
                </ul>
            </div>
        </div>

        @if($customer['id']!=auth()->user()->id)
        <div class="card" >
            <div class="card-body">
                <a href="{{ route('message.create', ['receiver_id' => $customer['id']]) }}" class="btn btn-primary" >
                    <i class="fa-solid fa-envelope mr-2"></i>
                    Send Message
                </a>

                <a href="{{ route('news', ['author_id' => $customer['id']]) }}" class="btn btn-success" >
                    <i class="fa-solid fa-newspaper mr-2"></i>
                    News
                </a>
            </div>
        </div>
        @endif

    </div>

    <div class="col-6 pb-3" >
        <div class="card profile-card" >
            <div class="card-body">
                <h3 class="h4 mb-3 fw-bold" ><i class="fa-solid fa-envelope text-primary mr-2"></i> Emails</h3>
                <ul class="list-unstyled">
                    <li class="text-secondary">
                        {{ $customer['main_email'] }} <strong class="text-success" >(main)</strong>
                    </li>
                    @foreach($customer['emails'] as $email)
                    <li class="text-secondary">
                        {{ $email['value'] }}
                        @if($email['label'] != '')
                        <strong class="text-success" >
                            ({{ $email['label'] }})
                        </strong>
                        @endif
                    </li>
                    @endforeach
                </ul>

                <h3 class="fw-bold h4 mt-5 mb-3" >
                    <i class="fa-solid fa-phone text-primary mr-2"></i>
                    Telefones
                </h3>
                <ul class="list-unstyled">
                    @foreach($customer['phones'] as $phone)
                    <li class="text-secondary">
                        {{ $phone['value'] }} @if($phone['label'] != '') ({{ $phone['label'] }}) @endif
                    </li>
                    @endforeach
                </ul>

                <h3 class="h4 fw-bold mt-5 mb-3"><i class="fa-solid fa-file-alt text-primary mr-2"></i> Documentos</h3>
                <ul class="list-unstyled">
                    @foreach($customer['documents'] as $document)
                    <li>
                        <p>
                            <strong class="text-uppercase" >{{ $document['type'] }}</strong><br>
                            <span class="text-secondary">{{ $document['value'] }}</span>
                        </p>
                    </li>
                    @endforeach
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
                    @foreach($customer['addresses'] as $address)
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
                </ul>
            </div>
        </div>
    </div>

</div>
