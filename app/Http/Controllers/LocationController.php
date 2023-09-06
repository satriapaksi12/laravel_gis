<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Location::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="btn btn-primary btn-sm">Edit</a>';
                    $btn .= '<a href="' . $row->id . '" data-id="{{ $row->id }}" data-toggle="tooltip" data-original-title="Delete" class="btn btn-danger btn-sm deleteLokasi">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('DataLokasi');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLocationRequest $request)
    {
        Location::updateOrCreate([
            'id' => $request->id,
            'nama_siswa' => $request->nama_siswa,
            'email' => $request->email,
            'sekolah' => $request->sekolah,
            'umur' => $request->umur,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect()->route('lokasi.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocationRequest $request, Location $location)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = Location::findOrFail($id);
            $data->delete();

            return response()->json(['success' => 'Data berhasil dihapus']);
        }

        // Tangani permintaan non-Ajax (opsional)
        return redirect()->route('lokasi.index')->with('error', 'Permintaan tidak valid.');
    }
}
