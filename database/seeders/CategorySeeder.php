<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'id'=> 1,
            'name_category'=> 'Dulces',
        ]);
        Category::create([
            'id'=> 2,
            'name_category'=> 'Papeleria',
        ]);
        Category::create([
            'id'=> 3,
            'name_category'=> 'Merceria',
        ]);
        Category::create([
            'id'=> 4,
            'name_category'=> 'Regalos',
        ]);
        Category::create([
            'id'=> 5,
            'name_category'=> 'Copias',
        ]);
        Category::create([
            'id'=> 6,
            'name_category'=> 'Cuadernos',
        ]);
        Category::create([
            'id'=> 7,
            'name_category'=> 'Sin Categoria',
        ]);
        Category::create([
            'id'=> 8,
            'name_category'=> 'Servicios',
        ]);
    }
}
