<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\NinjaImport;
use App\Models\Ninja;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class NinjaController extends Controller
{

    public function index()
    {
        $ninja = Ninja::all();
        return view('admin.3PL.ninja', compact('ninja'));
    }
    public function importExcel(Request $request)
    {
        // $request->validate([
        //     'file' => 'required|mimes:xlsx,xls',
        // ]);

        $file = $request->file('file');
        // dd($request->file('file'));
        // Proses import
        Excel::import(new NinjaImport, $file);

        return redirect()->back()->with('success', 'Data berhasil diimpor.');
    }

}
