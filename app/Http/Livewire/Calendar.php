<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Validator;
use App\Models\Event;
use Livewire\Component;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
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
        return view('livewire.calendar');
    }

    public function checkEvent($event){
        // dd($inputData);
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

        $validator = Validator::make($event, $requirement);

        if ($validator->fails()) {
            $fail = $validator->failed();
            $keys = array_keys($fail);
            $errors = [];
            foreach ($keys as $key) {
                array_push($errors, $key);
            };

            return $errors;
        }
    }

    public function eventAdd($event)
    {



        //dd($event);
        Event::create($event);

        // $event->save();
        return redirect('dashboard')->with('success', 'Données enregistrées avec succès !');
    }

    public function eventChange($event, $eventDate)
    {
        $e = Event::find($event['id']);
        // $e->start = $event['start'];
        // if (Arr::exists($event, 'end')) {
        //     $e->end = $event['end'];
        // }

        // $eventDate;
        // dd($event);
        $e->start = $eventDate;
        $e->end = $eventDate;

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
