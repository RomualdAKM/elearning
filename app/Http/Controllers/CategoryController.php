<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function get_categories()
    {

        $categories = category::all();

        return response()->json([
            'categories' => $categories
        ]);
    }




    public function create_category(Request $request)
    {

        $this->validate(
            $request,
            ['name' => 'required']
        );

        $category = new category();
        $category->name = $request->name;
        $category->save();
    }

    public function update_category(Request $request, $id)
    {

        $category = category::find($id);

        $this->validate(
            $request,
            ['name' => 'required']
        );

        $category->name = $request->name;
        $category->save();
    }

    public function delete_category($id)
    {
        $category = category::findOrFail($id);
        $category->delete();
    }
}
