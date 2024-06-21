<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PhoneBook;

class PhoneBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PhoneBook::factory(10)->create();
    }
}
