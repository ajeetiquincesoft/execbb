<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buyer;

class BuyerController extends Controller
{
    public function showForm($id = null)
    {
        $data = $id ? Buyer::find($id) : null;
        // Retrieve existing data if editing
        $formData = session('form_data', $data ? $data->toArray() : []);

        return view('admin.buyer.create', compact('formData', 'id'));
    }
    public function processForm(Request $request)
    {
        dd($request->all());
        $step = $request->input('steps');
        // Save the form data to the session
        $formData = session('form_data', []);
        $formData[$step] = $request->except('step');
        session(['form_data' => $formData]);

        // Determine next step
        if ($step < 3) {
            return redirect()->route('buyer', ['steps' => $step + 1, 'id' => $request->id]);
        }

        // Handle saving the data to the database
        if ($request->id) {
            $formModel = Buyer::find($request->id);
            $formModel->update($formData);
        } else {
            Buyer::create($formData);
        }

        // Clear session data
        session()->forget('form_data');

        return redirect()->route('buyer')->with('success', 'Form submitted successfully!');
    }
}
