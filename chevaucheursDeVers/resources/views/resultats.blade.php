@extends('template')

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <div class="rounded border-brown p-4 m-4" style="background-color: #dec189ff;">
                <div class="row">
                    <h4 class='text-center' >Résultat de la partie</h4>
                    <hr>
                </div>
                <table id="resultatPartie" class="hover stripe">
                    <thead>
                        <tr>
                            <th scope="col">Rang</th>
                            <th scope="col">Pseudo</th>
                            <th scope="col">Score</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('pagescripts')
    <script>
        const codePartie = "{{$code_partie}}";
    </script>
@endsection