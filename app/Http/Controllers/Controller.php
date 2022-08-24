<?php

namespace App\Http\Controllers;

use App\Models\historiqueEssence;
use App\Models\Mois;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function displayDashboard()
    {
        $lockedMonth = DB::table('events')->where('idUser', "=", Auth::user()->id)->orderBy("mois", "desc")->get();
        $moisNDF = DB::table('infosndfs')->where("Utilisateur","=",Auth::user()->name)->get(); // on recupère le mois actuel et si il n'est n'est pas valide en bdd on le grise

        $uniqueMonth = [];
        $prevDate = '';
        foreach ($lockedMonth as $locked) {
            if ($prevDate != $locked->mois) {
                $prevDate = $locked->mois;
                array_push($uniqueMonth, $locked->mois);
            };
        }
        $uniqueMonth = implode(',', $uniqueMonth);

        return view('dashboard', compact([
            'uniqueMonth',
            'moisNDF'
    ]));
    }

    public function displayModeration()
    {
        $eventLocked = DB::table('events')->orderBy("idUser", "desc")->get();
        $jsonEvents = json_encode(DB::table('events')->orderBy("idUser", "desc")->get());
        $utilisateurs = DB::table('users')->orderBy("id", "desc")->get();
        $usersId = [];
        $usersName = [];
        foreach ($utilisateurs as $user){
            array_push($usersId, $user->id);
            array_push($usersName, $user->name);
        }
        $usersId = implode(',', $usersId);
        $usersName = implode(',', $usersName);


        return view('moderation', compact('eventLocked', 'usersId', 'usersName', 'jsonEvents'));
    }
    public function displayModerationPerUser(Request $request)
    {
        $utilisateurs = DB::table('users')->orderBy("id", "desc")->get();
        $usersId = [];
        $usersName = [];
        foreach ($utilisateurs as $user){
            array_push($usersId, $user->id);
            array_push($usersName, $user->name);
        }
        $usersId = implode(',', $usersId);
        $usersName = implode(',', $usersName);
        if($request->userId != '0'){
            $eventLocked = DB::table('events')->where("idUser","=",$request->userId)->get();
            $jsonEvents = json_encode(DB::table('events')->where("idUser","=",$request->userId)->get());
        }
        else{
            $eventLocked = DB::table('events')->orderBy("idUser", "desc")->get();
            $jsonEvents = json_encode(DB::table('events')->orderBy("idUser", "desc")->get());
        }
        return view('moderation', compact('eventLocked', 'usersId', 'usersName', 'jsonEvents'));
    }

    public function gestionaireUser()
    {
        $users = DB::table("users")->get();
        //        $prixessence = DB::table("historique_essences")->select("prix")->max("date");
        $prixessence = DB::table("historique_essences")->select("prix")->orderBy("date", "desc")->get();
        //dd($prixessence);

        // dd($moisQuerys);
        $uniqueMonth = [];
        $uniqueUser = [];
        $prevDate = '';
        $prevUser = '';
        //  dd($moisQuerys);

        $uniqueMonth = implode(',', $uniqueMonth);
        $uniqueUser = implode(',', $uniqueUser);
        // dd($uniqueMonth, $uniqueUser);
        return view('administration', compact("users", "prixessence", 'uniqueMonth', 'uniqueUser'));
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
        //        $chevauxnum = (int)$request->ChevauxFiscaux;
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            "portables" => $request->portable,
            "vehicule" => $request->vehicule,
            "chevauxFiscaux" => $request->ChevauxFiscaux,


        ]);
        return redirect("gestionaireUser");
    }



    public function modifUser(Request $request)
    {
        $modifUserDB = DB::table("users")->where("email", "=", "$request->email")->get();
        $iduser = DB::table("users")->where("email", "=", "$request->email")->select("id")->get();
        //        dump($modifUserDB);
        //        dd($request);
        //        dd($entreprises[0]);
        //        alert("blabla");
        //        $deleted = DB::table('entreprises')->select("id")->where("id",'=',$id)->delete();
        //    dd("test");

        if ($modifUserDB[0]->name != $request->name) {
            DB::table("users")->where("email", "=", "$request->email")->update(["name" => $request->name]);
        }
        if ($modifUserDB[0]->email != $request->email) {
            DB::table("users")->where("email", "=", "$request->email")->update(["email" => $request->email]);
        }
        if ($modifUserDB[0]->portables != $request->portable) {
            DB::table("users")->where("email", "=", "$request->email")->update(["portables" => $request->portable]);
        }
        if ($modifUserDB[0]->vehicule != $request->vehicule) {
            DB::table("users")->where("email", "=", "$request->email")->update(["vehicule" => $request->vehicule]);
        }
        if ($modifUserDB[0]->chevauxFiscaux != $request->ChevauxFiscaux) {

            DB::table("users")->where("email", "=", "$request->email")->update(["chevauxFiscaux" => $request->ChevauxFiscaux]);
        }
        // if ($modifUserDB[0]->ValeurChevauxFiscaux != $request->ValeurChevauxFiscaux){
        //     DB::table("users")->where("email","=","$request->email")->update(["ValeurchevauxFiscaux"=>$request->ValeurChevauxFiscaux]);
        // }

        if ($request->password != null && $request->password == $request->password_confirmation) {
            DB::table("users")->where("email", $request->email)->update(["password" => Hash::make($request->password)]);
        } elseif ($request->password != null && $request->password != $request->password_confirmation) {
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

    public function gestionnairendf(Request $request){

        $employes = DB::table('users')->where('salarie','=','1')->get();
        $ndfsemploye = DB::table('infosndfs')->where('Utilisateur',"=",$request->utilisateur)->get();
        $utilisateurSelectionne = $request->utilisateur;

        return view('gestionnairendf', [
            'utilisateurSelectionne' => $utilisateurSelectionne,
            'employes' => $employes,
            'ndfsemploye' => $ndfsemploye,
        ]);
    }


};
