<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Listing;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{
    public function index(Request $request)
    {
        $search_query = $request->input('query');

        $subcategories = SubCategory::with('category');

        if ($search_query) {
            $subcategories->where('SubCategory', 'LIKE', '%' . $search_query . '%');
        }

        $subcategories = $subcategories
            ->orderBy('SubCategory', 'asc')
            ->paginate(20);

        return view('admin.subcategories.index', compact('subcategories'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('admin.subcategories.create', compact('categories'));
    }
    public function store(Request $request)
    {

        $request->validate([
            'subCategoryName' => 'required|max:255',
        ]);

        SubCategory::create([
            'SubCategory' => $request->subCategoryName,
            'CatID' => $request->parentCategory
        ]);

        return redirect()
            ->route('sub-categories')
            ->with('success', 'Subcategory created successfully.');
    }
    public function editCategory($id)
    {
        $subCategoryData = SubCategory::where('SubCatID', $id)->first();
        $categories = Category::all();
        if (!$subCategoryData) {
            return redirect()->route('sub-categories')->with('error', 'Sub category not found');
        }
        return view('admin.subcategories.edit', compact('subCategoryData', 'categories'));
    }
    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'subCategoryName' => 'required|max:255',
        ]);
        $subcategory = SubCategory::findOrFail($id);
        $oldCategoryId = $subcategory->CatID;
        $oldSubCategoryId = $subcategory->SubCatID;

        $subcategory->update([
            'SubCategory' => $request->subCategoryName,
            'CatID' => $request->parentCategory
        ]);

        Listing::where('BusCategory', $oldCategoryId)
            ->where('SubCat', $oldSubCategoryId)
            ->update([
                'BusCategory' => $request->parentCategory,
                'BusType' => $subcategory->SubCategory,
                'SubCat' => $subcategory->SubCatID
            ]);
        DB::table('leads')
            ->where('Category', $oldCategoryId)
            ->where('SubCategory', $oldSubCategoryId)
            ->update([
                'Category' => $request->parentCategory,
                'SubCategory' => $subcategory->SubCatID
            ]);

        return redirect()->back()->with('success', 'Subcategory updated successfully');
    }
    public function destroy($id)
    {
        $subCategory = SubCategory::find($id);

        if ($subCategory) {

            $subCategory->delete();

            return redirect()
                ->route('sub-categories')
                ->with('success', 'Category deleted successfully!');
        } else {

            return redirect()
                ->route('sub-categories')
                ->with('error', 'Category not found.');
        }
    }
}
