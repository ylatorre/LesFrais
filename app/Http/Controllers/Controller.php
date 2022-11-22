<?php

namespace App\Http\Controllers;

use App\Models\Mois;
use App\Models\User;
use Faker\Core\Uuid;
use App\Mail\PDFmail;
use App\Models\Event;
use App\Models\Rejet;
use App\Mail\MailRejet;
use App\Models\infosndf;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use App\Mail\MailNotifSalarie;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\historiqueEssence;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //                                                                                                                                       //
    //    Ce controller centralise les fonctionnalitées liées aux évènement ainsi qu'à la gestion des notes de frais et aux utilisateus      //
    //                                                                                                                                       //
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

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

        $modifUserDB = DB::table("users")->where("email", "=", $request->actualemail)->get();

        $iduser = DB::table("users")->where("email", "=", $request->actualemail)->select("id")->get();

        if ($modifUserDB[0]->name != $request->name) {
            DB::table("users")->where("email", "=", $modifUserDB[0]->email)->update(["name" => $request->name]);
        }


        if ($modifUserDB[0]->email != $request->email) {
            DB::table("users")->where("email", "=", $modifUserDB[0]->email)->update(["email" => $request->email]);
        }
        if ($modifUserDB[0]->portables != $request->portable) {
            DB::table("users")->where("email", "=", $modifUserDB[0]->email)->update(["portables" => $request->portable]);
        }
        if ($modifUserDB[0]->vehicule != $request->vehicule) {
            DB::table("users")->where("email", "=", $modifUserDB[0]->email)->update(["vehicule" => $request->vehicule]);
        }
        if ($modifUserDB[0]->chevauxFiscaux != $request->ChevauxFiscaux) {

            DB::table("users")->where("email", "=", $modifUserDB[0]->email)->update(["chevauxFiscaux" => $request->ChevauxFiscaux]);
        }
        if ($modifUserDB[0]->taux != $request->taux) {
            DB::table("users")->where("email", "=", $modifUserDB[0]->email)->update(["taux" => $request->taux]);
        }

        if (Auth::user()->superadmin == 1) {
            if ($modifUserDB[0]->admin != $request->admin) {
                DB::table("users")->where("email", "=", $modifUserDB[0]->email)->update(["admin" => $request->admin]);
                DB::table("users")->where("email", "=", $modifUserDB[0]->email)->update(["salarie" => 0]);
            }

            $isUserAdmin = DB::table('users')->where("email", "=", $request->email)->get();

            if ($isUserAdmin[0]->admin == 0) {
                DB::table("users")->where("email", "=", $request->email)->update(["salarie" => 1]);
            }
        }
        return redirect('gestionaireUser');
    }

    public function supuser(Request $request)
    {
        $userEnQuestion = DB::table("users")->where("email", "=", "$request->email")->get();
        DB::table("users")->where("email", "=", "$request->email")->update(['locked' => '1']);
        Session::flash('lockedUser', "Le compte de l'utilisateur " . $userEnQuestion[0]->name . " a été désactivé avec succès.");
        return redirect(route("gestionaireUser"));
    }
    public function activerUser(Request $request)
    {
        $userEnQuestion2 = DB::table("users")->where("email", "=", "$request->email")->get();
        DB::table("users")->where("email", "=", $request->email)->where("id", "=", $request->id)->update(['locked' => '0']);
        Session::flash('unlockedUser', "Le compte de l'utilisateur " . $userEnQuestion2[0]->name . " a été réactivé avec succès.");
        return redirect(route('gestionaireUser'));
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
        $utilisateurs = DB::table('users')->RightJoin("events", "events.idUser", "users.id")->where("name", "=", $request->employe)->where('mois', '=', $request->moisNDF)->orderBy("start", "asc")->orderBy("title", "asc")->get();

        if (count($utilisateurs) == 0) {
            Session::flash('pasevents', "il n'y a pas d'évènements pour ce mois !");
            return redirect(route("calendrier"));
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
            return redirect(route("calendrier"))->with('failure', 'Le PDF n\'a pas pu être généré car les données "Type de vehicule" ou "Chevaux fiscaux" ne sont pas rempli.');
        };
        if ($utilisateurs->isEmpty()) {
            return redirect(
                route("calendrier")
            )->with('failure', 'L\'utilisateur n\'a pas d\'événement enregistré pour ce mois !');
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
        $NDFvalidated = DB::table('infosndfs')->where('Utilisateur', '=', $request->username)->where('MoisEnCours', '=', $request->moisndf)->get();
        if ($NDFvalidated[0]->Valide == 1) {
            Session::flash('alreadyValidated', "Cette note de frais a déjà été validée");
            return redirect(route('gestionaireUser'));
        }

        $compteur = 0;
        $concernedUser = DB::table('users')->where('name', '=', $request->username)->get();
        $concernedEvents = DB::table('events')->where('idUser', '=', $concernedUser[0]->id)->where("mois", "=", $request->moisndf)->get();
        $longueurEvents = sizeof($concernedEvents);
        $tableauChemins = [];
        $tableauImages = [];

        // pour chaque évènement, on génère un pdf et on le joint au mail
        for ($i = 0; $i < $longueurEvents; $i++) {
            if ($concernedEvents[$i]->pathParking != 0) {
                $image = $concernedEvents[$i]->pathParking;
                $client =  $concernedEvents[$i]->title;
                $dateDebut = explode(' ', $concernedEvents[$i]->start)[0];
                $titre = 'Parking';
                $PDF = PDF::loadView('pdf.PDFimage', compact([
                    'NDFvalidated',
                    'image',
                    'titre',
                    'client',
                    'dateDebut',
                ]));
                // - On utilise la facade Storage pour sauvegarder notre fichier sur le disk public avec output
                Storage::put('public/pdf/' . $request->username . ' - ' . $request->moisndf . '/' . $request->username . '-' . $client . '-' . $dateDebut . '-' . $titre . $compteur . '.pdf', $PDF->output());

                array_push($tableauChemins,'public/pdf/' . $request->username . ' - ' . $request->moisndf . '/' . $request->username . '-' . $client . '-' . $dateDebut . '-' . $titre . $compteur . '.pdf');
                array_push($tableauImages,'parking:'.$concernedEvents[$i]->pathParking);
                $compteur++;

            };
            if ($concernedEvents[$i]->pathPeage != 0) {
                $image = $concernedEvents[$i]->pathPeage;
                $client =  $concernedEvents[$i]->title;
                $dateDebut = explode(' ', $concernedEvents[$i]->start)[0];
                $titre = 'Peage';
                $PDF = PDF::loadView('pdf.PDFimage', compact([
                    'NDFvalidated',
                    'image',
                    'titre',
                    'client',
                    'dateDebut',
                ]));
                // - On utilise la facade Storage pour sauvegarder notre fichier sur le disk public avec output
                Storage::put('public/pdf/' . $request->username . ' - ' . $request->moisndf . '/' . $request->username . '-' . $client . '-' . $dateDebut . '-' . $titre . $compteur . '.pdf', $PDF->output());
                array_push($tableauChemins,'public/pdf/' . $request->username . ' - ' . $request->moisndf . '/' . $request->username . '-' . $client . '-' . $dateDebut . '-' . $titre . $compteur . '.pdf');
                array_push($tableauImages,'peage:'.$concernedEvents[$i]->pathPeage);
                $compteur++;
            }
            if ($concernedEvents[$i]->pathPeage2 != 0) {
                $image = $concernedEvents[$i]->pathPeage2;
                $client =  $concernedEvents[$i]->title;
                $dateDebut = explode(' ', $concernedEvents[$i]->start)[0];
                $titre = 'Peage2';
                $PDF = PDF::loadView('pdf.PDFimage', compact([
                    'NDFvalidated',
                    'image',
                    'titre',
                    'client',
                    'dateDebut',
                ]));
                // - On utilise la facade Storage pour sauvegarder notre fichier sur le disk public avec output
                Storage::put('public/pdf/' . $request->username . ' - ' . $request->moisndf . '/' . $request->username . '-' . $client . '-' . $dateDebut . '-' . $titre . $compteur . '.pdf', $PDF->output());
                array_push($tableauChemins,'public/pdf/' . $request->username . ' - ' . $request->moisndf . '/' . $request->username . '-' . $client . '-' . $dateDebut . '-' . $titre . $compteur . '.pdf');
                array_push($tableauImages,'peage2:'.$concernedEvents[$i]->pathPeage2);
                $compteur++;
            }
            if ($concernedEvents[$i]->pathPeage3 != 0) {
                $image = $concernedEvents[$i]->pathPeage3;
                $client =  $concernedEvents[$i]->title;
                $dateDebut = explode(' ', $concernedEvents[$i]->start)[0];
                $titre = 'peage3';
                $PDF = PDF::loadView('pdf.PDFimage', compact([
                    'NDFvalidated',
                    'image',
                    'titre',
                    'client',
                    'dateDebut',
                ]));
                // - On utilise la facade Storage pour sauvegarder notre fichier sur le disk public avec output
                Storage::put('public/pdf/' . $request->username . ' - ' . $request->moisndf . '/' . $request->username . '-' . $client . '-' . $dateDebut . '-' . $titre . $compteur . '.pdf', $PDF->output());
                array_push($tableauChemins,'public/pdf/' . $request->username . ' - ' . $request->moisndf . '/' . $request->username . '-' . $client . '-' . $dateDebut . '-' . $titre . $compteur . '.pdf');
                array_push($tableauImages,'peage3:'.$concernedEvents[$i]->pathPeage3);
                $compteur++;
            }
            if ($concernedEvents[$i]->pathPeage4 != 0) {
                $image = $concernedEvents[$i]->pathPeage4;
                $client =  $concernedEvents[$i]->title;
                $dateDebut = explode(' ', $concernedEvents[$i]->start)[0];
                $titre = 'Peage4';
                $PDF = PDF::loadView('pdf.PDFimage', compact([
                    'NDFvalidated',
                    'image',
                    'titre',
                    'client',
                    'dateDebut',
                ]));
                // - On utilise la facade Storage pour sauvegarder notre fichier sur le disk public avec output
                Storage::put('public/pdf/' . $request->username . ' - ' . $request->moisndf . '/' . $request->username . '-' . $client . '-' . $dateDebut . '-' . $titre . $compteur . '.pdf', $PDF->output());
                array_push($tableauChemins,'public/pdf/' . $request->username . ' - ' . $request->moisndf . '/' . $request->username . '-' . $client . '-' . $dateDebut . '-' . $titre . $compteur . '.pdf');
                array_push($tableauImages,'peage4:'.$concernedEvents[$i]->pathPeage4);
                $compteur++;
            }
            if ($concernedEvents[$i]->pathPetitDej != 0) {
                $image = $concernedEvents[$i]->pathPetitDej;
                $client =  $concernedEvents[$i]->title;
                $dateDebut = explode(' ', $concernedEvents[$i]->start)[0];
                $titre = 'PetitDej';
                $PDF = PDF::loadView('pdf.PDFimage', compact([
                    'NDFvalidated',
                    'image',
                    'titre',
                    'client',
                    'dateDebut',
                ]));
                // - On utilise la facade Storage pour sauvegarder notre fichier sur le disk public avec output
                Storage::put('public/pdf/' . $request->username . ' - ' . $request->moisndf . '/' . $request->username . '-' . $client . '-' . $dateDebut . '-' . $titre . $compteur . '.pdf', $PDF->output());
                array_push($tableauChemins,'public/pdf/' . $request->username . ' - ' . $request->moisndf . '/' . $request->username . '-' . $client . '-' . $dateDebut . '-' . $titre . $compteur . '.pdf');
                array_push($tableauImages,'petitDej:'.$concernedEvents[$i]->pathPetitDej);
                $compteur++;
            }
            if ($concernedEvents[$i]->pathDejeuner != 0) {
                $image = $concernedEvents[$i]->pathDejeuner;
                $client =  $concernedEvents[$i]->title;
                $dateDebut = explode(' ', $concernedEvents[$i]->start)[0];
                $titre = 'Dejeuner';
                $PDF = PDF::loadView('pdf.PDFimage', compact([
                    'NDFvalidated',
                    'image',
                    'titre',
                    'client',
                    'dateDebut',
                ]));
                // - On utilise la facade Storage pour sauvegarder notre fichier sur le disk public avec output
                Storage::put('public/pdf/' . $request->username . ' - ' . $request->moisndf . '/' . $request->username . '-' . $client . '-' . $dateDebut . '-' . $titre . $compteur . '.pdf', $PDF->output());
                array_push($tableauChemins,'public/pdf/' . $request->username . ' - ' . $request->moisndf . '/' . $request->username . '-' . $client . '-' . $dateDebut . '-' . $titre . $compteur . '.pdf');
                array_push($tableauImages,'dejeuner:'.$concernedEvents[$i]->pathDejeuner);
                $compteur++;
            }
            if ($concernedEvents[$i]->pathDiner != 0) {
                $image = $concernedEvents[$i]->pathDiner;
                $client =  $concernedEvents[$i]->title;
                $dateDebut = explode(' ', $concernedEvents[$i]->start)[0];
                $titre = 'Diner';
                $PDF = PDF::loadView('pdf.PDFimage', compact([
                    'NDFvalidated',
                    'image',
                    'titre',
                    'client',
                    'dateDebut',
                ]));
                // - On utilise la facade Storage pour sauvegarder notre fichier sur le disk public avec output
                Storage::put('public/pdf/' . $request->username . ' - ' . $request->moisndf . '/' . $request->username . '-' . $client . '-' . $dateDebut . '-' . $titre . $compteur . '.pdf', $PDF->output());
                array_push($tableauChemins,'public/pdf/' . $request->username . ' - ' . $request->moisndf . '/' . $request->username . '-' . $client . '-' . $dateDebut . '-' . $titre . $compteur . '.pdf');
                array_push($tableauImages,'diner:'.$concernedEvents[$i]->pathDiner);
                $compteur++;
            }
            if ($concernedEvents[$i]->pathDivers != 0) {
                $image = $concernedEvents[$i]->pathDivers;
                $client =  $concernedEvents[$i]->title;
                $dateDebut = explode(' ', $concernedEvents[$i]->start)[0];
                $titre = 'Divers';
                $PDF = PDF::loadView('pdf.PDFimage', compact([
                    'NDFvalidated',
                    'image',
                    'titre',
                    'client',
                    'dateDebut',
                ]));
                // - On utilise la facade Storage pour sauvegarder notre fichier sur le disk public avec output
                Storage::put('public/pdf/' . $request->username . ' - ' . $request->moisndf . '/' . $request->username . '-' . $client . '-' . $dateDebut . '-' . $titre . $compteur . '.pdf', $PDF->output());
                array_push($tableauChemins,'public/pdf/' . $request->username . ' - ' . $request->moisndf . '/' . $request->username . '-' . $client . '-' . $dateDebut . '-' . $titre . $compteur . '.pdf');
                array_push($tableauImages,'divers:'.$concernedEvents[$i]->pathDivers);
                $compteur++;
            }
            if ($concernedEvents[$i]->pathAemporter != 0) {
                $image = $concernedEvents[$i]->pathAemporter;
                $client =  $concernedEvents[$i]->title;
                $dateDebut = explode(' ', $concernedEvents[$i]->start)[0];
                $titre = 'Aemporter';
                $PDF = PDF::loadView('pdf.PDFimage', compact([
                    'NDFvalidated',
                    'image',
                    'titre',
                    'client',
                    'dateDebut',
                ]));
                // - On utilise la facade Storage pour sauvegarder notre fichier sur le disk public avec output
                Storage::put('public/pdf/' . $request->username . ' - ' . $request->moisndf . '/' . $request->username . '-' . $client . '-' . $dateDebut . '-' . $titre . $compteur . '.pdf', $PDF->output());
                array_push($tableauChemins,'public/pdf/' . $request->username . ' - ' . $request->moisndf . '/' . $request->username . '-' . $client . '-' . $dateDebut . '-' . $titre . $compteur . '.pdf');
                array_push($tableauImages,'a emporter:'.$concernedEvents[$i]->pathAemporter);
                $compteur++;
            }
            if ($concernedEvents[$i]->pathHotel != 0) {
                $image = $concernedEvents[$i]->pathHotel;
                $client =  $concernedEvents[$i]->title;
                $dateDebut = explode(' ', $concernedEvents[$i]->start)[0];
                $titre = 'Hotel';
                $PDF = PDF::loadView('pdf.PDFimage', compact([
                    'NDFvalidated',
                    'image',
                    'titre',
                    'client',
                    'dateDebut',
                ]));
                // - On utilise la facade Storage pour sauvegarder notre fichier sur le disk public avec output
                Storage::put('public/pdf/' . $request->username . ' - ' . $request->moisndf . '/' . $request->username . '-' . $client . '-' . $dateDebut . '-' . $titre . $compteur . '.pdf', $PDF->output());
                array_push($tableauChemins,'public/pdf/' . $request->username . ' - ' . $request->moisndf . '/' . $request->username . '-' . $client . '-' . $dateDebut . '-' . $titre . $compteur . '.pdf');
                array_push($tableauImages,'hotel:'.$concernedEvents[$i]->pathHotel);
                $compteur++;
            }
            if ($concernedEvents[$i]->pathEssence != 0) {
                $image = $concernedEvents[$i]->pathEssence;
                $client =  $concernedEvents[$i]->title;
                $dateDebut = explode(' ', $concernedEvents[$i]->start)[0];
                $titre = 'Essence';
                $PDF = PDF::loadView('pdf.PDFimage', compact([
                    'NDFvalidated',
                    'image',
                    'titre',
                    'client',
                    'dateDebut',
                ]));

                // - On utilise la facade Storage pour sauvegarder notre fichier sur le disk public avec output
                Storage::put('public/pdf/' . $request->username . ' - ' . $request->moisndf . '/' . $request->username . '-' . $client . '-' . $dateDebut . '-' . $titre . $compteur . '.pdf', $PDF->output());
                array_push($tableauChemins,'public/pdf/' . $request->username . ' - ' . $request->moisndf . '/' . $request->username . '-' . $client . '-' . $dateDebut . '-' . $titre . $compteur . '.pdf');
                array_push($tableauImages,'essence:'.$concernedEvents[$i]->pathEssence);
                $compteur++;
            }
            // Storage::put('public/pdf/'.$request->username.' - '.$request->moisndf.$i.'.pdf' , $PDF->output());
        }
         // création du PDF récapitulatif des factures
         $dateNDF = explode("-", $request->moisndf);

                // - Le switch case permet d'écrire sur le mail le mois en fonction du numéro du mois.
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

                $moisNDF = $moisDateNDF . " " . $dateNDF[0];

        $compteur = 0;
        $PDF = PDF::loadview('pdf.PDFrecap',compact([
            'NDFvalidated',
            'tableauChemins',
            'tableauImages',
            'moisNDF',
        ]));
        Storage::put('public/PDFrecapitulatifs/recap-' . $request->username . '-' . $request->moisndf . '.pdf',$PDF->output());



        // - Une fois le fichier sauvegardé on envoi le mail à l'utilisateur qui viens de valider
        Mail::to(Auth::user()->email)->send(new PDFmail($request->username, $request->moisndf, $tableauChemins));



        // - Validation de la note de frais en base de données
        DB::table('infosndfs')->where('Utilisateur', '=', $request->username)->where('MoisEnCours', '=', $request->moisndf)->update(['ValidationEnCours' => 0]);
        DB::table('infosndfs')->where('Utilisateur', '=', $request->username)->where('MoisEnCours', '=', $request->moisndf)->update(['Valide' => 1]);
        DB::table('infosndfs')->where('Utilisateur', '=', $request->username)->where('MoisEnCours', '=', $request->moisndf)->update(['ValideePar' => Auth::user()->name]);
        DB::table('infosndfs')->where('Utilisateur', '=', $request->username)->where('MoisEnCours', '=', $request->moisndf)->update(['DateValidation' => date('d/m/Y')]);

        $salarie = DB::table('users')->where('name', '=', $request->username)->get();

        $moderator = DB::table('users')->where('id', '=', Auth::user()->id)->get();

        // - notification au salarié de la validation de sa note de frais
        Mail::to($salarie[0]->email)->send(new MailNotifSalarie($moderator, $salarie, $moisNDF));


        Session::flash('validatesuccess', "La note de frais a été validée ! Un mail vous a été envoyé avec les factures de cette note de frais !");
        return redirect(route('gestionaireUser'));
    }
    public function supprimerNDF(Request $request)
    {

        DB::table('infosndfs')->where('Utilisateur', '=', $request->username)->where('MoisEnCours', '=', $request->moisndf)->delete();

        Session::flash('deleteNDF', 'la note de frais à bien été supprimée !');

        return redirect(route('gestionaireUser'));
    }


    public function rejeterNDF(Request $request)
    {

        // - on créer un rejet dans la base de donnée
        Rejet::create([
            'TextRejet' => $request->rejetText,
            'UserID' => $request->userID,
            'UserName' => $request->username,
            'MoisNDF' => $request->moisndf,
            'RejectedBy' => Auth::user()->name,
        ]);

        // - on récupère en base de données le dernier rejet que l'on viens de créer
        $rejet = DB::table("rejets")->where("UserID", "=", $request->userID)->where("MoisNDF", "=", $request->moisndf)->get();
        $rejecter = DB::table("users")->where("id", "=", $request->userID)->get();
        $dernierRejet = $rejet[sizeof($rejet) - 1];

        // - on récupère également le user concerné et surtout son adresse email pour l'envoi

        $rejetUser = DB::table('users')->where("id", "=", $request->userID)->get();
        $dateNDF = explode("-", $request->moisndf);

        // - Le switch case permet d'écrire sur le mail le mois en fonction du numéro du mois.
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

        $moisNDF = $moisDateNDF . " " . $dateNDF[0];

        // - on envoie un mail a l'utilisateur en question dans lequel on joint le text écrit par le moderateur
        Mail::to($rejetUser[0]->email)->send(new MailRejet($dernierRejet, $rejetUser, $moisNDF, $rejecter));

        // - on récupère la note de frais concernée et on la supprime pour dévérrouiller le mois de l'utilisateur
        DB::table('infosndfs')->where('MoisEnCours', '=', $request->moisndf)->where('Utilisateur', '=', $rejetUser[0]->name)->delete();
        Session::flash('rejetValidate', "La note de frais a bien été rejetée et l'utilisateur a été prévenu par mail.");

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

    ////////////////////////////
    // Gestion des évènements //
    ////////////////////////////

    public function createEvent(Request $request)
    {

        /* - création du nom du dossier dans lequel les images seront stockées */
        $folderName = Auth::user()->name . "-" . $request->moisActuel;


        /* - stockage des image ainsi que de leur chemin pour ensuite les envoyer en bdd*/
        if ($request->hasFile('factureParking')) {
            $imageParking = Storage::disk('public')->put($folderName .'/tmp' , $request->file('factureParking'));
            $filePath = storage_path('app/public/' . $folderName);
            $fileName = $request->iding.'parking'.'.'. $request->file('factureParking')->extension();
            $imgParking = Image::make(storage_path('app/public/' . $imageParking));
            $imgParking->resize(300, 300, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$fileName);
            Storage::disk('public')->delete($imageParking);
            $pathParking = $folderName.'/'.$fileName;
        } else {
            $pathParking = "0";
        }
        if ($request->hasFile('facturePeage')) {
             $imagePeage = Storage::disk('public')->put($folderName .'/tmp' , $request->file('facturePeage'));
            $filePath = storage_path('app/public/' . $folderName);
            $fileName = $request->iding.'peage'.'.'. $request->file('facturePeage')->extension();
            $imgPeage = Image::make(storage_path('app/public/' . $imagePeage));
            $imgPeage->resize(300, 300, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$fileName);
            Storage::disk('public')->delete($imagePeage);
            $pathPeage = $folderName.'/'.$fileName;

        } else {
            $pathPeage = "0";
        }
        if ($request->hasFile('facturePeage2')) {
             $imagePeage2 = Storage::disk('public')->put($folderName .'/tmp' , $request->file('facturePeage2'));
            $filePath = storage_path('app/public/' . $folderName);
            $fileName = $request->iding.'peage2'.'.'. $request->file('facturePeage2')->extension();
            $imgPeage2 = Image::make(storage_path('app/public/' . $imagePeage2));
            $imgPeage2->resize(300, 300, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$fileName);
            Storage::disk('public')->delete($imagePeage2);
            $pathPeage2 = $folderName.'/'.$fileName;

        } else {
            $pathPeage2 = "0";
        }
        if ($request->hasFile('facturePeage3')) {
             $imagePeage3 = Storage::disk('public')->put($folderName .'/tmp' , $request->file('facturePeage3'));
            $filePath = storage_path('app/public/' . $folderName);
            $fileName = $request->iding.'peage3'.'.'. $request->file('facturePeage3')->extension();
            $imgPeage3 = Image::make(storage_path('app/public/' . $imagePeage3));
            $imgPeage3->resize(300, 300, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$fileName);
            Storage::disk('public')->delete($imagePeage3);
            $pathPeage3 = $folderName.'/'.$fileName;

        } else {
            $pathPeage3 = "0";
        }
        if ($request->hasFile('facturePeage4')) {
             $imagePeage4 = Storage::disk('public')->put($folderName .'/tmp' , $request->file('facturePeage4'));
            $filePath = storage_path('app/public/' . $folderName);
            $fileName = $request->iding.'peage4'.'.'. $request->file('facturePeage4')->extension();
            $imgPeage4 = Image::make(storage_path('app/public/' . $imagePeage4));
            $imgPeage4->resize(300, 300, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$fileName);
            Storage::disk('public')->delete($imagePeage4);
            $pathPeage4 = $folderName.'/'.$fileName;

        } else {
            $pathPeage4 = "0";
        }
        if ($request->hasFile('factureDivers')) {
             $imageDivers = Storage::disk('public')->put($folderName .'/tmp' , $request->file('factureDivers'));
            $filePath = storage_path('app/public/' . $folderName);
            $fileName = $request->iding.'divers'.'.'. $request->file('factureDivers')->extension();
            $imgDivers = Image::make(storage_path('app/public/' . $imageDivers));
            $imgDivers->resize(300, 300, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$fileName);
            Storage::disk('public')->delete($imageDivers);
            $pathDivers = $folderName.'/'.$fileName;

        } else {
            $pathDivers = "0";
        }
        if ($request->hasFile('facturePetitDej')) {
             $imagePetitDej = Storage::disk('public')->put($folderName .'/tmp' , $request->file('facturePetitDej'));
            $filePath = storage_path('app/public/' . $folderName);
            $fileName = $request->iding.'petitdej'.'.'. $request->file('facturePetitDej')->extension();
            $imgPetitDej = Image::make(storage_path('app/public/' . $imagePetitDej));
            $imgPetitDej->resize(300, 300, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$fileName);
            Storage::disk('public')->delete($imagePetitDej);
            $pathPetitDej = $folderName.'/'.$fileName;

        } else {
            $pathPetitDej = "0";
        }
        if ($request->hasFile('factureDejeuner')) {
             $imageDejeuner = Storage::disk('public')->put($folderName .'/tmp' , $request->file('factureDejeuner'));
            $filePath = storage_path('app/public/' . $folderName);
            $fileName = $request->iding.'dejeuner'.'.'. $request->file('factureDejeuner')->extension();
            $imgDejeuner = Image::make(storage_path('app/public/' . $imageDejeuner));
            $imgDejeuner->resize(300, 300, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$fileName);
            Storage::disk('public')->delete($imageDejeuner);
            $pathDejeuner = $folderName.'/'.$fileName;

        } else {
            $pathDejeuner = "0";
        }
        if ($request->hasFile('factureDiner')) {
             $imageDiner = Storage::disk('public')->put($folderName .'/tmp' , $request->file('factureDiner'));
            $filePath = storage_path('app/public/' . $folderName);
            $fileName = $request->iding.'diner'.'.'. $request->file('factureDiner')->extension();
            $imgDiner = Image::make(storage_path('app/public/' . $imageDiner));
            $imgDiner->resize(300, 300, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$fileName);
            Storage::disk('public')->delete($imageDiner);
            $pathDiner = $folderName.'/'.$fileName;

        } else {
            $pathDiner = "0";
        }
        if ($request->hasFile('factureAemporter')) {
             $imageAemporter = Storage::disk('public')->put($folderName .'/tmp' , $request->file('factureAemporter'));
            $filePath = storage_path('app/public/' . $folderName);
            $fileName = $request->iding.'aemporter'.'.'. $request->file('factureAemporter')->extension();
            $imgAemporter = Image::make(storage_path('app/public/' . $imageAemporter));
            $imgAemporter->resize(300, 300, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$fileName);
            Storage::disk('public')->delete($imageAemporter);
            $pathAemporter = $folderName.'/'.$fileName;

        } else {
            $pathAemporter = "0";
        }
        if ($request->hasFile('factureHotel')) {
            $imageHotel = Storage::disk('public')->put($folderName .'/tmp' , $request->file('factureHotel'));
            $filePath = storage_path('app/public/' . $folderName);
            $fileName = $request->iding.'hotel'.'.'. $request->file('factureHotel')->extension();
            $imgHotel = Image::make(storage_path('app/public/' . $imageHotel));
            $imgHotel->resize(300, 300, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$fileName);
            Storage::disk('public')->delete($imageHotel);
            $pathHotel = $folderName.'/'.$fileName;

        } else {
            $pathHotel = "0";
        }
        if ($request->hasFile('factureEssence')) {
            $imageEssence = Storage::disk('public')->put($folderName .'/tmp' , $request->file('factureEssence'));
            $filePath = storage_path('app/public/' . $folderName);
            $fileName = $request->iding.'essence'.'.'. $request->file('factureEssence')->extension();
            $imgEssence = Image::make(storage_path('app/public/' . $imageEssence));
            $imgEssence->resize(300, 300, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$fileName);
            Storage::disk('public')->delete($imageEssence);
            $pathEssence = $folderName.'/'.$fileName;

        } else {
            $pathEssence = "0";
        }

        /* - Importation des données en base de donnée */

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
            "aEmporter" => $request->aEmporter,
            "hotel" => $request->hotel,
            "kilometrage" => $request->kilometrage,
            "mois" => $request->moisActuel,
            "heure_debut" => $request->heureDebut,
            "heure_fin" => $request->heureFin,
            "idUser" => Auth::user()->id,

            "pathParking" => $pathParking,
            "pathPeage" => $pathPeage,
            "pathPeage2" => $pathPeage2,
            "pathPeage3" => $pathPeage3,
            "pathPeage4" => $pathPeage4,
            "pathDivers" => $pathDivers,
            "pathPetitDej" => $pathPetitDej,
            "pathDejeuner" => $pathDejeuner,
            "pathDiner" => $pathDiner,
            "pathAemporter" => $pathAemporter,
            "pathHotel" => $pathHotel,
            "pathEssence" => $pathEssence,
        ]);

        Session::flash('createEvent', "L'évènement a été ajouté à votre calendrier !");

        return redirect(route('calendrier'));
    }

    public function supprimerEvent(Request $request)
    {
        $eventSelected = DB::table('events')->where('id', '=', $request->eventID)->get();

        Storage::disk('public')->delete($eventSelected[0]->pathParking);
        Storage::disk('public')->delete($eventSelected[0]->pathPeage);
        Storage::disk('public')->delete($eventSelected[0]->pathPeage2);
        Storage::disk('public')->delete($eventSelected[0]->pathPeage3);
        Storage::disk('public')->delete($eventSelected[0]->pathPeage4);
        Storage::disk('public')->delete($eventSelected[0]->pathDivers);
        Storage::disk('public')->delete($eventSelected[0]->pathPetitDej);
        Storage::disk('public')->delete($eventSelected[0]->pathDejeuner);
        Storage::disk('public')->delete($eventSelected[0]->pathDiner);
        Storage::disk('public')->delete($eventSelected[0]->pathAemporter);
        Storage::disk('public')->delete($eventSelected[0]->pathHotel);
        Storage::disk('public')->delete($eventSelected[0]->pathEssence);

        DB::table('events')->where('id', '=', $request->eventID)->delete();
        Session::flash("supprEvent", "L'évènement à bien été supprimé");
        return redirect(route("calendrier"));
    }

    public function ModifierEvent(Request $request)
    {

        $userEvent = DB::table('users')->where('id', '=', $request->idUser)->get();
        $folderName = $userEvent[0]->name . "-" . $request->mois;



        /////////////////////////
        // - Si une image a été entrée dans la modif, on supprime l'ancienne, on sauvegarde la nouvelle avec storage puis on modifie le chemin en BDD //
        /////////////////////////

        if ($request->modifFactureParking != null) {
            Storage::disk('public')->delete($request->pathFactureParking);

            $imageParking = Storage::disk('public')->put($folderName .'/tmp' , $request->file('modifFactureParking'));
            $filePath = storage_path('app/public/' . $folderName);
            $fileName = $request->eventID.'parking'.'.'. $request->file('modifFactureParking')->extension();
            $imgParking = Image::make(storage_path('app/public/' . $imageParking));
            $imgParking->resize(300, 300, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$fileName);
            Storage::disk('public')->delete($imageParking);
            $newPathParking = $folderName.'/'.$fileName;


        } else {
            $newPathParking = $request->pathFactureParking;
        }
        if ($request->modifFacturePeage != null) {
            Storage::disk('public')->delete($request->pathFacturePeage);
            $imagePeage = Storage::disk('public')->put($folderName .'/tmp' , $request->file('modifFacturePeage'));
            $filePath = storage_path('app/public/' . $folderName);
            $fileName = $request->eventID.'peage'.'.'. $request->file('modifFacturePeage')->extension();
            $imgPeage = Image::make(storage_path('app/public/' . $imagePeage));
            $imgPeage->resize(300, 300, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$fileName);
            Storage::disk('public')->delete($imagePeage);
            $newPathPeage = $folderName.'/'.$fileName;

        } else {
            $newPathPeage = $request->pathFacturePeage;
        }
        if ($request->modifFacturePeage2 != null) {
            Storage::disk('public')->delete($request->pathFacturePeage2);
            $imagePeage2 = Storage::disk('public')->put($folderName .'/tmp' , $request->file('modifFacturePeage2'));
            $filePath = storage_path('app/public/' . $folderName);
            $fileName = $request->eventID.'peage2'.'.'. $request->file('modifFacturePeage2')->extension();
            $imgPeage2 = Image::make(storage_path('app/public/' . $imagePeage2));
            $imgPeage2->resize(300, 300, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$fileName);
            Storage::disk('public')->delete($imagePeage2);
            $newPathPeage2 = $folderName.'/'.$fileName;

        } else {
            $newPathPeage2 = $request->pathFacturePeage2;
        }
        if ($request->modifFacturePeage3 != null) {
            Storage::disk('public')->delete($request->pathFacturePeage3);
            $imagePeage3 = Storage::disk('public')->put($folderName .'/tmp' , $request->file('modifFacturePeage3'));
            $filePath = storage_path('app/public/' . $folderName);
            $fileName = $request->eventID.'peage3'.'.'. $request->file('modifFacturePeage3')->extension();
            $imgPeage3 = Image::make(storage_path('app/public/' . $imagePeage3));
            $imgPeage3->resize(300, 300, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$fileName);
            Storage::disk('public')->delete($imagePeage3);
            $newPathPeage3 = $folderName.'/'.$fileName;

        } else {
            $newPathPeage3 = $request->pathFacturePeage3;
        }
        if ($request->modifFacturePeage4 != null) {
            Storage::disk('public')->delete($request->pathFacturePeage4);
            $imagePeage4 = Storage::disk('public')->put($folderName .'/tmp' , $request->file('modifFacturePeage4'));
            $filePath = storage_path('app/public/' . $folderName);
            $fileName = $request->eventID.'peage4'.'.'. $request->file('modifFacturePeage4')->extension();
            $imgPeage4 = Image::make(storage_path('app/public/' . $imagePeage4));
            $imgPeage4->resize(300, 300, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$fileName);
            Storage::disk('public')->delete($imagePeage4);
            $newPathPeage4 = $folderName.'/'.$fileName;

        } else {
            $newPathPeage4 = $request->pathFacturePeage4;
        }
        if ($request->modifFactureDivers != null) {
            Storage::disk('public')->delete($request->pathFactureDivers);
            $imageDivers = Storage::disk('public')->put($folderName .'/tmp' , $request->file('modifFactureDivers'));
            $filePath = storage_path('app/public/' . $folderName);
            $fileName = $request->eventID.'divers'.'.'. $request->file('modifFactureDivers')->extension();
            $imgDivers = Image::make(storage_path('app/public/' . $imageDivers));
            $imgDivers->resize(300, 300, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$fileName);
            Storage::disk('public')->delete($imageDivers);
            $newPathDivers = $folderName.'/'.$fileName;

        } else {
            $newPathDivers = $request->pathFactureDivers;
        }
        if ($request->modifFacturePetitDej != null) {
            Storage::disk('public')->delete($request->pathFacturePetitDej);
            $imagePetitDej = Storage::disk('public')->put($folderName .'/tmp' , $request->file('modifFacturePetitDej'));
            $filePath = storage_path('app/public/' . $folderName);
            $fileName = $request->eventID.'petitdej'.'.'. $request->file('modifFacturePetitDej')->extension();
            $imgPetitDej = Image::make(storage_path('app/public/' . $imagePetitDej));
            $imgPetitDej->resize(300, 300, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$fileName);
            Storage::disk('public')->delete($imagePetitDej);
            $newPathPetitDej = $folderName.'/'.$fileName;

        } else {
            $newPathPetitDej = $request->pathFacturePetitDej;
        }
        if ($request->modifFactureDejeuner != null) {
            Storage::disk('public')->delete($request->pathFactureDejeuner);
            $imageDejeuner = Storage::disk('public')->put($folderName .'/tmp' , $request->file('modifFactureDejeuner'));
            $filePath = storage_path('app/public/' . $folderName);
            $fileName = $request->eventID.'dejeuner'.'.'. $request->file('modifFactureDejeuner')->extension();
            $imgDejeuner = Image::make(storage_path('app/public/' . $imageDejeuner));
            $imgDejeuner->resize(300, 300, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$fileName);
            Storage::disk('public')->delete($imageDejeuner);
            $newPathDejeuner = $folderName.'/'.$fileName;

        } else {
            $newPathDejeuner = $request->pathFactureDejeuner;
        }
        if ($request->modifFactureDiner != null) {
            Storage::disk('public')->delete($request->pathFactureDiner);
            $imageDiner = Storage::disk('public')->put($folderName .'/tmp' , $request->file('modifFactureDiner'));
            $filePath = storage_path('app/public/' . $folderName);
            $fileName = $request->eventID.'diner'.'.'. $request->file('modifFactureDiner')->extension();
            $imgDiner = Image::make(storage_path('app/public/' . $imageDiner));
            $imgDiner->resize(300, 300, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$fileName);
            Storage::disk('public')->delete($imageDiner);
            $newPathDiner = $folderName.'/'.$fileName;

        } else {
            $newPathDiner = $request->pathFactureDiner;
        }
        if ($request->modifFactureAemporter != null) {
            Storage::disk('public')->delete($request->pathFactureAemporter);
            $imageAemporter = Storage::disk('public')->put($folderName .'/tmp' , $request->file('modifFactureAemporter'));
            $filePath = storage_path('app/public/' . $folderName);
            $fileName = $request->eventID.'aemporter'.'.'. $request->file('modifFactureAemporter')->extension();
            $imgAemporter = Image::make(storage_path('app/public/' . $imageAemporter));
            $imgAemporter->resize(300, 300, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$fileName);
            Storage::disk('public')->delete($imageAemporter);
            $newPathAemporter = $folderName.'/'.$fileName;

        } else {
            $newPathAemporter = $request->pathFactureAemporter;
        }
        if ($request->modifFactureHotel != null) {
            Storage::disk('public')->delete($request->pathFactureHotel);
            $imageHotel = Storage::disk('public')->put($folderName .'/tmp' , $request->file('modifFactureHotel'));
            $filePath = storage_path('app/public/' . $folderName);
            $fileName = $request->eventID.'hotel'.'.'. $request->file('modifFactureHotel')->extension();
            $imgHotel = Image::make(storage_path('app/public/' . $imageHotel));
            $imgHotel->resize(300, 300, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$fileName);
            Storage::disk('public')->delete($imageHotel);
            $newPathHotel = $folderName.'/'.$fileName;

        } else {
            $newPathHotel = $request->pathFactureHotel;
        }
        if ($request->modifFactureEssence != null) {
            Storage::disk('public')->delete($request->pathFactureEssence);
            $imageEssence = Storage::disk('public')->put($folderName .'/tmp' , $request->file('modifFactureEssence'));
            $filePath = storage_path('app/public/' . $folderName);
            $fileName = $request->eventID.'essence'.'.'. $request->file('modifFactureEssence')->extension();
            $imgEssence = Image::make(storage_path('app/public/' . $imageEssence));
            $imgEssence->resize(300, 300, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$fileName);
            Storage::disk('public')->delete($imageEssence);
            $newPathEssence = $folderName.'/'.$fileName;

        } else {
            $newPathEssence = $request->pathFactureEssence;
        }

        $eventEnQuestion = DB::table('events')->where('id', '=', $request->eventID)->update([
            'start' => $request->start,
            'end' => $request->end,
            'description' => $request->description,
            'title' => $request->title,
            'ville' => $request->ville,
            'code_postal' => $request->code_postal,
            'peage' => $request->peage,
            'peage2' => $request->peage2,
            'peage3' => $request->peage3,
            'peage4' => $request->peage4,
            'parking' => $request->parking,
            'essence' => $request->essence,
            'divers' => $request->divers,
            'petitDej' => $request->petitDej,
            'dejeuner' => $request->dejeuner,
            'diner' => $request->diner,
            'aEmporter' => $request->aEmporter,
            'hotel' => $request->hotel,
            'kilometrage' => $request->kilometrage,
            'mois' => $request->mois,
            'heure_debut' => $request->heureDebut,
            'heure_fin' => $request->heureFin,
            'idUser' => $request->idUser,

            'pathParking' => $newPathParking,
            'pathPeage' => $newPathPeage,
            'pathPeage2' => $newPathPeage2,
            'pathPeage3' => $newPathPeage3,
            'pathPeage4' => $newPathPeage4,
            'pathDivers' => $newPathDivers,
            'pathPetitDej' => $newPathPetitDej,
            'pathDejeuner' => $newPathDejeuner,
            'pathDiner' => $newPathDiner,
            'pathAemporter' => $newPathAemporter,
            'pathHotel' => $newPathHotel,
            'pathEssence' => $newPathEssence,

        ]);

        Session::flash("modifEvent", "L'évènement a bien été modifié !");

        return redirect(route("calendrier"));
    }
};
