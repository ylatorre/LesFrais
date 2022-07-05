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

        $e->start = $eventDate . $event['extendedProps']['heure_debut'];
        $e->end = $eventDate . $event['extendedProps']['heure_fin'];

        $e->description = $event['extendedProps']['description'];
        $e->title = $event['title'];
        $e->ville = $event['extendedProps']['ville'];
        $e->code_postal = $event['extendedProps']['code_postal'];
        $e->peage = $event['extendedProps']['peage'];
        $e->parking = $event['extendedProps']['parking'];
        $e->divers = $event['extendedProps']['divers'];
        $e->repas = $event['extendedProps']['repas'];
        $e->essence = $event['extendedProps']['essence'];
        $e->hotel = $event['extendedProps']['hotel'];
        $e->kilometrage = $event['extendedProps']['kilometrage'];
        $e->heure_debut = $event['extendedProps']['heure_debut'];
        $e->heure_fin = $event['extendedProps']['heure_fin'];
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
