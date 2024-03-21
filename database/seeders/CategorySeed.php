<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'arts & entertainment',
            'is_educational' => false
        ]);
        Category::create([
            'name' => 'fiction & literature',
            'is_educational' => false
        ]);
        Category::create([
            'name' => 'biograpgies & memoirs',
            'is_educational' => false
        ]);
        Category::create([
            'name' => 'business & investing',
            'is_educational' => false
        ]);
        Category::create([
            'name' => 'children\'s books',
            'is_educational' => false
        ]);
        Category::create([
            'name' => 'computers & technology',
            'is_educational' => false
        ]);
        Category::create([
            'name' => 'cooking, food',
            'is_educational' => false
        ]);
        Category::create([
            'name' => 'health,mind & body',
            'is_educational' => false
        ]);
        Category::create([
            'name' => 'history',
            'is_educational' => false
        ]);
        Category::create([
            'name' => 'home & garden',
            'is_educational' => false
        ]);

        Category::create([
            'name' => 'mystery & thrillers',
            'is_educational' => false
        ]);

        Category::create([
            'name' => 'parenting & families',
            'is_educational' => false
        ]);
        Category::create([
            'name' => 'sience fiction & fantasy',
            'is_educational' => false
        ]);
        Category::create([
            'name' => 'sport',
            'is_educational' => false
        ]);
        Category::create([
            'name' => 'self-help',
            'is_educational' => false
        ]);
        Category::create([
            'name' => 'travel',
            'is_educational' => false
        ]);

        /// educational categories

        Category::create([
            'name' => 'government',
            'is_educational' => true
        ]);

        Category::create([
            'name' => 'azhary',
            'is_educational' => true
        ]);
    }
}
