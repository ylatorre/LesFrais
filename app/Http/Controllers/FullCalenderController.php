<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;

use App\Models\Missions;

class FullCalenderController extends Controller
{
   public function index(Request $request)
   {

   }


   public function create()
   {
     return view('mission.create');
   }

   public function store(Request $request)
   {


 $this->validate($request,[

  'description'=>'required',
  'client'=>'required',
  'ville'=>'required',
  'code_postal'=>'required',
  'peage'=>'required',
  'parking'=>'required',
  'divers'=>'required',
  'repas'=>'required',
  'hotel'=>'required',
  'kilometrage'=>'required',

 ]);
 $mission = new Missions;
 $mission->description=$request->input('description');
 $mission->client=$request->input('client');
 $mission->ville=$request->input('ville');
 $mission->code_postal=$request->input('code_postal');
 $mission->peage=$request->input('peage');
 $mission->parking=$request->input('parking');
 $mission->divers=$request->input('divers');
 $mission->repas=$request->input('repas');
 $mission->hotel=$request->input('hotel');
 $mission->kilometrage=$request->input('kilometrage');

 $mission->save();
 return redirect('dashboard')->with('success','Données enregistrées avec succès !');

   }
}
