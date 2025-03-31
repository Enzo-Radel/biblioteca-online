<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Book::query();

        if ($search = $request->input('search')) {
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhere('isbn', 'like', "%{$search}%");
        }

        $books = $query->get();

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('books.index')->with('error', 'Acesso negado.');
        }

        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('books.index')->with('error', 'Acesso negado.');
        }

        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'isbn' => 'required|unique:books',
            'quantity' => 'required|integer',
        ]);

        Book::create($request->all());

        return redirect()->route('books.index')
                         ->with('success', 'Book created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('books.index')->with('error', 'Acesso negado.');
        }

        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('books.index')->with('error', 'Acesso negado.');
        }

        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'isbn' => 'required|unique:books,isbn,' . $book->id,
            'quantity' => 'required|integer',
        ]);

        $book->update($request->all());

        return redirect()->route('books.index')
                         ->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('books.index')->with('error', 'Acesso negado.');
        }

        $book->delete();

        return redirect()->route('books.index')
                         ->with('success', 'Book deleted successfully.');
    }

    public function reserve($book_id)
    {
        $book = Book::find($book_id);
        $user = auth()->user();

        if (!$book) {
            return redirect()->route('books.index')->with('error', 'Livro não encontrado.');
        }

        if ($user->books()->where('book_id', $book_id)->exists()) {
            return redirect()->route('books.index')->with('error', 'Você já reservou este livro.');
        }

        if ($book->quantity > 0) {
            $book->decrement('quantity');
            $user->books()->attach($book_id);
            return redirect()->route('books.index')->with('success', 'Livro reservado com sucesso.');
        } else {
            return redirect()->route('books.index')->with('error', 'Não há exemplares disponíveis para reserva.');
        }
    }

    public function cancelReservation($book_id)
    {
        $book = Book::find($book_id);
        $user = auth()->user();

        if (!$book) {
            return redirect()->route('books.index')->with('error', 'Livro não encontrado.');
        }

        if (!$user->books()->where('book_id', $book_id)->exists()) {
            return redirect()->route('books.index')->with('error', 'Você não reservou este livro.');
        }

        $book->increment('quantity');
        $user->books()->detach($book_id);

        return redirect()->route('books.index')->with('success', 'Reserva cancelada com sucesso.');
    }
}
