<?php

namespace App\Http\Controllers;

use App\Http\Requests\BorrowingRequest;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['book', 'member', 'user'])->latest()->paginate(10);
        return view('borrowings.index', compact('borrowings'));
    }

    public function create()
    {
        $books = Book::where('available_stock', '>', 0)->get();
        $members = Member::all();
        return view('borrowings.create', compact('books', 'members'));
    }

    public function store(BorrowingRequest $request)
    {
        DB::transaction(function () use ($request) {
            $book = Book::findOrFail($request->book_id);
            
            if ($book->available_stock <= 0) {
                abort(400, 'Stok buku habis.');
            }

            Borrowing::create([
                'book_id' => $book->id,
                'member_id' => $request->member_id,
                'user_id' => Auth::id(),
                'borrow_date' => now(),
                'due_date' => $request->due_date,
                'status' => 'borrowed',
            ]);

            $book->decrement('available_stock');
        });

        return redirect()->route('borrowings.index')->with('success', 'Peminjaman berhasil dicatat.');
    }

    public function returnBook(Borrowing $borrowing)
    {
        if ($borrowing->status === 'returned') {
            return back()->with('error', 'Buku sudah dikembalikan sebelumnya.');
        }

        DB::transaction(function () use ($borrowing) {
            $borrowing->update([
                'return_date' => now(),
                'status' => 'returned',
            ]);

            $borrowing->book->increment('available_stock');
        });

        return redirect()->route('borrowings.index')->with('success', 'Pengembalian buku berhasil dicatat.');
    }
}
