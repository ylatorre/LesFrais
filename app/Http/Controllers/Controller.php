<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function gestionaireUser()
    {
        $users = DB::table("users")->get();
        return view('administration',compact("users"));
    }
    public function ajoutUser(Request $request)
    {
//        $users = DB::table("users")->get();
//        dd($request);
        $request->validate(
            [
                "email"=>"unique:users,email",
            ]
        );

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            "portables"=>$request->portable,
            "vehicule"=>$request->vehicule,
            "chevauxFiscaux"=>$request->ChevauxFiscaux,

        ]);
        return redirect("gestionaireUser");
    }
}
