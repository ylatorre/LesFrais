<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Mois;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MoisController extends Controller
{
    public function lockMonth(Request $request)
    {
        $events = DB::table('users')->RightJoin("events", "events.idUser", "users.id")->where("idUser", "=", Auth::user()->id)->where("mois", "=", $request->actualMonth)->get();
        DB::table('mois')->where('mois', "=", $request->actualMonth)->where('idUser','=', Auth::user()->id)->delete();
        foreach ($events as $event) {
            // dd($event->id);
            Mois::create([
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
        return redirect("dashboard");
        // dd($events);
    }
    public function unlockMonth(Request $request){
        // dd($request->userId);
        DB::table('mois')->where('mois', "=", $request->actualMonth)->where('idUser','=', $request->userId)->delete();
        return redirect("dashboard");
    }

    public function getLockedEventPerMonth(Request $request, $month)
    {
        $months = Mois::where("mois", "=", $month);

        return $months;
    }
}
