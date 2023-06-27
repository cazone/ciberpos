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
            'name'=> 'Dulces',
        ]);
        Category::create([
            'id'=> 2,
            'name'=> 'Papeleria',
        ]);
        Category::create([
            'id'=> 3,
            'name'=> 'Merceria',
        ]);
        Category::create([
            'id'=> 4,
            'name'=> 'Regalos',
        ]);
        Category::create([
            'id'=> 5,
            'name'=> 'Copias',
        ]);
        Category::create([
            'id'=> 6,
            'name'=> 'Cuadernos',
        ]);
        Category::create([
            'id'=> 7,
            'name'=> 'Sin Categoria',
        ]);
        Category::create([
            'id'=> 8,
            'name'=> 'Servicios',
        ]);
    }
}
