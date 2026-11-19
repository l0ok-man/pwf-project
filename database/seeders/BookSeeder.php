<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $fiksi = Category::where('name', 'Fiksi')->first();
        $sains = Category::where('name', 'Sains')->first();
        $teknologi = Category::where('name', 'Teknologi')->first();

        Book::create([
            'title' => 'Laskar Pelangi',
            'author' => 'Andrea Hirata',
            'isbn' => '9789793062792',
            'category_id' => $fiksi->id,
            'stock' => 5,
            'available_stock' => 5,
        ]);

        Book::create([
            'title' => 'Clean Code',
            'author' => 'Robert C. Martin',
            'isbn' => '9780132350884',
            'category_id' => $teknologi->id,
            'stock' => 3,
            'available_stock' => 3,
        ]);

        Book::create([
            'title' => 'Sapiens',
            'author' => 'Yuval Noah Harari',
            'isbn' => '9780062316097',
            'category_id' => $sains->id,
            'stock' => 4,
            'available_stock' => 4,
        ]);
    }
}
