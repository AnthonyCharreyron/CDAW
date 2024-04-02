<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Models\User;

class MonitorController extends MenuController
{
    public function getMonitor(){
        $url = request()->url();
        $user=Auth::user();

        return view('monitor', [
            'currentPage' => $this->getCurrentPage($url),
            'isConnected' => UserController::isConnected(),
            'menu' => $this->getMenu(),
            'photo_profil' => $user!=null ? UserController::getUserPhoto($user['id']) : 0,
            'user' => $user
        ]);
    }

    public function getAllUsers(){
        $all_users_infos = User::getAllInfos();

        echo json_encode(array("data" => $all_users_infos));
    }

    public function putAdmin(Request $request){
        $id_user = $request->input('id_user');
        $action = $request->input('admin_action');
    
        if($action === 'add') {
            User::putAdmin($id_user);
            $message = "Utilisateur est devenu administrateur.";
        } elseif($action === 'remove') {
            User::removeAdmin($id_user);
            $message = "Droits d'administrateur retirés à l'utilisateur.";
        }
    
        return response()->json([
            "success" => true,
            "message" => $message,
        ]);
    }

    public function blockUser(Request $request){
        $id_user = $request->input('id_user');
        $action = $request->input('block_action');
    
        if($action === 'block') {
            User::blockUser($id_user);
            $message = "Utilisateur bloqué.";
        } elseif($action === 'unblock') {
            User::unblockUser($id_user);
            $message = "Utilisateur débloqué.";
        }
    
        return response()->json([
            "success" => true,
            "message" => $message,
        ]);
    }

    public function updateComment(Request $request){
        $id_user = $request->input('id_user');
        $commentaires = $request->input('commentaires');

        User::updateComment($id_user, $commentaires);

        return response()->json([
            "success" => true,
            "message" => "Commentaires modifiés",
        ]);
    }
}
