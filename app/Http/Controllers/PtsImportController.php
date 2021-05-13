<?php

namespace App\Http\Controllers;
use Orchid\Support\Facades\Toast;

use App\Imports\PtsImport;
use Maatwebsite\Excel\Facades\Excel;

class PtsImportController extends Controller
{
    public function import()
    {
        Excel::import(new PtsImport, request()->file('your_file'));
        return redirect('/admin')->with('success', 'All good!');
    }
}