<?php

namespace App\Http\Controllers;

use App\Models\Mois;
use App\Models\Event;
use App\Models\infosndf;
use App\Models\Mois_valide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MoisController extends Controller
{



    public function lockMonth(Request $request)
    {
        /***  - si on clique sur soumetre le mois, il n'est plus modifiable ***/
        // dd($request);


        $events = DB::table('users')->RightJoin("events", "events.idUser", "users.id")->where("idUser", "=", Auth::user()->id)->where("mois", "=", $request->lockedmonth)->get();

        $chFiscaux = DB::table('users')->select('chevauxFiscaux')->where('name', '=', Auth::user()->name)->get();
        $NBevents = DB::table('events')->where('mois', '=', $request->lockedmonth)->where('idUser', '=', Auth::user()->id)->get();

        /* - Quand on clique sur soumetre la note de frais, cela créer une note de frais et la vérouille*/

        $infosNDF = DB::table('infosndfs')->where('Utilisateur', '=', Auth::user()->name)->where('MoisEnCours', '=', $request->lockedmonth)->get();


        if (count($infosNDF) == 0 /*&& Auth::user()->admin == 0*/) {
            infosndf::create([
                "Utilisateur" => Auth::user()->name,
                "MoisEnCours" => $request->lockedmonth,
                "NombreEvenement" => count($NBevents),
                "Valide" => 0,
                "ChevauxFiscaux" => $chFiscaux[0]->chevauxFiscaux,
                "tauxKM" => Auth::user()->taux,
            ]);
         }//elseif(count($infosNDF) == 0 && Auth::user()->admin ==1) {
        //     infosndf::create([
        //         "Utilisateur" => Auth::user()->name,
        //         "MoisEnCours" => $request->lockedmonth,
        //         "NombreEvenement" => count($NBevents),
        //         "Valide" => 1,
        //         "ChevauxFiscaux" => $chFiscaux[0]->chevauxFiscaux,
        //     ]);
        // }


        /* - Si la note de frais à deja été créée alors ca la vérouille juste */

        DB::table('infosndfs')->where('Utilisateur', '=', Auth::user()->name)->where('MoisEnCours', '=', $request->lockedmonth)->update(["ValidationEnCours" => 1]);
        $NDFusers = DB::table('infosndfs')->where('Utilisateur', '=', Auth::user()->name)->get();
        $monthlocked = DB::table('infosndfs')->select('MoisEnCours')->where('Utilisateur','=', Auth::user()->name)->where("ValidationEnCours","=","1")->where("MoisEnCours","=", $request->lockedmonth)->get();
        $monthvalidated = DB::table('infosndfs')->select('MoisEnCours')->where('Utilisateur','=', Auth::user()->name)->where("Valide","=","1");


        return redirect(route('dashboard'));
        // dd($events);
    }
    public function unlockMonth(Request $request)
    {
        DB::table('infosndfs')->where('Utilisateur','=',Auth::user()->name)->where('MoisEnCours', '=', $request->unlockedmonth)->update(["ValidationEnCours" => 0]);

        $monthlocked = DB::table('infosndfs')->select('MoisEnCours')->where('Utilisateur','=', Auth::user()->name)->where("ValidationEnCours","=","1")->where("MoisEnCours","=", $request->lockedmonth)->get();
        $monthvalidated = DB::table('infosndfs')->select('MoisEnCours')->where('Utilisateur','=', Auth::user()->name)->where("Valide","=","1");

        return redirect(route("dashboard"));
    }

    public function getLockedEventPerMonth(Request $request, $month)
    {
        $months = Mois::where("mois", "=", $month);

        return $months;
    }
}
