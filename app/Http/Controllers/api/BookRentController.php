<?php

namespace App\Http\Controllers\api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\CreateBookRentRequest;
use App\Models\Book;
use App\Models\BookRent;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class BookRentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $status = $request->query('status', '');
            $bookRent = BookRent::where('status', 'ilike', '%' . $status . '%')
                ->join('members', 'book_rents.member_id', '=', 'members.id')
                ->join('books', 'book_rents.book_id', '=', 'books.id')
                ->select('books.title', 'members.name', 'members.email', 'book_rents.created_at as rent_date', 'book_rents.status','book_rents.due_date', 'book_rents.return_date')
                ->paginate();
            return ResponseHelper::success('ok', 200, $bookRent);
        } catch (\Throwable $th) {
            return ResponseHelper::error('Failed to get list', 500, null);
        }
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
     * @param \App\Http\Requests\api\CreateBookRentRequest $createBookRentRequest
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function store(CreateBookRentRequest $createBookRentRequest)
    {
        try {
            $book = Book::findOrFail($createBookRentRequest->book_id);
            $rentedBook = BookRent::where('book_id', '=', $createBookRentRequest->book_id)->where('status', '=', 'rented')->get();

            if (count($rentedBook) >= 0) {
                if ($book->stock <= count($rentedBook)) {
                    throw new Exception("Out of Stock", 400);
                }
                $rentedBooks = array_column($rentedBook->toArray(), 'member_id');
                $found_key = array_search($createBookRentRequest->member_id, $rentedBooks);
                if ($found_key !== false) {
                    throw new Exception("This member already rented the same book", 400);
                }
            }
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

    public function return(string $id)
    {
        try {
            $bookRent = BookRent::findOrFail($id);
            $bookRent->status = "returned";
            $bookRent->return_date = Carbon::now();

            $bookRent->save();
            return ResponseHelper::success('Book Returned', 201, $bookRent);
        } catch (\Throwable $th) {
            //throw $th;
            return ResponseHelper::error($th->getMessage(), 500, null);
        }
    }
}
