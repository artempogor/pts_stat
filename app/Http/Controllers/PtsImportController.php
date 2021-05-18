<?php

namespace App\Http\Controllers;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;
use App\Imports\PtsImport;
use Maatwebsite\Excel\Facades\Excel;

class PtsImportController extends Controller
{
    public function import(Request $request)
    {
        dd(request()->file('files'));
        Excel::import(new PtsImport(), request()->file('files'));
        return redirect('/')->with('success', 'All good!');
    }
}