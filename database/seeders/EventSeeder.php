<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Event::insert([
            [
                'id' => Str::uuid(),
                'start' => '2022-04-02',
                'end' => null,
                'client' => "Bonjour",
                'ville' => 'Lyon',
                'code_postal' => "68456748",
                'peage' => null,
                'parking' => null,
                'divers' => null,
                'repas' => null,
                'hotel' => null,
                'kilometrage' => '20',
            ],

        ]);

    }
}
