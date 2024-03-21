<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $government = Category::where([
            ['name', '=', 'government'],
            ['is_educational', '=', true]
        ])->first();
        SubCategory::create([
            'name' => 'Primary education',
            'category_id' => $government->id
        ]);

        SubCategory::create([
            'name' => 'Secondary education',
            'category_id' => $government->id
        ]);

        SubCategory::create([
            'name' => 'General secondary education',
            'category_id' => $government->id
        ]);

        $azhary = Category::where([
            ['name', '=', 'azhary'],
            ['is_educational', '=', true]
        ])->first();

        SubCategory::create([
            'name' => 'Primary education',
            'category_id' => $azhary->id
        ]);

        SubCategory::create([
            'name' => 'Secondary education',
            'category_id' => $azhary->id
        ]);

        SubCategory::create([
            'name' => 'Secondary education azhary',
            'category_id' => $azhary->id
        ]);
    }
}
