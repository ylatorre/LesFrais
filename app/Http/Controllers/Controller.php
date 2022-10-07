<?php

namespace App\Http\Controllers;

use App\Models\Mois;
use App\Models\User;
use App\Models\Event;
use App\Models\infosndf;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use App\Models\historiqueEssence;
use Faker\Core\Uuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function displayDashboard()
    {
        //dd($request);
        $lockedMonth = DB::table('events')->where('idUser', "=", Auth::user()->id)->orderBy("mois", "desc")->get();
        $moisNDF = DB::table('infosndfs')->where("Utilisateur", "=", Auth::user()->name)->get(); // on recupère le mois actuel et si il n'est n'est pas valide en bdd on le grise


        /* - récupération des mois à vérrouiller  */
        $moisValide = DB::table('infosndfs')->select('MoisEnCours')->where('Utilisateur', '=', Auth::user()->name)->where('Valide', '=', 1)->get();
        $moisValidationEnCours = DB::table('infosndfs')->select('MoisEnCours')->where('Utilisateur', '=', Auth::user()->name)->where('ValidationEnCours', '=', 1)->get();


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

    public function createEvent(Request $request)
    {

            // EVENT DE BASE
        Event::create([
            "id" => $request->iding,
            "start" => $request->start,
            "end" => $request->end,
            "description" => $request->description,
            "title" => $request->title,
            "ville" => $request->ville,
            "code_postal" => $request->code_postal,
            "peage" => $request->peage,
            "peage2" => $request->peage2,
            "peage3" => $request->peage3,
            "peage4" => $request->peage4,
            "parking" => $request->parking,
            "essence" => $request->essence,
            "divers" => $request->divers,
            "petitDej" => $request->petitDej,
            "dejeuner" => $request->dejeuner,
            "diner" => $request->diner,
            "hotel" => $request->hotel,
            "kilometrage" => $request->kilometrage,
            "mois" => $request->moisActuel,
            "heure_debut" => $request->heureDebut,
            "heure_fin" => $request->heureFin,
            "idUser" => Auth::user()->id,
        ]);
            // REPAS 2
        // if ($request->repas2 != '0') {
        //      Event::create([
        //         "id" => $request->iding2,
        //         "start" => $request->start,
        //         "end" => $request->end,
        //         "description" => "",
        //         "title" => $request->title." Déjeuner",
        //         "ville" => $request->ville,
        //         "code_postal" => $request->code_postal,
        //         "peage" => "0.00",
        //         "parking" => "0.00",
        //         "essence" => "0.00",
        //         "divers" => "0.00",
        //         "repas" => $request->repas2,
        //         "hotel" => "0.00",
        //         "kilometrage" => "0.00",
        //         "mois" => $request->moisActuel,
        //         "heure_debut" => $request->heureDebut,
        //         "heure_fin" => $request->heureFin,
        //         "idUser" => Auth::user()->id,
        //     ]);
        // }
        //     //REPAS 3
        // if($request->repas3 != '0'){

        //     Event::create([
        //         "id" => $request->iding3,
        //         "start" => $request->start,
        //         "end" => $request->end,
        //         "description" => "",
        //         "title" => $request->title." Diner",
        //         "ville" => $request->ville,
        //         "code_postal" => $request->code_postal,
        //         "peage" => "0.00",
        //         "parking" => "0.00",
        //         "essence" => "0.00",
        //         "divers" => "0.00",
        //         "repas" => $request->repas3,
        //         "hotel" => "0.00",
        //         "kilometrage" => "0.00",
        //         "mois" => $request->moisActuel,
        //         "heure_debut" => $request->heureDebut,
        //         "heure_fin" => $request->heureFin,
        //         "idUser" => Auth::user()->id,
        //     ]);
        // }
        // //PEAGE 2
        // if($request->peage2 != '0'){

        //     Event::create([
        //         "id" => $request->iding4,
        //         "start" => $request->start,
        //         "end" => $request->end,
        //         "description" => "",
        //         "title" => $request->title." Péage 2",
        //         "ville" => $request->ville,
        //         "code_postal" => $request->code_postal,
        //         "peage" => $request->peage2,
        //         "parking" => "0.00",
        //         "essence" => "0.00",
        //         "divers" => "0.00",
        //         "repas" => "0.00",
        //         "hotel" => "0.00",
        //         "kilometrage" => "0.00",
        //         "mois" => $request->moisActuel,
        //         "heure_debut" => $request->heureDebut,
        //         "heure_fin" => $request->heureFin,
        //         "idUser" => Auth::user()->id,
        //     ]);
        // }
        // //PEAGE 3
        // if($request->peage3 != '0'){

        //     Event::create([
        //         "id" => $request->iding5,
        //         "start" => $request->start,
        //         "end" => $request->end,
        //         "description" => "",
        //         "title" => $request->title." Péage 3",
        //         "ville" => $request->ville,
        //         "code_postal" => $request->code_postal,
        //         "peage" => $request->peage3,
        //         "parking" => "0.00",
        //         "essence" => "0.00",
        //         "divers" => "0.00",
        //         "repas" => "0.00",
        //         "hotel" => "0.00",
        //         "kilometrage" => "0.00",
        //         "mois" => $request->moisActuel,
        //         "heure_debut" => $request->heureDebut,
        //         "heure_fin" => $request->heureFin,
        //         "idUser" => Auth::user()->id,
        //     ]);
        // }
        // //PEAGE 4
        // if($request->peage4 != '0'){

        //     Event::create([
        //         "id" => $request->iding6,
        //         "start" => $request->start,
        //         "end" => $request->end,
        //         "description" => "",
        //         "title" => $request->title." Péage 4",
        //         "ville" => $request->ville,
        //         "code_postal" => $request->code_postal,
        //         "peage" => $request->peage4,
        //         "parking" => "0.00",
        //         "essence" => "0.00",
        //         "divers" => "0.00",
        //         "repas" => "0.00",
        //         "hotel" => "0.00",
        //         "kilometrage" => "0.00",
        //         "mois" => $request->moisActuel,
        //         "heure_debut" => $request->heureDebut,
        //         "heure_fin" => $request->heureFin,
        //         "idUser" => Auth::user()->id,
        //     ]);
        // }

        return redirect(route('dashboard'));
    }


    public function gestionaireUser()
    {
        $users = DB::table("users")->orderby('superadmin', 'desc')->orderby('admin', 'desc')->get();
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
        if (Auth::user()->admin == 1 && Auth::user()->superadmin == 0) {

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                "portables" => $request->portable,
                "vehicule" => $request->vehicule,
                "chevauxFiscaux" => $request->ChevauxFiscaux,
                "taux" => $request->taux,


            ]);
        } elseif (Auth::user()->superadmin == 1 && $request->admin === "1") {

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                "portables" => $request->portable,
                "vehicule" => $request->vehicule,
                "chevauxFiscaux" => $request->ChevauxFiscaux,
                "taux" => $request->taux,
            ]);

            DB::table('users')->where('email', '=', $request->email)->update(['admin' => 1]);
            DB::table('users')->where('email', '=', $request->email)->update(['salarie' => 0]);
        } else {

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                "portables" => $request->portable,
                "vehicule" => $request->vehicule,
                "chevauxFiscaux" => $request->ChevauxFiscaux,
                "taux" => $request->taux,
            ]);
        }
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
        $userId = $request->userId;
        $isSalarie = $request->salarie;


        return view('gestionnairendf', [
            'utilisateurSelectionne' => $utilisateurSelectionne,
            'employes' => $employes,
            'ndfsemploye' => $ndfsemploye,
            'userId' => $userId,
            'isSalarie' => $isSalarie
        ]);
    }

    /* - visualisation des NDF */

    public function ValidationNDF(Request $request)
    {


        $utilisateurs = DB::table('users')->RightJoin("events", "events.idUser", "users.id")->where("name", "=", $request->employe)->where('mois', '=', $request->moisNDF)->orderBy("start","asc")->orderBy("title","asc")->get();
        


        if (count($utilisateurs) == 0) {
            Session::flash('pasevents', "il n'y a pas d'évènements pour ce mois !");
            return redirect('dashboard');
        }
        $dateNDF = explode("-", $utilisateurs[0]->mois);

        // - Le switch case permet d'écrire sur la note de frais le mois en fonction du numéro du mois

        $moisDateNDF = "";

        switch ($dateNDF[1]) {
            case "01";
                $moisDateNDF = "Janvier";
                break;
            case "02";
                $moisDateNDF = "Février";
                break;
            case "03";
                $moisDateNDF = "Mars";
                break;
            case "04";
                $moisDateNDF = "Avril";
                break;
            case "05";
                $moisDateNDF = "Mai";
                break;
            case "06";
                $moisDateNDF = "Juin";
                break;
            case "07";
                $moisDateNDF = "Juillet";
                break;
            case "08";
                $moisDateNDF = "Août ";
                break;
            case "09";
                $moisDateNDF = "Septembre";
                break;
            case "10";
                $moisDateNDF = "Octobre";
                break;
            case "11";
                $moisDateNDF = "Novembre";
                break;
            case "12";
                $moisDateNDF = "Décembre";
                break;
        };


        $dateNDFpourPDFetVISU = $moisDateNDF . " " . $dateNDF[0];

        $user = Auth::user();

        if ($user->vehicule == null || $user->chevauxFiscaux == null) {
            return redirect('dashboard')->with('failure', 'Le PDF n\'a pas pu être généré car les données "Type de vehicule" ou "Chevaux fiscaux" ne sont pas rempli.');
        };
        if ($utilisateurs->isEmpty()) {
            return redirect('dashboard')->with('failure', 'L\'utilisateur n\'a pas d\'événement enregistré pour ce mois !');
        };

        $infosNDF = DB::table('infosndfs')->where('Utilisateur', '=', $request->employe)->where('MoisEnCours', '=', $request->moisNDF)->get();

        return view('visualisationNDF', [
            'utilisateurs' => $utilisateurs,
            'dateNDFpourPDFetVISU' => $dateNDFpourPDFetVISU,
            'infosNDF' => $infosNDF,
        ]);
    }

    /* - Validation et suppression des NDF */

    public function validerNDF(Request $request)
    {
        DB::table('infosndfs')->where('Utilisateur', '=', $request->username)->where('MoisEnCours', '=', $request->moisndf)->update(['ValidationEnCours' => 0]);
        DB::table('infosndfs')->where('Utilisateur', '=', $request->username)->where('MoisEnCours', '=', $request->moisndf)->update(['Valide' => 1]);
        DB::table('infosndfs')->where('Utilisateur', '=', $request->username)->where('MoisEnCours', '=', $request->moisndf)->update(['ValideePar' => Auth::user()->name]);
        DB::table('infosndfs')->where('Utilisateur', '=', $request->username)->where('MoisEnCours', '=', $request->moisndf)->update(['DateValidation' => date('d/m/Y')]);

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
        $authInfosndfs = DB::table('infosndfs')->where('Utilisateur', "=", Auth::user()->name)->get();

        $idUser = Auth::user()->id;

        return view('mesndfs', ['authInfosndfs' => $authInfosndfs, 'idUser' => $idUser]);
    }
    public function visumesndf(Request $request)
    {

        return redirect(route('mesNDF'));
    }

    /*/////////////////////////
    - Gestion des évènements
    *//////////////////////////

    public function repas(Request $request)
    {
        dd('interception');
        return redirect("/dashboard");
    }
    public function supprimerEvent(Request $request){
        DB::table('events')->where('id','=',$request->eventID)->delete();

        Session::flash("supprEvent","L'évènement à bien été modifié");
        return redirect("/dashboard");
    }
    public function ModifierEvent(Request $request){

       $eventEnQuestion = DB::table('events')->where('id','=', $request->eventID)->update([
            'start'=>$request->start,
            'end'=>$request->end,
            'description'=>$request->description,
            'title'=>$request->title,
            'ville'=>$request->ville,
            'code_postal'=>$request->code_postal,
            'peage'=>$request->peage,
            'peage2'=>$request->peage2,
            'peage3'=>$request->peage3,
            'peage4'=>$request->peage4,
            'parking'=>$request->parking,
            'essence'=>$request->essence,
            'divers'=>$request->divers,
            'petitDej'=>$request->petitDej,
            'dejeuner'=>$request->dejeuner,
            'diner'=>$request->diner,
            'hotel'=>$request->hotel,
            'kilometrage'=>$request->kilometrage,
            'mois'=>$request->mois,
            'heure_debut'=>$request->heureDebut,
            'heure_fin'=>$request->heureFin,
            'idUser'=>$request->idUser,

        ]);


        Session::flash("modifEvent","L'évènement à bien été modifié !");



        return redirect("/dashboard");
    }
};
