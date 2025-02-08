<?php

namespace App\Http\Controllers\api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\CreateBookCategoryRequest;
use App\Models\BookCategory;
use Illuminate\Http\Request;

class BookCategoryController extends Controller
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
     * @param \App\Http\Requests\api\CreateBookCategoryRequest $createBookCategoryRequest
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function store(CreateBookCategoryRequest $createBookCategoryRequest)
    {
        try {
            $bookCategory = new BookCategory;
            $bookCategory->category = $createBookCategoryRequest->category;
            $bookCategory->save();
            return ResponseHelper::success('Book Category Created', 201, $bookCategory);
        } catch (\Throwable $th) {
            //throw $th;
            return ResponseHelper::error('Failed to Create Book Category', 500, null);
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
    public function update(CreateBookCategoryRequest $request, string $id)
    {
        try {
            $bookCategory = BookCategory::findOrFail($id);
            $bookCategory->category = $request->category;
            $bookCategory->save();
            return ResponseHelper::success('Update Success', 200, $bookCategory);
        } catch (\Throwable $th) {
            //throw $th;
            return ResponseHelper::error('Update Data Failed', $th->getCode(), $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
