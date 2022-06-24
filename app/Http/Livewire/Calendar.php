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
        return redirect('dashboard')->with('success', 'Données enregistrées avec succès !');
    }

    public function eventChange($event)
    {
        $e = Event::find($event['id']);
        $e->start = $event['start'];
        if (Arr::exists($event, 'end')) {
            $e->end = $event['end'];
        }
        $e->save();
    }
    public function eventRemove($id)
    {
        Event::destroy($id);
    }
}
