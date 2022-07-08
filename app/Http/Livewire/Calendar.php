<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Validator;
use App\Models\Event;
use Livewire\Component;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

class Calendar extends Component
{
    public $events = [];
    public function render()
    {
        //        $this->events = json_encode(Event::all());
        $this->events = json_encode(Event::where("idUser", "=", Auth::user()->id)->get());
        //        dd($this->events);
        Calendar::checkAndDeleteDuplicates();
        return view('livewire.calendar');
    }

    public function checkAndDeleteDuplicates(){
        $events = DB::table('events')->orderBy('start', 'desc')->get();
        for($i = 0; $i < count($events)-1; $i++){
            if($events[$i]->start == $events[$i + 1]->start){
                $e = Event::find($events[$i +1]->id);
                $e->delete();
            };
        };
    }

    public function checkEvent($event){
        // dd($event);
        $requirement = [
            'description' => 'required',
            'title' => 'required',
            'ville' => 'required',
            'code_postal' => 'required',
            'peage' => 'required',
            'parking' => 'required',
            'divers' => 'required',
            'repas' => 'required',
            'essence' => 'required',
            'hotel' => 'required',
            'kilometrage' => 'required',
            'heure_debut' => 'required',
            'heure_fin' => 'required',
        ];

        $errors = [];

        $events = Event::where("start", '=', $event['start'])->get();


        $validator = Validator::make($event, $requirement);

        if ($validator->fails() || count($events)) {
            if(count($events)){
                array_push($errors, "duplicate");
            };

            $fail = $validator->failed();
            $keys = array_keys($fail);
            foreach ($keys as $key) {
                array_push($errors, $key);
            };

            return $errors;
        }
    }

    public function eventAdd($event) {
        Event::create($event);

        // $event->save();
        return redirect('dashboard')->with('success', 'Données enregistrées avec succès !');
    }

    public function eventChange($event) {
        $e = Event::find($event['id']);

        $e->start = $event['start'];
        $e->end = $event['end'];

        $e->description = $event['description'];
        $e->title = $event['title'];
        $e->ville = $event['ville'];
        $e->code_postal = $event['code_postal'];
        $e->peage = $event['peage'];
        $e->parking = $event['parking'];
        $e->divers = $event['divers'];
        $e->repas = $event['repas'];
        $e->essence = $event['essence'];
        $e->hotel = $event['hotel'];
        $e->kilometrage = $event['kilometrage'];
        $e->heure_debut = $event['heure_debut'];
        $e->heure_fin = $event['heure_fin'];
        $e->save();
        return redirect('dashboard')->with('success', 'Données modifiées avec succès !');
    }
    public function dateChange($id, $startDate){
        $e = Event::find($id);
        $e->start = $startDate;
        $e->end = $startDate;
        $e->save();
    }
    public function suppressEvent($id)
    {
        $e = Event::find($id);

        $e->delete();
        return redirect('dashboard')->with('success', 'Données supprimées avec succès !');
    }
}
