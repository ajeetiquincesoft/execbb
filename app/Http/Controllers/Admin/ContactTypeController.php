<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactTypeController extends Controller
{
    public function index(Request $request){
        $search_query = $request->input('query');
        $contact_types = DB::table('contact_types');
        if ($search_query) {
            $contact_types = DB::table('contact_types')
                    ->where('Description', 'LIKE', '%' . $search_query . '%');
            }
        $contact_types = $contact_types->orderBy('Type', 'asc')->paginate(5);
        return view('admin.contact_type.index',compact('contact_types'));
    }
    public function create()
    {
        return view('admin.contact_type.create');
    }
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'contactType' => 'required|string|max:255|unique:contact_types,Description',
        ]);

        // Create the category
       $create =  DB::table('contact_types')->insert([
            'Description' => $request->contactType,
            'created_at' => now(), 
            'updated_at' => now(),
        ]);

        if ($create) {
            return redirect()->route('contact-type')->with('success', 'Contact type create successfully!');
        } else {
            return redirect()->route('contact-type')->with('error', 'There are some error for create category.');
        }
    }
    public function editContactType($id){
        $contact_type = DB::table('contact_types')->where('Type', $id)->first();
        if (!$contact_type) {
            return redirect()->route('contact-type')->with('error', 'Contact type not found');
        }
        return view('admin.contact_type.edit',compact('contact_type'));

    }
    public function updateContactType(Request $request,$id){
        $validated = $request->validate([
            'contactType' => 'required|string|max:255',
        ]);
        $updated = DB::table('contact_types')
        ->where('Type', $id)
        ->update([
            'Description' => $validated['contactType'],
            'updated_at' => now()
        ]);

        if ($updated) {
            return redirect()->route('contact-type')->with('success', 'Contact type updated successfully!');
        } else {
            return redirect()->route('contact-type')->with('error', 'Contact type not found or no changes made.');
        }
    }
    public function destroy($id)
    {
        // Attempt to delete the category
        $deleted = DB::table('contact_types')->where('Type', $id)->delete();

        if ($deleted) {
            return redirect()->route('contact-type')->with('success', 'Contact type deleted successfully!');
        } else {
            return redirect()->route('contact-type')->with('error', 'Contact type not found.');
        }
    }
}
