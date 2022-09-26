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
        /***  - si on clique sur soumetre le mois, il n'est plus modifiable ***/
        // dd($request);


        $events = DB::table('users')->RightJoin("events", "events.idUser", "users.id")->where("idUser", "=", Auth::user()->id)->where("mois", "=", $request->lockedmonth)->get();

        $chFiscaux = DB::table('users')->select('chevauxFiscaux')->where('name', '=', Auth::user()->name)->get();
        $NBevents = DB::table('events')->where('mois', '=', $request->lockedmonth)->where('idUser', '=', Auth::user()->id)->get();
        if (count($NBevents) == 0) {
            Session::flash('pasevents', "Vous n'avez pas d'évènements enregistrés pour ce mois !");
            return redirect('dashboard');
        }

        /* - Variables utilisées dans les mails*/

        $moderators = DB::table('users')->where('admin','=','1')->get();
        $superadmin = DB::table('users')->where('superadmin','=','1')->get();
        $actualUser = Auth::user()->name;
        $monthNDF = $request->lockedmonth;



        /* - Quand on clique sur soumetre la note de frais, cela créer une note de frais et la vérouille*/

        $infosNDF = DB::table('infosndfs')->where('Utilisateur', '=', Auth::user()->name)->where('MoisEnCours', '=', $request->lockedmonth)->get();


        if (count($infosNDF) == 0) {
            infosndf::create([
                "Utilisateur" => Auth::user()->name,
                "MoisEnCours" => $request->lockedmonth,
                "NombreEvenement" => count($NBevents),
                "Valide" => 0,
                "ChevauxFiscaux" => $chFiscaux[0]->chevauxFiscaux,
                "tauxKM" => Auth::user()->taux,
            ]);

/* - envois des mails suite à la validation de la note de frais */

        if(Auth::user()->salarie == 1){
            for ($i=0; $i < count($moderators) ; $i++) {
                Mail::to($moderators[$i]->email)->send(new MailNotif($moderators,$i,$actualUser,$monthNDF));
            }
        }elseif(Auth::user()->admin == 1 && Auth::user()->superadmin == 0){
            Mail::to($superadmin[0]->email)->send(new MailNotifAdmin($superadmin,$actualUser,$monthNDF));
        }

        } else {

            /* - Si la note de frais à deja été créée le mail n'est pas envoyé pour évitéer le spam */

            Session::flash('dejasoumis', 'Ce mois à déjà été soumis à inspection !');
            return redirect('dashboard');
        }

        /* - Si la note de frais à deja été créée alors ca la vérouille juste */

        DB::table('infosndfs')->where('Utilisateur', '=', Auth::user()->name)->where('MoisEnCours', '=', $request->lockedmonth)->update(["ValidationEnCours" => 1]);
        $NDFusers = DB::table('infosndfs')->where('Utilisateur', '=', Auth::user()->name)->get();
        $monthlocked = DB::table('infosndfs')->select('MoisEnCours')->where('Utilisateur', '=', Auth::user()->name)->where("ValidationEnCours", "=", "1")->where("MoisEnCours", "=", $request->lockedmonth)->get();
        $monthvalidated = DB::table('infosndfs')->select('MoisEnCours')->where('Utilisateur', '=', Auth::user()->name)->where("Valide", "=", "1");
        Session::flash('NDFcreee', 'La note de frais à été envoyée pour inspection ! ;)');

        return redirect(route('dashboard'));
        // dd($events);
    }
    public function unlockMonth(Request $request)
    {


        $valideoupas = DB::table('infosndfs')->select('Valide')->where('Utilisateur', '=', Auth::user()->name)->where('MoisEnCours', '=', $request->unlockedmonth)->get();

         if(sizeof($valideoupas) == 0){
            Session::flash("nondf","Ce mois n'est pas vérrouillé !");
            return redirect('dashboard');
         }

        if($valideoupas[0]->Valide == 1){
            Session::flash('dejavalide',"La note de frais pour ce mois à déjà été validée
            vous pouvez la consulter dans l'onglet  'Mes notes de frais'." );
            return redirect('dashboard');
        }


        DB::table('infosndfs')->where('Utilisateur', '=', Auth::user()->name)->where('MoisEnCours', '=', $request->unlockedmonth)->delete();

        $monthlocked = DB::table('infosndfs')->select('MoisEnCours')->where('Utilisateur', '=', Auth::user()->name)->where("ValidationEnCours", "=", "1")->where("MoisEnCours", "=", $request->lockedmonth)->get();
        $monthvalidated = DB::table('infosndfs')->select('MoisEnCours')->where('Utilisateur', '=', Auth::user()->name)->where("Valide", "=", "1");

        Session::flash('NDFsuppr', 'La note de frais à bien été supprimée !');

        return redirect(route("dashboard"));
    }

    public function getLockedEventPerMonth(Request $request, $month)
    {
        $months = Mois::where("mois", "=", $month);

        return $months;
    }
}
