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

        User::putAdmin($id_user);

        return response()->json([
            "success" => true,
            "message" => "Utilisateur admin",
        ]);
    }

    public function blockUser(Request $request){
        $id_user = $request->input('id_user');

        User::blockUser($id_user);

        return response()->json([
            "success" => true,
            "message" => "Utilisateur bloqué",
        ]);
    }
}
