<?php

namespace App\Http\Controllers;
use Orchid\Support\Facades\Toast;

use App\Exports\PtsExport;
use Maatwebsite\Excel\Facades\Excel;

class PtsExportController extends Controller
{
    public function export()
    {
        return Excel::download(new PtsExport, 'pts.xlsx');
    }
}