<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['book_id', 'member_id', 'user_id', 'borrow_date', 'due_date', 'return_date', 'status'])]
class Borrowing extends Model
{
    use HasFactory;

    protected $casts = [
        'borrow_date' => 'datetime',
        'due_date' => 'datetime',
        'return_date' => 'datetime',
    ];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isOverdue(): bool
    {
        return $this->status === 'borrowed' && now()->isAfter($this->due_date);
    }
}
