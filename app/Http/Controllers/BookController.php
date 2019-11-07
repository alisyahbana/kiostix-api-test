<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use App\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class BookController extends Controller
{
    public function index()
    {
        return Book::all();
    }

    public function getBooksByTitle(Request $request)
    {
        $title = $request->title;
        if (!$title) {
            return Response::json(["message" => "title required"], 400);
        }

        $books = Book::where('title', '=', $title)->get();

        if (!$books) {
            return Response::json(["message" => "books not found"], 400);
        }

        return $books;
    }

    public function getBooksByCategory(Request $request)
    {
        $categoryName = $request->name;
        if (!$categoryName) {
            return Response::json(["message" => "name required"], 400);
        }

        $category = Category::where('name', $categoryName)->first();
        if (!$category) {
            return Response::json(["message" => "Categroy Not Found"], 400);
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
            return Response::json(["message" => "name required"], 400);
        }

        $author = Author::where('name', $authorName)->first();
        if (!$author) {
            return Response::json(["message" => "Author Not Found"], 400);
        }

        $books = Book::select(['books.*'])
            ->join('authors', 'authors.id', '=', 'books.author_id')
            ->where('authors.id', '=', $author->id)
            ->get();
        return $books;
    }
}
