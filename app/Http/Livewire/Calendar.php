<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class Calendar extends Component
{
    public $events = [];
    public function render()
    {
//        $this->events = json_encode(Event::all());
        $this->events = json_encode(Event::where("idUser" ,"=",Auth::user()->id)->get());
        return view('livewire.calendar');
    }
    public function eventAdd($event)
    {
//        dd($event);

        Event::create($event);

    }
}

