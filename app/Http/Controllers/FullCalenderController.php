<?php

namespace App\Http\Controllers;

use App\Models\Event;

use App\Models\Missions;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class FullCalenderController extends Controller
{
    public function index(Request $request)
    {
    }


    public function create()
    {
        return view('mission.create');
    }

    // public function store(Request $request)
    // {

    //     // // $idUser = DB::users('id')->where('email', Auth::user()->email)->first();

    //     $this->validate($request, [

    //         'description' => 'required',
    //         'title' => 'required',
    //         'ville' => 'required',
    //         'code_postal' => 'required',
    //         'peage' => 'required',
    //         'parking' => 'required',
    //         'divers' => 'required',
    //         'repas' => 'required',
    //         'hotel' => 'required',
    //         'kilometrage' => 'required',
    //         'heureDebut' => 'required',
    //         'heureFin' => 'required',
    //     ]);


    //     $events = new Event;
    //     $events->id = Str::uuid();
    //     $events->description = $request->input('description');
    //     $events->title = $request->input('title');
    //     $events->ville = $request->input('ville');
    //     $events->code_postal = $request->input('code_postal');
    //     $events->peage = $request->input('peage');
    //     $events->parking = $request->input('parking');
    //     $events->essence = $request->input('essence');
    //     $events->divers = $request->input('divers');
    //     $events->repas = $request->input('repas');
    //     $events->hotel = $request->input('hotel');
    //     $events->kilometrage = $request->input('kilometrage');
    //     $events->heure_debut = $request->input('heureDebut');
    //     $events->heure_fin = $request->input('heureFin');
    //     $events->idUser = Auth::user()->id;
    //     $events->start = $request->input('start');
    //     $events->end = $request->input('end');
    //     $events->save();

    //     return redirect('dashboard')->with('success', 'Données enregistrées avec succès !');

    // }
}
