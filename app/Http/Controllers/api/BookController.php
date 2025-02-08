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
     * Summary of store
     * @param \App\Http\Requests\api\CreateBookRequest $createBookRequest
     * @return mixed|\Illuminate\Http\JsonResponse
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
     * Summary of update
     * @param \App\Http\Requests\api\CreateBookRequest $createBookRequest
     * @param string $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function update(CreateBookRequest $createBookRequest, string $id)
    {
        try {
            $book = Book::findOrFail($id);
            $book->title =  $createBookRequest->title;
            $book->stock = $createBookRequest->stock;
            $book->book_category_id= $createBookRequest->book_category_id;
            $book->save();
            return ResponseHelper::success('Update Success', 200, $book);
        } catch (\Throwable $th) {
            return ResponseHelper::error('Update Data Failed', $th->getCode(), $th->getMessage());
        }
    }

    /**
     * Summary of destroy
     * @param string $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
        try {
            $book = Book::findOrFail($id);

            $book->delete();
            return ResponseHelper::success('Delete Success', 200, null);
        } catch (\Throwable $th) {
            //throw $th;
            return ResponseHelper::error('Delete Data Failed', $th->getCode(), $th->getMessage());

        }
    }
}
