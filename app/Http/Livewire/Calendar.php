<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Livewire\Component;

class Calendar extends Component
{
    public $events = [];
    public function render()
    {
        $this->events = json_encode(Event::all());
        return view('livewire.calendar');
    }
}
