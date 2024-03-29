<div>
    <!-- Modal -->
    <div class="modal fade" id="modalDestination" tabindex="-1" role="dialog" aria-labelledby="modalDestLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalDestLabel">Veuillez choisir une destination à supprimer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <ul>
                @foreach(session()->get('cartesDestinationsMain_'.$user->id) as $destination => $points)
                    <li>{{$destination}} : {{$points}} <button class="btn btn-danger" onclick="supprimerDestination({{$user->id}}, '{{$destination}}')">Supprimer</button></li>
                @endforeach
            </ul>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Continuer</button>
        </div>
        </div>
    </div>
    </div>
</div>