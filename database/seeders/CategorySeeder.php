<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Fiksi', 'description' => 'Novel dan cerita fiksi'],
            ['name' => 'Non-Fiksi', 'description' => 'Buku faktual dan informatif'],
            ['name' => 'Sains', 'description' => 'Buku tentang ilmu pengetahuan'],
            ['name' => 'Teknologi', 'description' => 'Buku tentang teknologi dan komputer'],
            ['name' => 'Sejarah', 'description' => 'Buku tentang sejarah dan peradaban'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
