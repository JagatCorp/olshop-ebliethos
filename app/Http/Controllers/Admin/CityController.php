<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Kecamatan;
use App\Models\Province;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CityController extends Controller
{
    public function indexApi()
    {
        $city = City::get();
        // $province = Province::all();
        // return view('admin.city.index', compact('city'));
        return response()->json($city);
    }
     public function index(Request $request)
    {
        $province = Province::all();
        $city = City::all();

        if ($request->ajax()) {
            $data = City::with('province')->select('*'); // Menggunakan Eloquent relationship untuk mengambil data provinsi
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
                            <a class="dropdown-item" id="editModalContainer" style="cursor:pointer" data-bs-toggle="modal" data-bs-target="#ModalEdit'.$row->city_id.'">Edit</a>
                            <a class="dropdown-item" style="cursor:pointer" data-bs-toggle="modal" data-bs-target="#ModalDelete'.$row->city_id.'">Delete</a>
                        </div>
                    </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.city.index', compact('province', 'city'));
    }
    public function fetchCities(Request $request)
    {
        // Ambil province_id dari permintaan Ajax
        $provinceId = $request->input('province_id');

        // Query untuk mendapatkan daftar kota/kabupaten berdasarkan province_id
        $cities = City::where('province_id', $provinceId)->get();

        // Return data kota/kabupaten dalam format JSON
        return response()->json($cities);
    }

        public function fetchDistrictsByCity(Request $request)
{
    // Ambil city_id dari permintaan Ajax
    $cityId = $request->input('city_id');

    // Query untuk mendapatkan daftar kecamatan berdasarkan city_id
    $districts = Kecamatan::where('city_id', $cityId)->get();

    // Return data kecamatan dalam format JSON
    return response()->json($districts);
}
    public function store(Request $request)
    {
        $request->validate([

            'province_id' => 'required',

        ]);

        City::create([

            'province_id' => $request->province_id,
            'type' => $request->type,
            'city_name' => $request->city_name,
            "postal_code" => $request->postal_code,

        ]);

        return redirect()->route('admin.city-index')->with('toast_success', 'City Berhasil Di Tambahkan');

    }
    public function update(Request $request)
    {
        $request->validate([

            'province_id' => 'required',

        ]);

        City::where('city_id', $request->city_id)->update([

            'province_id' => $request->province_id,
            'type' => $request->type,
            'city_name' => $request->city_name,
            "postal_code" => $request->postal_code,

        ]);
        return redirect()->route('admin.city-index')->with('toast_success', 'City Berhasil Di Ubah');
    }

    public function delete($id)
    {
        $city = City::find($id);
        $city->delete();
        return redirect()->route('admin.city-index')->with('toast_success', 'City Berhasil Di Hapus');
    }
}
