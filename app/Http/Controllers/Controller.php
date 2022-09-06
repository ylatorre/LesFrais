<?php

namespace App\Http\Controllers;

use App\Models\historiqueEssence;
use App\Models\infosndf;
use App\Models\Mois;
use App\Models\User;
use GuzzleHttp\Middleware;
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
        $moisNDF = DB::table('infosndfs')->where("Utilisateur", "=", Auth::user()->name)->get(); // on recupère le mois actuel et si il n'est n'est pas valide en bdd on le grise


        /* - récupération des mois à vérrouiller  */
        $moisValide = DB::table('infosndfs')->select('MoisEnCours')->where('Utilisateur', '=', Auth::user()->name)->where('Valide', '=', 1)->get();
        $moisValidationEnCours = DB::table('infosndfs')->select('MoisEnCours')->where('Utilisateur', '=', Auth::user()->name)->where('ValidationEnCours', '=', 1)->get();
        // $moisValidationEnCours = DB::table('infosndfs')->select('MoisEnCours')->where('Utilisateur','=', Auth::user()->name)->where('ValidationEnCours','=',1)->get();



        $monthvalidated = DB::table('infosndfs')->select('MoisEnCours')->where('Utilisateur', '=', Auth::user()->name)->where("Valide", "=", "1");
        $monthlocked = DB::table('infosndfs')->select('MoisEnCours')->where('utilisateur', "=", Auth::user()->name)->where('ValidationEnCours', "=", "1");

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
            'moisNDF',
            'monthlocked',
            'monthvalidated',



        ]));
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
            "taux" => $request->taux,


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
        if ($modifUserDB[0]->taux != $request->taux) {
            DB::table("users")->where("email", "=", "$request->email")->update(["taux" => $request->taux]);
        }
        if (Auth::user()->superadmin == 1) {
            if ($modifUserDB[0]->admin != $request->admin) {
                DB::table("users")->where("email", "=", $request->email)->update(["admin" => $request->admin]);
                DB::table("users")->where("email", "=", $request->email)->update(["salarie" => 0]);
            }

            $isUserAdmin = DB::table('users')->where("email", "=", $request->email)->get();

  if ($isUserAdmin[0]->admin == 0) {
                DB::table("users")->where("email", "=", $request->email)->update(["salarie" => 1]);
            }

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

    public function gestionnairendf(Request $request)
    {

        $employes = DB::table('users')->where('salarie', '=', '1')->get();
        $ndfsemploye = DB::table('infosndfs')->where('Utilisateur', "=", $request->utilisateur)->get();
        $utilisateurSelectionne = $request->utilisateur;


        return view('gestionnairendf', [
            'utilisateurSelectionne' => $utilisateurSelectionne,
            'employes' => $employes,
            'ndfsemploye' => $ndfsemploye,
        ]);
    }

    /* - visualisation des NDF */

    public function ValidationNDF(Request $request)
    {


        $utilisateurs = DB::table('users')->RightJoin("events", "events.idUser", "users.id")->where("name", "=", $request->employe)->where('mois', '=', $request->moisNDF)->get();

        $user = Auth::user();

        if ($user->vehicule == null || $user->chevauxFiscaux == null) {
            return redirect('dashboard')->with('failure', 'Le PDF n\'a pas pu être généré car les données "Type de vehicule" ou "Chevaux fiscaux" ne sont pas rempli.');
        };
        if ($utilisateurs->isEmpty()) {
            return redirect('dashboard')->with('failure', 'L\'utilisateur n\'a pas d\'événement enregistré pour ce mois !');
        };

        return view('visualisationNDF', [
            'utilisateurs' => $utilisateurs,
        ]);
    }

    /* - Validation et suppression des NDF */

    public function validerNDF(Request $request)
    {


        DB::table('infosndfs')->where('Utilisateur', '=', $request->username)->where('MoisEnCours', '=', $request->moisndf)->update(['Valide' => 1]);
        DB::table('infosndfs')->where('Utilisateur', '=', $request->username)->where('MoisEnCours', '=', $request->moisndf)->update(['ValidationEnCours' => 0]);

        Session::flash('validatesuccess', 'La note de frais à été validée !');
        return redirect(route('gestionaireUser'));
    }
    public function supprimerNDF(Request $request)
    {

        DB::table('infosndfs')->where('Utilisateur', '=', $request->username)->where('MoisEnCours', '=', $request->moisndf)->delete();

        return redirect(route('gestionaireUser'));
    }
    public function mesNDF()
    {
        $authInfosndfs = DB::table('infosndfs')->where('Utilisateur', "=", Auth::user()->name)->where('Valide', '=', '1')->get();

        return view('mesndfs', ['authInfosndfs' => $authInfosndfs]);
    }
    public function visumesndf(Request $request)
    {

        return redirect(route('mesNDF'));
    }
};
