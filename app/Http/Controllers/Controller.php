<?php

namespace App\Http\Controllers;

use App\Models\historiqueEssence;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function gestionaireUser()
    {
        $users = DB::table("users")->get();
//        $prixessence = DB::table("historique_essences")->select("prix")->max("date");
        $prixessence = DB::table("historique_essences")->select("prix")->orderBy("date", "desc")->get();
//dd($prixessence);
        return view('administration', compact("users", "prixessence"));
    }

    public function ajoutUser(Request $request)
    {
//        $users = DB::table("users")->get();
    //    dd($request);
        $request->validate(
            [
                "email" => "unique:users,email",
            ]
        );
        dd($request);
//        $chevauxnum = (int)$request->ChevauxFiscaux;
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            "portables" => $request->portable,
            "vehicule" => $request->vehicule,
            "chevauxFiscaux" => $request->ChevauxFiscaux,
            "ValeurChevauxFiscaux"=>$request->ValeurChevauxFiscaux


        ]);
        return redirect("gestionaireUser");
    }

    public function modifUser(Request $request){
        $modifUserDB = DB::table("users")->where("email","=","$request->email")->get();
        $iduser = DB::table("users")->where("email","=","$request->email")->select("id")->get();
//        dump($modifUserDB);
//        dd($request);
//        dd($entreprises[0]);
//        alert("blabla");
//        $deleted = DB::table('entreprises')->select("id")->where("id",'=',$id)->delete();
//    dd("test");

        if ($modifUserDB[0]->name != $request->name){
            DB::table("users")->where("email","=","$request->email")->update(["name"=>$request->name]);
        }
        if ($modifUserDB[0]->email != $request->email){
            DB::table("users")->where("email","=","$request->email")->update(["email"=>$request->email]);
        }
        if ($modifUserDB[0]->portables != $request->portable){
            DB::table("users")->where("email","=","$request->email")->update(["portables"=>$request->portable]);
        }
        if ($modifUserDB[0]->vehicule != $request->vehicule){
            DB::table("users")->where("email","=","$request->email")->update(["vehicule"=>$request->vehicule]);
        }
        if ($modifUserDB[0]->chevauxFiscaux != $request->ChevauxFiscaux){

            DB::table("users")->where("email","=","$request->email")->update(["chevauxFiscaux"=>$request->ChevauxFiscaux]);
        }
        // if ($modifUserDB[0]->ValeurChevauxFiscaux != $request->ValeurChevauxFiscaux){
        //     DB::table("users")->where("email","=","$request->email")->update(["ValeurchevauxFiscaux"=>$request->ValeurChevauxFiscaux]);
        // }
        if ($modifUserDB[0]->dateChevauxFiscaux != $request->dateChevauxFiscaux){
            historiqueEssence::create([
                "date"=>$request->dateChevauxFiscaux,
                "chevauxFiscaux"=>$request->ChevauxFiscaux,
                "userId"=>$iduser[0]->id,
                "prix"=>$request->ValeurChevauxFiscaux,


            ]);
            DB::table("users")->where("email","=","$request->email")->update(["dateChevauxFiscaux"=>$request->dateChevauxFiscaux]);
        }

        if ($request->password != null && $request->password == $request->password_confirmation){
            DB::table("users")->where("email",$request->email)->update(["password"=>Hash::make($request->password)]);
        }elseif ($request->password != null && $request->password != $request->password_confirmation){
            Session::flash('passwordErreur', "Le password ne correspond pas ");
            return redirect("gestionaireUser");
        }

        return redirect('gestionaireUser');
    }

    public function supuser(Request $request)
    {
//        dd("en cours de supression");
        $modifUserDB = DB::table("users")->where("email", "=", "$request->email")->get();
        $deleted = DB::table('users')->where("email", '=', $request->email)->delete();

        return redirect(route("gestionaireUser"));
    }

//     public function ajouterEssence(Request $request)
//     {
// //        dd($request);
//         historiqueEssence::create([
//             "prix" => $request->prixessence,
//             "date" => date("d-M-Y H:i:s"),
//         ]);
//         return redirect('gestionaireUser');

//     }
};
