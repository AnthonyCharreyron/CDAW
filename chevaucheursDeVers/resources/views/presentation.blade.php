@extends('template')

@section('content')
    <div class="row">
        <div class="col-3 text-center d-flex justify-content-center mt-2 border border-secondary rounded mx-auto">
            <h4 class="mt-3">Bonjour {{$user==null ? 'Anonymous' : $user->pseudo}} !</h4>
        </div>
    </div>
 
    <div class="row mt-2">
        <img src="{{ asset('images/Colline_presentation.jpg') }}" alt="Image de présentation">
    </div>
 
@endsection



