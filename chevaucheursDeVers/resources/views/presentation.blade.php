@extends('template')

@section('content')
    <div class="row">
        <div class="col-3 text-center mt-1 border border-secondary rounded mx-auto">
            <h3>Bonjour {{$user==null ? 'Anonymous' : $user->pseudo}} !</h3>
        </div>
    </div>
    <div class="justify-content-center d-flex align-items-center mt-1">
        <img src="{{ asset('images/Colline_presentation.jpg') }}" alt="Image de présentation" style="height: 80vh; width: auto;">
    </div>
@endsection



