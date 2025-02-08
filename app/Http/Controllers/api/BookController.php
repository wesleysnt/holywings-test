<?php

namespace App\Http\Controllers\api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\CreateBookRequest;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateBookRequest $createBookRequest)
    {
        try {
            $book = new Book;
            $book = Book::make([
                'title'=>$createBookRequest->title,
                'stock'=>$createBookRequest->stock,
                'book_category_id'=>$createBookRequest->book_category_id,
            ]);
            $book->save();
            return ResponseHelper::success('Book Created', 201, $book);
        } catch (\Throwable $th) {
            //throw $th;
            return ResponseHelper::error('Failed to Create Book', 500, null);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
