<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\OperationalExpenses;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('vessels')->insert(
            ['name' => 'Black Pearl', 'imo_number' => 'tbp202313224']);
        DB::table('vessels')->insert(
            ['name' => 'The Flying Dutch', 'imo_number' => 'tfd202398347']);
        DB::table('vessels')->insert(
            ['name' => 'Queen Anne\'s Revenge', 'imo_number' => 'qar202350748']);
    }
}
