<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mois>
 */
class MoisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $année = strval(rand(2010, 2030));
        $mois = rand(1,12);
        if($mois < 10){
            $mois = "0" . strval($mois);
        }else{
            $mois = strval($mois);
        }
        $jour = rand(1,31);
        if($jour < 10){
            $jour = "0" . strval($jour);
        }else{
            $jour = strval($jour);
        }

        return [
            'mois' => ("2022-07"),
            'start' => ("2022-07-" . $jour ." 00:00"),
            'end' => ("2022-07-" . $jour ." 00:00"),
            'idEvent' => fake()->uuid(),
            'description' => fake()->sentence(),
            'title' => fake()->word(),
            'ville' => fake()->word(),
            'code_postal' => fake()->word(),
            'peage' => fake()->numberBetween(0, 200),
            'parking' => fake()->numberBetween(0, 200),
            'essence' => fake()->numberBetween(0, 200),
            'divers' => fake()->numberBetween(0, 200),
            'repas' => fake()->numberBetween(0, 200),
            'hotel' => fake()->numberBetween(0, 200),
            'kilometrage' => fake()->numberBetween(0, 200),
            'idUser' => rand(1,3),
            'heure_debut' => '00:00',
            'heure_fin' => '00:00',
            'est_valide' => rand(0,1),
        ];
    }
}
