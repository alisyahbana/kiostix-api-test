<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use App\Author;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();

        return Response::create($books);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book = Book::create($request->all());

        return Response::create($book);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);
        if (!$book) {
            return Response::create(["message" => "Book Not Found"], 400);
        }

        return Response::create($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        if (!$book) {
            return Response::create(["message" => "book Not Found"], 400);
        }

        $book->update($request->all());

        return Response::create($book);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        if (!$book) {
            return Response::create(["message" => "Book Not Found"], 400);
        }

        Book::destroy($id);

        return Response::create(["message" => "success"]);
    }

    public function getBooksByTitle(Request $request)
    {
        $title = $request->title;
        if (!$title) {
            return Response::create(["message" => "title required"], 400);
        }

        $books = Book::where('title', '=', $title)->get();

        if (!$books) {
            return Response::create(["message" => "books not found"], 400);
        }

        return $books;
    }

    public function getBooksByCategory(Request $request)
    {
        $categoryName = $request->name;
        if (!$categoryName) {
            return Response::create(["message" => "name required"], 400);
        }

        $category = Category::where('name', $categoryName)->first();
        if (!$category) {
            return Response::create(["message" => "Categroy Not Found"], 400);
        }

        $books = Book::select(['books.*', 'authors.name as author_name'])
            ->join('categories', 'categories.id', '=', 'books.category_id')
            ->join('authors', 'authors.id', '=', 'books.author_id')
            ->where('categories.id', '=', $category->id)
            ->get();
        return $books;
    }

    public function getBooksByAuthor(Request $request)
    {
        $authorName = $request->name;
        if (!$authorName) {
            return Response::create(["message" => "name required"], 400);
        }

        $author = Author::where('name', $authorName)->first();
        if (!$author) {
            return Response::create(["message" => "Author Not Found"], 400);
        }

        $books = Book::select(['books.*'])
            ->join('authors', 'authors.id', '=', 'books.author_id')
            ->where('authors.id', '=', $author->id)
            ->get();
        return $books;
    }
}
