<?php

namespace Database\Factories;

use App\Models\PhoneBook;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PhoneBook>
 */
class PhoneBookFactory extends Factory
{
    protected $model = PhoneBook::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'contact_number' => $this->faker->numerify('###########'), 
            'name' => $this->faker->name,
        ];
    }
}
