<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    public function index(Request $request){
        $search_query = $request->input('query');
        $categoryData = DB::table('categories');
       // $categoryData = DB::table('categories')->orderBy('CategoryID', 'asc')->paginate(5);
        if ($search_query) {
            $categoryData = DB::table('categories')
                    ->where('BusinessCategory', 'LIKE', '%' . $search_query . '%')
                    ->orWhere('master', 'LIKE', '%' . $search_query . '%');
            }
        $categoryData = $categoryData->orderBy('CategoryID', 'asc')->paginate(5);
        return view('admin.category.index',compact('categoryData'));
    }
    public function create()
    {
        return view('admin.category.create');
    }
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'categoryName' => 'required|string|max:255|unique:categories,BusinessCategory',
            'master' => 'in:0,1',
        ]);

        // Create the category
       $create =  DB::table('categories')->insert([
            'BusinessCategory' => $request->categoryName,
            'master' => $request->master,
            'created_at' => now(), 
            'updated_at' => now(),
        ]);

        if ($create) {
            return redirect()->route('categories')->with('success', 'Category create successfully!');
        } else {
            return redirect()->route('categories')->with('error', 'There are some error for create category.');
        }
    }
    public function editCategory($id){
        $categoryData = DB::table('categories')->where('CategoryID', $id)->first();
        if (!$categoryData) {
            return redirect()->route('categories.index')->with('error', 'Category not found');
        }
        return view('admin.category.edit',compact('categoryData'));

    }
    public function updateCategory(Request $request,$id){
        $validated = $request->validate([
            'categoryName' => 'required|string|max:255',
            'master' => 'in:0,1',
        ]);
        $updated = DB::table('categories')
        ->where('CategoryID', $id)
        ->update([
            'BusinessCategory' => $validated['categoryName'],
            'master' => $request->master, 
            'updated_at' => now()
        ]);

        if ($updated) {
            return redirect()->route('categories')->with('success', 'Category updated successfully!');
        } else {
            return redirect()->route('categories')->with('error', 'Category not found or no changes made.');
        }
    }
    public function destroy($id)
    {
        // Attempt to delete the category
        $deleted = DB::table('categories')->where('CategoryID', $id)->delete();

        if ($deleted) {
            return redirect()->route('categories')->with('success', 'Category deleted successfully!');
        } else {
            return redirect()->route('categories')->with('error', 'Category not found.');
        }
    }
}
