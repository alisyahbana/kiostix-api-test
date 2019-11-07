<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use App\Author;
use Illuminate\Support\Facades\Response;

class BookController extends Controller
{
    public function index()
    {
        return Book::all();
    }

    public function booksCategory($categoryName)
    {
        $category = Category::where('name', $categoryName)->first();
        if (!$category) {
            return Response::json(["message" => "Categroy Not Found"], 400);
        }

        $books = Book::select(['books.*'])
            ->join('categories', 'categories.id', '=', 'books.category_id')
            ->where('categories.id', '=', $category->id)
            ->get();
        return $books;
    }

    public function booksAuthor($authorName)
    {
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
