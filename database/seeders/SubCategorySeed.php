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
            ['name', '=', 'عام'],
            ['is_educational', '=', true]
        ])->first();
        SubCategory::create([
            'name' => 'الصف الاول الابتدائي',
            'category_id' => $government->id
        ]);

        SubCategory::create([
            'name' => 'الصف الثاني الابتدائي',
            'category_id' => $government->id
        ]);

        SubCategory::create([
            'name' => 'الصف الثالث الابتدائي',
            'category_id' => $government->id
        ]);

        SubCategory::create([
            'name' => 'الصف الرابع الابتدائي',
            'category_id' => $government->id
        ]);
        SubCategory::create([
            'name' => 'الصف الخامس الابتدائي',
            'category_id' => $government->id
        ]);

        SubCategory::create([
            'name' => 'الصف السادس الابتدائي',
            'category_id' => $government->id
        ]);
        SubCategory::create([
            'name' => 'الصف الاول الاعدادي',
            'category_id' => $government->id
        ]);

        SubCategory::create([
            'name' => 'الصف الثاني الاعدادي',
            'category_id' => $government->id
        ]);

        SubCategory::create([
            'name' => 'الصف الثالث الاعدادي',
            'category_id' => $government->id
        ]);

        SubCategory::create([
            'name' => 'الصف الاول الثانوي',
            'category_id' => $government->id
        ]);

        SubCategory::create([
            'name' => 'الصف الثاني الثانوي',
            'category_id' => $government->id
        ]);

        SubCategory::create([
            'name' => 'الصف الثالث الثانوي',
            'category_id' => $government->id
        ]);
        // $azhary = Category::where([
        //     ['name', '=', 'azhary'],
        //     ['is_educational', '=', true]
        // ])->first();

        // SubCategory::create([
        //     'name' => 'Primary education',
        //     'category_id' => $azhary->id
        // ]);

        // SubCategory::create([
        //     'name' => 'Secondary education',
        //     'category_id' => $azhary->id
        // ]);

        // SubCategory::create([
        //     'name' => 'Secondary education azhary',
        //     'category_id' => $azhary->id
        // ]);
    }
}
