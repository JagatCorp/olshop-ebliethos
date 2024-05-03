<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
class KecamatanController extends Controller
{
    // public function index()
    // {
    //     $kecamatan = Kecamatan::limit(500)->get();
    //     $city = City::all();
    //     return view('admin.kecamatan.index', compact('kecamatan', 'city'));
    // }

        public function index(Request $request)
    {
        $city = City::all();


        $kecamatan = kecamatan::limit(10)->get();

        if ($request->ajax()) {
            $data = Kecamatan::with('city')->select('*'); // Menggunakan Eloquent relationship untuk mengambil data provinsi
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    return '
                    <div class="btn-group mb-1">
                        <button type="button" class="btn btn-outline-success">Action</button>
                        <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                            <span class="sr-only">Info</span>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" id="editModalContainer" style="cursor:pointer" data-bs-toggle="modal" data-bs-target="#ModalEdit'.$row->kecamatan_id.'">Edit</a>
                            <a class="dropdown-item" style="cursor:pointer" data-bs-toggle="modal" data-bs-target="#ModalDelete'.$row->kecamatan_id.'">Delete</a>
                        </div>
                    </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.kecamatan.index', compact('kecamatan', 'city'));
    }

    public function indexApi(){
        $kecamatan = kecamatan::all();
        return response()->json($kecamatan);
    }

    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required',
            'city_id' => 'required',

        ]);

        Kecamatan::create([

            'name' => $request->name,
            'city_id' => $request->city_id,

        ]);

        return redirect()->route('admin.kecamatan-index')->with('toast_success', 'Kecamatan Berhasil Di Tambahkan');

    }
    public function update(Request $request)
    {
        $request->validate([

            'name' => 'required',

        ]);

        Kecamatan::where('id', $request->id)->update([

            'name' => $request->name,
            'city_id' => $request->city_id,

        ]);
        return redirect()->route('admin.kecamatan-index')->with('toast_success', 'Kecamatan Berhasil Di Ubah');
    }

    public function delete($id)
    {
        $kecamatan = Kecamatan::find($id);
        $kecamatan->delete();
        return redirect()->route('admin.kecamatan-index')->with('toast_success', 'Kecamatan Berhasil Di Hapus');
    }
}
