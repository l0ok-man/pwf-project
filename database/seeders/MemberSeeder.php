<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        Member::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '081234567890',
            'address' => 'Jl. Contoh No. 123, Jakarta',
        ]);

        Member::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'phone' => '081234567891',
            'address' => 'Jl. Sample No. 456, Bandung',
        ]);

        Member::factory()->count(8)->create();
    }
}
