<?php

namespace App\Http\Controllers;

use App\Actions\CreateBook;
use App\Actions\GetBooksByRequest;
use App\Http\Requests\CommentBookRequest;
use App\Http\Requests\RateBookRequest;
use App\Http\Requests\StoreBookRequest;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request, GetBooksByRequest $getBooks)
    {
        $books = $getBooks->handle($request->query());

        return $request->expectsJson()
            ? view('books.list', compact('books'))
            : view('books.index', compact('books'));
    }

    public function show(Book $book)
    {
        $book
            ->load('comments.user')
            ->loadAvg('ratings as rating', 'value');

        return view('books.show', [
            'book' => $book,
        ]);
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(StoreBookRequest $request, CreateBook $createBook)
    {
        $createBook->handle($request->validated());

        return to_route('books.index')->with('feedback', __('The book has been created.'));
    }

    public function rate(RateBookRequest $request, Book $book)
    {
        $book->rateBy($request->user(), $request->integer('rating'));

        return back()->with('feedback', __('The book has been rated.'));
    }

    public function comment(CommentBookRequest $request, Book $book)
    {
        $book->commentBy($request->user(), $request->input('body'));

        return back()->with('feedback', __('Your comment has been published.'));
    }

    public function suggestions()
    {
        $randomBooks = Book::inRandomOrder()->limit(5)->get();

        return view('books.random-suggestions', [
            'randomBooks' => $randomBooks,
        ]);
    }
}
