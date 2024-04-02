@extends('template')

@section('content')
    <div class="row text-center d-flex justify-content-center fst-italic">
        <div class="col-3 mt-2">
            <h3 class="mt-3">Bonjour {{$user==null ? 'Anonymous' : $user->pseudo}} !</h3>
        </div>
    </div>
 
    <div class="row mt-2">
        <img src="{{ asset('images/Colline_presentation.jpg') }}" alt="Image de présentation">
    </div>
 
@endsection



