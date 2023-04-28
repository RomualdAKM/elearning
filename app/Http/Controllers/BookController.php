<?php

namespace App\Http\Controllers;

use App\Models\book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function get_detail_book($bookName){

        $book = book::where('name',$bookName)->with('category')->first();

        return response()->json([
            'book' => $book
        ],200);

    }

    public function get_books()
    {

        $books = book::all();

        return response()->json([
            'books' => $books
        ]);
    }

    public function get_books_in_level($levelId)

    {

        $booksLevel = book::orderBy('id', 'DESC')
        ->whereHas('level', function ($query) use ($levelId) {
            $query->where('id', $levelId);
        })->get();

        return response()->json([
            'booksLevel' => $booksLevel
        ], 200);
    }

    public function search_book(Request $request)
    {

        $search = $request->get('s');

            $book = book::where('name', 'LIKE', "%$search%")->with('level')->get();

            return response()->json([
                'book' => $book
            ], 200);
        }


    public function create_book(Request $request)
    {

        $this->validate(
            $request,
            ['name' => 'required',
                'file' => 'required',
                'image' => 'required']
        );

        $image = '';
        if ($request->hasFile('image')) {
            $photo = $request->file('image');
            $file_image = time() . '.' . $photo->getClientOriginalName();
            $photo->move(public_path('img'), $file_image);
            $image = 'img' . $file_image;
        }

        $pdf = '';
        if ($request->hasFile('file')) {
            $p = $request->file('file');
            $file = time() . '.' . $p->getClientOriginalName();
            $p->move(public_path('pdf'), $file);
            $pdf = 'pdf' . $file;
        }


        $book = new book();
        $book->name = $request->name;
        $book->file = $pdf;
        $book->description = $request->description;
        $book->image = $image;
        $book->category_id = $request->category_id;
        $book->level_id = $request->level_id;
        $book->save();
    }

    public function update_book(Request $request, $id)
    {

        $book = book::find($id);

        $this->validate(
            $request,
            [
                'name' => 'required',
                'file' => 'required',
                'image' => 'required'
            ]
        );

        $image = '';
        if ($request->hasFile('image')) {
            $photo = $request->file('image');
            $file_image = time() . '.' . $photo->getClientOriginalName();
            $photo->move(public_path('img'), $file_image);
            $image = 'img' . $file_image;
        }

        $pdf = '';
        if ($request->hasFile('file')) {
            $p = $request->file('file');
            $file = time() . '.' . $p->getClientOriginalName();
            $p->move(public_path('pdf'), $file);
            $pdf = 'pdf' . $file;
        }

        $book->name = $request->name;
        $book->file = $pdf;
        $book->description = $request->description;
        $book->image = $image;
        $book->category_id = $request->category_id;
        $book->level_id = $request->level_id;
        $book->save();
    }

    public function delete_book($id)
    {
        $book = book::findOrFail($id);
        $book->delete();
    }
}
