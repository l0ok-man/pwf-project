<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BorrowingFactory extends Factory
{
    public function definition(): array
    {
        $borrowDate = fake()->dateTimeBetween('-30 days', 'now');
        
        return [
            'book_id' => Book::factory(),
            'member_id' => Member::factory(),
            'user_id' => User::factory(),
            'borrow_date' => $borrowDate,
            'due_date' => (clone $borrowDate)->modify('+7 days'),
            'return_date' => null,
            'status' => 'borrowed',
        ];
    }

    public function returned()
    {
        return $this->state(function (array $attributes) {
            $borrowDate = $attributes['borrow_date'];
            return [
                'return_date' => (clone $borrowDate)->modify('+3 days'),
                'status' => 'returned',
            ];
        });
    }
}
