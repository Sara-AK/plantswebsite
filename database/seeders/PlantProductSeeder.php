<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PlantProduct;

class PlantProductSeeder extends Seeder
{
    public function run()
    {
        PlantProduct::create([
            'name' => 'Aloe Vera',
            'description' => 'A succulent plant species known for its healing properties.',
            'price' => 9.99,
            'picture' => 'uploads/aloe_vera.jpg', // This should be a valid path
        ]);

        PlantProduct::create([
            'name' => 'Bamboo Palm',
            'description' => 'A great indoor plant for air purification.',
            'price' => 25.00,
            'picture' => 'uploads/bamboo_palm.jpg', // Replace with actual path
        ]);
    }
}
