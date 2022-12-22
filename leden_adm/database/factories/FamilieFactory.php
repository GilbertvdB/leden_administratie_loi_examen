<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Integer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Familie>
 */
class FamilieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'naam' => $this->generateRandomName(),
//             'adres' => fake()->unique()->safeEmail(),
            'adres' => $this->generateRandomAdress().' '.rand(1,20),
        ];
    }
    
    public function generateRandomName() {
        //randomName arrays
        $names = array(
            "Jansen", "De Vries", "Van den Berg", "Van Dijk", "Bakker",
            "Janssen", "Visser", "Smit", "Meijer", "Mulder", "De Jong",
            "De Groot", "De Boer", "Appels", "Peters", "Dekker", "Bos",
            "Vos", "Kok", "Hendriks", "Schouten", "Groot", "Jacobs",
            "Molenaar", "Van der Meer", "Beren", "Arnhoud"
        );
        
        // Get the total number of names in the array
        $totalNames = count($names);
        
        // Generate a random number between 0 and the total number of names - 1
//         $randomIndex = rand(0, $totalNames - 1);
        $min = 0;
        $max = $totalNames - 1;
        $randomIndex= random_int($min ,$max );
        
        // Return the random name from the array
        return $names[$randomIndex];
    }
    
    public function generateRandomAdress() {
        //randomAdress arrays
        $adress = array(
            "Esdoornstraat", "Denstraat", "Eikstraat", "Cederstraat", "Rode lariksstraat",
            "Wilgstraat", "Berkstraat", "Esdoornstraat", "Elmstraat", "Kersstraat",
            "Walnootstraat", "Citroenstraat", "Peachstraat", "Pruimstraat", "Applestraat",
            "Peerstraat", "Mangostraat", "Druifstraat", "Sinaasappelstraat", "Limoenstraat",
            "Aardbeistraat", "Framboosstraat", "Blauwe besstraat", "Bosbesstraat", "Veldbesstraat",
            "Meloenstraat", "Watermeloenstraat", "Honingdauwstraat", "Cantaloupestraat", "Ananasstraat"
        );
        
        
        // Get the total number of names in the array
        $totalAdress = count($adress);
        
        // Generate a random number between 0 and the total number of adress - 1
        $randomIndex = rand(0, $totalAdress - 1);
        
        // Return the random adress from the array
        return $adress[$randomIndex];
    }
    
}
