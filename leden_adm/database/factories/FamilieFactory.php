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
            'naam' => fake()->name(),
//             'adres' => fake()->unique()->safeEmail(),
            'adres' => Str::random(18).' '.rand(1,20),
        ];
    }
}
