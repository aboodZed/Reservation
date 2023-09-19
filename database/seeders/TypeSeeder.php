<?php

namespace Database\Seeders;

use App\Models\SubscriptionType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubscriptionType::create([
            'cost' => 100,
            'month' => 4
        ]);

        SubscriptionType::create([
            'cost' => 175,
            'month' => 8
        ]);

        SubscriptionType::create([
            'cost' => 250,
            'month' => 12
        ]);
    }
}
