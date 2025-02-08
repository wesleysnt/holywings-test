<?php

namespace App\Http\Controllers\api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\CreateBookRentRequest;
use App\Models\BookRent;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookRentController extends Controller
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
    public function store(CreateBookRentRequest $createBookRentRequest)
    {
        try {
            $bookRent = new BookRent;
            $bookRent = BookRent::make([
                'member_id' => $createBookRentRequest->member_id,
                'book_id' => $createBookRentRequest->book_id,
                'status' => "rented",
                'due_date' => Carbon::now()->addDays(7)
            ]);
            $bookRent->save();
            return ResponseHelper::success('Book Rented', 201, $bookRent);
        } catch (\Throwable $th) {
            //throw $th;
            return ResponseHelper::error($th->getMessage(), 500, null);
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
