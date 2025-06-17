<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SignNda;

class DownloadNDAFormController extends Controller
{
    public function downloadBuyerNda()
    {
        $userId = Auth::id();
        $signNda = SignNda::where('user_id', $userId)->first();
        if (!$signNda || !$signNda->nda_pdf_path || !file_exists(public_path($signNda->nda_pdf_path))) {
            return back()->with('error', 'NDA PDF not found.');
        }

        return response()->download(public_path($signNda->nda_pdf_path));
    }
    public function downloadBuyerNdaForm($id)
    {
        $signNda = SignNda::where('user_id', $id)->first();
        if (!$signNda || !$signNda->nda_pdf_path || !file_exists(public_path($signNda->nda_pdf_path))) {
            return back()->with('error', 'NDA PDF not found.');
        }

        return response()->download(public_path($signNda->nda_pdf_path));
    }
}
