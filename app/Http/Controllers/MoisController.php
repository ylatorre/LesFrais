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


    public function validateMonth(Request $request)
    {
        $validateEventArray = explode(',', $request->valideEventID);
        foreach ($validateEventArray as $valideEventID) {
            $event = Mois::where('id', '=', $valideEventID)->first();
            if ($event == null) {
                return redirect('moderation')->with('failure', 'Il n\'y a pas d\'évenement à valider !');
            }
            Mois::where('id', '=', $valideEventID)->delete();
            Mois_valide::create([
                'mois' => $event->mois,
                'idEvent' => $event->id,
                'start' => $event->start,
                'end' => $event->end,
                'description' => $event->description,
                'title' => $event->title,
                'ville' => $event->ville,
                'code_postal' => $event->code_postal,
                'peage' => $event->peage,
                'parking' => $event->parking,
                'essence' => $event->essence,
                'divers' => $event->divers,
                'repas' => $event->repas,
                'hotel' => $event->hotel,
                'kilometrage' => $event->kilometrage,
                'idUser' => $event->idUser,
                'heure_debut' => $event->heure_debut,
                'heure_fin' => $event->heure_fin,
            ]);
        }
        return view('administration');
    }
    public function lockMonth(Request $request)
    {
        /***  - si on clique sur soumetre le mois, il n'est plus modifiable ***/
        // dd($request);
        $events = DB::table('users')->RightJoin("events", "events.idUser", "users.id")->where("idUser", "=", Auth::user()->id)->where("mois", "=", $request->lockedmonth)->get();

        $chFiscaux = DB::table('users')->select('chevauxFiscaux')->where('name', '=', Auth::user()->name)->get();
        $NBevents = DB::table('events')->where('mois', '=', $request->lockedmonth)->where('idUser', '=', Auth::user()->id)->get();

        /* - Quand on clique sur soumetre la note de frais, cela créer une note de frais et la vérouille*/

        $infosNDF = DB::table('infosndfs')->where('Utilisateur', '=', Auth::user()->name)->where('MoisEnCours', '=', $request->lockedmonth)->get();

        if (count($infosNDF) == 0) {
            infosndf::create([
                "Utilisateur" => Auth::user()->name,
                "MoisEnCours" => $request->lockedmonth,
                "NombreEvenement" => count($NBevents),
                "Valide" => 0,
                "ChevauxFiscaux" => $chFiscaux[0]->chevauxFiscaux,
            ]);
        }

        /* - Si la note de frais à deja été créee alors ca la vérouille juste */

        DB::table('infosndfs')->where('Utilisateur', '=', Auth::user()->name)->where('MoisEnCours', '=', $request->lockedmonth)->update(["ValidationEnCours" => 1]);

        return redirect("dashboard");
        // dd($events);
    }
    public function unlockMonth(Request $request)
    {


        DB::table('infosndfs')->where('Utilisateur', '=', Auth::user()->name)->where('MoisEnCours', '=', $request->unlockedmonth)->update(["ValidationEnCours" => 0]);

        return redirect("dashboard");
    }

    public function getLockedEventPerMonth(Request $request, $month)
    {
        $months = Mois::where("mois", "=", $month);

        return $months;
    }
}
