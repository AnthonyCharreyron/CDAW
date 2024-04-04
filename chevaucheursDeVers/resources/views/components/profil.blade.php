<div>
    <div class="modal fade" id="modalProfilAmi" tabindex="-1" aria-labelledby="modalProfilAmiLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalProfilAmiLabel">Profil de <span id="amiPseudo"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img id="amiPhotoProfil" src="{{asset('images/1.png')}}" alt="Photo de profil" class="img-fluid rounded">
                        </div>
                        <div class="col-md-8">
                            <p><strong>Pseudo :</strong> <span id="amiPseudoModal"></span></p>
                            <p><strong>Parties jouées :</strong> <span id="amiPartiesJouees"></span></p>
                            <p><strong>Parties gagnées :</strong> <span id="amiPartiesGagnees"></span></p>
                            <p><strong>Meilleur score :</strong> <span id="amiMeilleurScore"></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>