<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Models\Book;
use App\Models\Category;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->paginate(10);
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    public function store(BookStoreRequest $request)
    {
        Book::create(array_merge($request->validated(), [
            'available_stock' => $request->stock,
        ]));
        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    public function update(BookUpdateRequest $request, Book $book)
    {
        $data = $request->validated();
        $oldStock = $book->stock;
        $newStock = $data['stock'];
        $diff = $newStock - $oldStock;
        $newAvailableStock = $book->available_stock + $diff;

        if ($newAvailableStock < 0) {
            return back()->withErrors(['stock' => 'Stok tidak dapat dikurangi di bawah peminjaman aktif.']);
        }
        
        $book->update(array_merge($data, [
            'available_stock' => $newAvailableStock,
        ]));
        
        return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus.');
    }
}
