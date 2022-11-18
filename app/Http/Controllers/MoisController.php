<?php

namespace App\Http\Controllers;

use App\Models\Mois;
use App\Models\Event;
use App\Mail\MailNotif;
use App\Models\infosndf;
use App\Models\Mois_valide;
use App\Mail\MailNotifAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class MoisController extends Controller
{



    public function lockMonth(Request $request)
    {
        /* - Si on clique sur soumetre le mois, il n'est plus modifiable */

        $events = DB::table('users')->RightJoin("events", "events.idUser", "users.id")->where("idUser", "=", Auth::user()->id)->where("mois", "=", $request->lockedmonth)->get();

        $chFiscaux = DB::table('users')->select('chevauxFiscaux')->where('name', '=', Auth::user()->name)->get();
        $NBevents = DB::table('events')->where('mois', '=', $request->lockedmonth)->where('idUser', '=', Auth::user()->id)->get();

        // dd($NBevents);

        if (count($NBevents) == 0) {
            Session::flash('pasevents', "Vous n'avez pas d'évènements enregistrés pour ce mois !");
            return redirect(route("calendrier"));
        };

        /* - On parcours l'ensemble du des évènements de l'utilisateur connécté pour ce mois */
        for ($i = 0; $i < count($NBevents); $i++) {
            /* - on vérifi que pour chaque image entré, une valeur y est liée. */
            if($NBevents[$i]->pathParking == 0 && $NBevents[$i]->pathPeage == 0 && $NBevents[$i]->pathPeage2 == 0 && $NBevents[$i]->pathPeage3 == 0 && $NBevents[$i]->pathPeage4 == 0 && $NBevents[$i]->pathDivers == 0 && $NBevents[$i]->pathPetitDej == 0 && $NBevents[$i]->pathDejeuner == 0 && $NBevents[$i]->pathDiner == 0 && $NBevents[$i]->pathAemporter == 0 && $NBevents[$i]->pathHotel == 0 && $NBevents[$i]->pathEssence == 0 && $NBevents[$i]->parking == 0 && $NBevents[$i]->peage == 0 && $NBevents[$i]->peage2 == 0 && $NBevents[$i]->peage3 == 0 && $NBevents[$i]->peage4 == 0 && $NBevents[$i]->divers == 0 && $NBevents[$i]->petitDej == 0 && $NBevents[$i]->dejeuner == 0 && $NBevents[$i]->diner == 0 && $NBevents[$i]->aEmporter == 0 && $NBevents[$i]->hotel == 0 && $NBevents[$i]->essence == 0)
            {
                Session::flash('emptyInput',"Merci de rentrer au moins une valeur pour votre déplacement du " . $NBevents[$i]->end . 'chez' . $NBevents[$i]->title);
                return redirect(route("calendrier"));
            }
            if ($NBevents[$i]->parking != 0 && $NBevents[$i]->pathParking == 0) {
                Session::flash('noPathParking',"Merci d'entrer la facture de parking pour votre évènement du " . $NBevents[$i]->end . " chez " . $NBevents[$i]->title);
                return redirect(route("calendrier"));
            }
            if ($NBevents[$i]->peage != 0 && $NBevents[$i]->pathPeage == 0) {
                Session::flash('noPathPeage',"Merci d'entrer la facture de péage pour votre évènement du " . $NBevents[$i]->end . " chez " . $NBevents[$i]->title);
                return redirect(route("calendrier"));
            }
            if ($NBevents[$i]->peage2 != 0 && $NBevents[$i]->pathPeage2 == 0) {
                Session::flash('noPathPeage2',"Merci d'entrer la facture de peage 2 pour votre évènement du " . $NBevents[$i]->end . " chez " . $NBevents[$i]->title);
                return redirect(route("calendrier"));
            }
            if ($NBevents[$i]->peage3 != 0 && $NBevents[$i]->pathPeage3 == 0) {
                Session::flash('noPathPeage3',"Merci d'entrer la facture de péage 3 pour votre évènement du " . $NBevents[$i]->end . " chez " . $NBevents[$i]->title);
                return redirect(route("calendrier"));
            }
            if ($NBevents[$i]->peage4 != 0 && $NBevents[$i]->pathPeage4 == 0) {
                Session::flash('noPathPeage4',"Merci d'entrer la facture de péage 4 pour votre évènement du " . $NBevents[$i]->end . " chez " . $NBevents[$i]->title);
                return redirect(route("calendrier"));
            }
            if ($NBevents[$i]->divers != 0 && $NBevents[$i]->pathDivers == 0) {
                Session::flash('noPathDivers',"Merci d'entrer la facture de divers pour votre évènement du " . $NBevents[$i]->end . " chez " . $NBevents[$i]->title);
                return redirect(route("calendrier"));
            }
            if ($NBevents[$i]->petitDej != 0 && $NBevents[$i]->pathPetitDej == 0) {
                Session::flash('noPathPetitDej',"Merci d'entrer la facture du petit déjeuner pour votre évènement du " . $NBevents[$i]->end . " chez " . $NBevents[$i]->title);
                return redirect(route("calendrier"));
            }
            if ($NBevents[$i]->dejeuner != 0 && $NBevents[$i]->pathDejeuner == 0) {
                Session::flash('noPathDejeuner',"Merci d'entrer la facture du déjeuner pour votre évènement du " . $NBevents[$i]->end . " chez " . $NBevents[$i]->title);
                return redirect(route("calendrier"));
            }
            if ($NBevents[$i]->diner != 0 && $NBevents[$i]->pathDiner == 0) {
                Session::flash('noPathDiner',"Merci d'entrer la facture du dîner pour votre évènement du " . $NBevents[$i]->end . " chez " . $NBevents[$i]->title);
                return redirect(route("calendrier"));
            }
            if ($NBevents[$i]->aEmporter != 0 && $NBevents[$i]->pathAemporter == 0) {
                Session::flash('noPathAemporter',"Merci d'entrer la facture de vos repas à emporter pour votre évènement du " . $NBevents[$i]->end . " chez " . $NBevents[$i]->title);
                return redirect(route("calendrier"));
            }
            if ($NBevents[$i]->hotel != 0 && $NBevents[$i]->pathHotel == 0) {
                Session::flash('noPathHotel',"Merci d'entrer la facture de l'hotêl pour votre évènement du " . $NBevents[$i]->end . " chez " . $NBevents[$i]->title);
                return redirect(route("calendrier"));
            }
            if ($NBevents[$i]->essence != 0 && $NBevents[$i]->pathEssence == 0) {
                Session::flash('noPathEssence',"Merci d'entrer la facture de l'éssence pour votre évènement du " . $NBevents[$i]->end . " chez " . $NBevents[$i]->title);
                return redirect(route("calendrier"));
            }

            /* - à l'inverse, on vérifie que */

            if ($NBevents[$i]->parking == 0 && $NBevents[$i]->pathParking != 0) {
                Session::flash('noParking',"Merci d'entrer la valeur du parking pour votre évènement du " . $NBevents[$i]->end . " chez " . $NBevents[$i]->title);
                return redirect(route("calendrier"));
            }
            if ($NBevents[$i]->peage == 0 && $NBevents[$i]->pathPeage != 0) {
                Session::flash('noPeage',"Merci d'entrer la valeur du péage pour votre évènement du " . $NBevents[$i]->end . " chez " . $NBevents[$i]->title);
                return redirect(route("calendrier"));
            }
            if ($NBevents[$i]->peage2 == 0 && $NBevents[$i]->pathPeage2 != 0) {
                Session::flash('noPeage2',"Merci d'entrer la valeur du péage 2 pour votre évènement du " . $NBevents[$i]->end . " chez " . $NBevents[$i]->title);
                return redirect(route("calendrier"));
            }
            if ($NBevents[$i]->peage3 == 0 && $NBevents[$i]->pathPeage3 != 0) {
                Session::flash('noPeage3',"Merci d'entrer la valeur du péage 3 pour votre évènement du " . $NBevents[$i]->end . " chez " . $NBevents[$i]->title);
                return redirect(route("calendrier"));
            }
            if ($NBevents[$i]->peage4 == 0 && $NBevents[$i]->pathPeage4 != 0) {
                Session::flash('noPeage4',"Merci d'entrer la valeur du péage 4 pour votre évènement du " . $NBevents[$i]->end . " chez " . $NBevents[$i]->title);
                return redirect(route("calendrier"));
            }
            if ($NBevents[$i]->divers == 0 && $NBevents[$i]->pathDivers != 0) {
                Session::flash('noDivers',"Merci d'entrer la valeur du parking pour votre évènement du " . $NBevents[$i]->end . " chez " . $NBevents[$i]->title);
                return redirect(route("calendrier"));
            }
            if ($NBevents[$i]->petitDej == 0 && $NBevents[$i]->pathPetitDej != 0) {
                Session::flash('noPetitDej',"Merci d'entrer la valeur du petit déjeuner pour votre évènement du " . $NBevents[$i]->end . " chez " . $NBevents[$i]->title);
                return redirect(route("calendrier"));
            }
            if ($NBevents[$i]->dejeuner == 0 && $NBevents[$i]->pathDejeuner != 0) {
                Session::flash('noDejeuner',"Merci d'entrer la valeur du déjeuner pour votre évènement du " . $NBevents[$i]->end . " chez " . $NBevents[$i]->title);
                return redirect(route("calendrier"));
            }
            if ($NBevents[$i]->diner == 0 && $NBevents[$i]->pathDiner != 0) {
                Session::flash('noDiner',"Merci d'entrer la valeur du dîner pour votre évènement du " . $NBevents[$i]->end . " chez " . $NBevents[$i]->title);
                return redirect(route("calendrier"));
            }
            if ($NBevents[$i]->aEmporter == 0 && $NBevents[$i]->pathAemporter != 0) {
                Session::flash('noAemporter',"Merci d'entrer la valeur de vos repas à emporter pour votre évènement du " . $NBevents[$i]->end . " chez " . $NBevents[$i]->title);
                return redirect(route("calendrier"));
            }
            if ($NBevents[$i]->hotel == 0 && $NBevents[$i]->pathHotel != 0) {
                Session::flash('noHotel',"Merci d'entrer la valeur de l'hôtel pour votre évènement du " . $NBevents[$i]->end . " chez " . $NBevents[$i]->title);
                return redirect(route("calendrier"));
            }
            if ($NBevents[$i]->essence == 0 && $NBevents[$i]->pathEssence != 0) {
                Session::flash('noEssence',"Merci d'entrer la valeur de l'essence pour votre évènement du " . $NBevents[$i]->end . " chez " . $NBevents[$i]->title);
                return redirect(route("calendrier"));
            }

        }

        /* - Variables utilisées dans les mails*/

        $moderators = DB::table('users')->where('admin', '=', '1')->get();
        $superadmin = DB::table('users')->where('superadmin', '=', '1')->get();
        $actualUser = Auth::user()->name;




        /* - Quand on clique sur soumetre la note de frais, cela créer une note de frais et la vérrouille*/

        $infosNDF = DB::table('infosndfs')->where('Utilisateur', '=', Auth::user()->name)->where('MoisEnCours', '=', $request->lockedmonth)->get();
        $dateDuJour = date('d/m/Y');

        if (count($infosNDF) == 0) {
            infosndf::create([
                "Utilisateur" => Auth::user()->name,
                "MoisEnCours" => $request->lockedmonth,
                "DateSoumission" => $dateDuJour,
                "NombreEvenement" => count($NBevents),
                "Valide" => 0,
                "ChevauxFiscaux" => $chFiscaux[0]->chevauxFiscaux,
                "tauxKM" => Auth::user()->taux,
            ]);

            /* - Envois des mails suite à la validation de la note de frais */

            $dateNDF = explode("-", $request->lockedmonth);

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


            $monthNDF = $moisDateNDF . " " . $dateNDF[0];

            if (Auth::user()->salarie == 1) {
                for ($i = 0; $i < count($moderators); $i++) {
                    Mail::to($moderators[$i]->email)->send(new MailNotif($moderators, $i, $actualUser, $monthNDF));
                }
            } elseif (Auth::user()->admin == 1 && Auth::user()->superadmin == 0) {
                Mail::to($superadmin[0]->email)->send(new MailNotifAdmin($superadmin, $actualUser, $monthNDF));
            }
        } else {

            /* - Si la note de frais à deja été créée le mail n'est pas envoyé pour évitéer le spam */

            Session::flash('dejasoumis', 'Ce mois à déjà été soumis à inspection !');
            return redirect(route("calendrier"));
        }

        /* - Si la note de frais à deja été créée alors ca la vérouille juste */

        DB::table('infosndfs')->where('Utilisateur', '=', Auth::user()->name)->where('MoisEnCours', '=', $request->lockedmonth)->update(["ValidationEnCours" => 1]);
        $NDFusers = DB::table('infosndfs')->where('Utilisateur', '=', Auth::user()->name)->get();
        $monthlocked = DB::table('infosndfs')->select('MoisEnCours')->where('Utilisateur', '=', Auth::user()->name)->where("ValidationEnCours", "=", "1")->where("MoisEnCours", "=", $request->lockedmonth)->get();
        $monthvalidated = DB::table('infosndfs')->select('MoisEnCours')->where('Utilisateur', '=', Auth::user()->name)->where("Valide", "=", "1");
        Session::flash('NDFcreee', 'La note de frais à été envoyée pour inspection ! ;)');

        return redirect(route("calendrier"));
        // dd($events);
    }
    public function unlockMonth(Request $request)
    {

        /* - fonction permettant le dévérouillage des mois lorceque la note de frais n'est plus validée */

        $valideoupas = DB::table('infosndfs')->select('Valide')->where('Utilisateur', '=', Auth::user()->name)->where('MoisEnCours', '=', $request->unlockedmonth)->get();

        if (sizeof($valideoupas) == 0) {
            Session::flash("nondf", "Ce mois n'a pas encore été soumis à inspection!");
            return redirect(route("calendrier"));
        }

        if ($valideoupas[0]->Valide == 1) {
            Session::flash('dejavalide', "La note de frais pour ce mois à déjà été validée,
            vous pouvez la consulter dans l'onglet  'Mes notes de frais'.");
            return redirect(route("calendrier"));
        }


        DB::table('infosndfs')->where('Utilisateur', '=', Auth::user()->name)->where('MoisEnCours', '=', $request->unlockedmonth)->delete();

        $monthlocked = DB::table('infosndfs')->select('MoisEnCours')->where('Utilisateur', '=', Auth::user()->name)->where("ValidationEnCours", "=", "1")->where("MoisEnCours", "=", $request->lockedmonth)->get();
        $monthvalidated = DB::table('infosndfs')->select('MoisEnCours')->where('Utilisateur', '=', Auth::user()->name)->where("Valide", "=", "1");

        Session::flash('NDFsuppr', 'Votre demande de validation a bien été annulée !');

        return redirect(route("calendrier"));
    }

    public function getLockedEventPerMonth(Request $request, $month)
    {
        $months = Mois::where("mois", "=", $month);

        return $months;
    }
}
