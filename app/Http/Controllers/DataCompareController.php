<?php

namespace App\Http\Controllers;

use App\Models\DataCompare;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DataCompareController extends Controller
{
    public function index() {
        $data = DataCompare::latest()->get();
        return view('dashboard', compact('data'));
    }

    public function preview(Request $request) {
        $data1 = collect();
        $data2 = collect();
        
        if ($request->hasFile('data_pertama') && $request->hasFile('data_kedua')) {
            $file1 = $request->file('data_pertama')->getRealPath();
            $file2 = $request->file('data_kedua')->getRealPath();
            
            $data1 = Excel::toCollection(null, $file1)->first();
            $data2 = Excel::toCollection(null, $file2)->first();
            // dd(Excel::toCollection(null, $file1)->first(), Excel::toCollection(null, $file2)->first());
        }
    
        return view('preview', compact('data1', 'data2'));
    }
}
