<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $author = Author::all();

        return Response::create($author);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $author = Author::create($request->all());

        return Response::create($author);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($authorName)
    {
        $author = Author::where('name', $authorName)->first();
        if (!$author) {
            return Response::create(["message" => "Author Not Found"], 400);
        }

        return Response::create($author);
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
        $author = Author::find($id);
        if (!$author) {
            return Response::create(["message" => "Author Not Found"], 400);
        }

        $author->update($request->all());

        return Response::create($author);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $author = Author::find($id);
        if (!$author) {
            return Response::create(["message" => "Author Not Found"], 400);
        }

        Author::destroy($id);

        return Response::create(["message" => "success"]);
    }
}
