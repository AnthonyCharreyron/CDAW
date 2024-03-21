@extends('template')

@section('content')
    <div class="row">
        <div class="col-3 text-center mt-1 border border-secondary rounded mx-auto">
            <h3>Bonjour {{$user==null ? 'Anonymous' : $user->pseudo}} !</h3>
        </div>
    </div>
@endsection



