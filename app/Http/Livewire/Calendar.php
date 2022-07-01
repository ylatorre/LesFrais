<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Livewire\Component;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
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
    public function eventAdd($event)
    {
        //dd($event);
        Event::create($event);

        // $event->save();
        return redirect('dashboard')->with('success', 'Données enregistrées avec succès !');
    }

    public function eventChange($event)
    {
        $e = Event::find($event['id']);
        // $e->start = $event['start'];
        // if (Arr::exists($event, 'end')) {
        //     $e->end = $event['end'];
        // }

        $eventDate = substr($e->start, 0, -5);

        $e->start = $eventDate . $event['heure_debut'];
        $e->end = $eventDate . $event['heure_fin'];

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
}
