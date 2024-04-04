<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\ListeAmi;

class MonProfilController extends MenuController
{
    public function getProfil(){
        $url = request()->url();
        $user=Auth::user();

        return view('monProfil', [
            'currentPage' => $this->getCurrentPage($url),
            'isConnected' => UserController::isConnected(),
            'menu' => $this->getMenu(),
            'photo_profil' => $user!=null ? UserController::getUserPhoto($user['id']) : 0,
            'user' => $user
        ]);
    }

    public function modifierProfil(Request $request){
        $pseudo = $request->input('pseudo');
        $password = $request->input('password');
        $email = $request->input('email');
        $photo_profil = $request->input('photo_profil');
        User::updateUser($pseudo, $password, $email, $photo_profil);

        return response()->json([
            "success" => true,
            "message" => "OK profil modifié"
        ]);
    }

    public function listeAmi(){
        $user=Auth::user();
        $data = ListeAmi::getListeAmis($user);
        echo json_encode(array("data" => $data));
    }

    public function demandesPourMoi(){
        $user=Auth::user();
        $data = ListeAmi::getDemandePourMoi($user);
        echo json_encode(array("data" => $data));
    }

    public function gestionDemandeAmi(Request $request){
        $user=Auth::user();
        $id_user_friend = $request->input('id_user_friend');
        $demande = $request->input('demande_action');
        
        if($demande == "accepte"){
            ListeAmi::accepterDemande($user->id, $id_user_friend);
            return response()->json([
                "success" => true,
                "message" => 'Demande acceptée',
            ]);
        } elseif($demande == "refuse"){
            ListeAmi::refuserDemande($user->id, $id_user_friend);
            return response()->json([
                "success" => true,
                "message" => 'Demande refusée',
            ]);
        } else {
            return response()->json([
                "success" => false,
                "message" => 'Problème de traitement',
            ]);
        }
    }

    public function infosAmi(Request $request){
        $id_user_ami = $request->input('id_user');
        Log::info($id_user_ami);
        $data = User::getInfosAmi($id_user_ami);

        if (!empty($data)) {
            return response()->json([
                "success" => true,
                "message" => "OK informations de l'ami récupérées",
                "pseudo" => $data[0]['pseudo'],
                "photoProfil" => asset('images/'.$data[0]['photo_profil'].'.png'),
                "partiesJouees" => $data[0]['nombre_parties_jouees'],
                "partiesGagnees" => $data[0]['nombre_parties_gagnees'],
                "meilleurScore" => $data[0]['meilleur_score'],
            ]);
            
        } else {
            return response()->json([
                "success" => false,
                "message" => "Aucune donnée trouvée pour cet ami.",
            ]);
        }
    }

    public function demandeNouveauxAmis(){
        $user=Auth::user();
        $data = User::getUsersNonAmis($user->id);
        echo json_encode(array("data" => $data));
    }

    public function supprimerAmi(Request $request) {
        $user=Auth::user();
        $amiId = $request->input('id_user_ami');
        $suppressionReussie = ListeAmi::supprimerAmi($user->id, $amiId);
    
        if ($suppressionReussie==1) {
            return response()->json([
                "success" => true,
                "message" => "L'ami a été supprimé avec succès.",
            ]);
        } else {
            return response()->json([
                "success" => false,
                "message" => "Une erreur s'est produite lors de la suppression de l'ami.",
            ]);
        }
    }
}
