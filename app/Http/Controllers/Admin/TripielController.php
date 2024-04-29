<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Kecamatan;
use App\Models\Kurir;
use App\Models\Province;
use App\Models\Tripiel;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TripielController extends Controller
{
    // public function index()
    // {
    //     $tripiel = Tripiel::all();
    //     $province = Province::all();
    //     $city = City::all();
    //     $courier = Kurir::all();
    //     $warehouse = Warehouse::all();
    //     $kecamatan = Kecamatan::all();
    //     return view('admin.tripiel.index', compact('tripiel', 'province', 'city', 'courier', 'warehouse', 'kecamatan'));
    // }
    
        public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Tripiel::with(['province', 'city', 'courier', 'warehouse', 'kecamatan'])->select('*');
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
                                <a class="dropdown-item" id="editModalContainer" style="cursor:pointer" data-bs-toggle="modal" data-bs-target="#ModalEdit'.$row->id.'">Edit</a>
                                <a class="dropdown-item" style="cursor:pointer" data-bs-toggle="modal" data-bs-target="#ModalDelete'.$row->id.'">Delete</a>
                            </div>
                        </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        // Jika bukan permintaan Ajax, tampilkan tampilan biasa
        $province = Province::all();
        $city = City::all();
        $tripiel = Tripiel::limit(10)->get();
        $courier = Kurir::all();
        $warehouse = Warehouse::all();
        $kecamatan = Kecamatan::all();

        return view('admin.tripiel.index', compact('province', 'city', 'tripiel', 'courier', 'warehouse', 'kecamatan'));
    }

    public function store(Request $request)
    {
        
        // return response()->json($request);
        $request->validate([
            'courier_id' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'warehouse_id' => 'required',
            'cod' => 'required',

        ]);

        Tripiel::create([
            'courier_id' => $request->courier_id,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'warehouse_id' => $request->warehouse_id,
            'kecamatan_id' => $request->kecamatan_id,
            'cod' => $request->cod,
            'price' => $request->price,

        ]);

        return redirect()->route('admin.tripiel-index')->with('toast_success', 'Tripiel Berhasil Di Tambahkan');

    }
    public function update(Request $request)
    {
        $request->validate([
            'courier_id' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'warehouse_id' => 'required',
            'cod' => 'required',

        ]);

        Tripiel::where('id', $request->id)->update([
            'courier_id' => $request->courier_id,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'warehouse_id' => $request->warehouse_id,
            'kecamatan_id' => $request->kecamatan_id,
            'cod' => $request->cod,
            'price' => $request->price,

        ]);
        return redirect()->route('admin.tripiel-index')->with('toast_success', 'Tripiel Berhasil Di Ubah');
    }

    public function delete($id)
    {
        $tripiel = Tripiel::find($id);
        $tripiel->delete();
        return redirect()->route('admin.tripiel-index')->with('toast_success', 'Tripiel Berhasil Di Hapus');
    }
}
