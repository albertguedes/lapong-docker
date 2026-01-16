<div class="card my-2" >
    <div class="card-body py-0 my-0">

        <div class="row" >

            <div class="col-3 text-center py-4" >
                <img class="img-fluid rounded-circle" src="https://tse1.mm.bing.net/th?id=OIP.dJkUaN8GnTfLSmMXsIa3TwHaLu&pid=Api&P=0&w=300&h=300" alt="Avatar">
                <p class="card-text pt-4" >
                    <a href="{{ route('scheduler.contacts', [ 'contact_id' => $message->sender->id ]) }}">
                        <i class="text-primary fa-solid fa-user"></i>
                        <strong class="pl-2" >{{ $message->sender->profile->name() }}</strong>
                    </a>
                </p>
            </div>

            <div class="col-9 text-left" >
                <ul class="list-group list-group-horizontal mb-2 border-bottom">

                    <li class="list-group-item border-0">
                        <a href="#" >
                            <i class="text-primary fa-solid fa-reply"></i>
                            Responder
                        </a>
                    </li>

                    <li class="list-group-item border-0">
                        <a href="#" >
                            <i class="text-primary fa-solid fa-share"></i>
                            Encaminhar
                        </a>
                    </li>

                    <li class="list-group-item border-0">
                        <a href="#" >
                            <i class="text-primary fa-solid fa-save"></i>
                            Salvar
                        </a>
                    </li>

                    <li class="list-group-item border-0">
                        <a class="text-danger" href="#" >
                            <i class="fa-solid fa-trash"></i>
                            Excluir
                        </a>
                    </li>

                </ul>

                <h2 class="card-title" >{{ $message->subject }}</h2>
                <p>
                    <i class="text-primary fa-solid fa-envelope-open"></i>
                    <span class="text-muted ml-2" >{{ $message->created_at->format('d M Y - H:i') }}</span>
                </p>
                <p class="card-text" >
                    {{ $message->message }}
                </p>
            </div>
        </div>

    </div>
</div>