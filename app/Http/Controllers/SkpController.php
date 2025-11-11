<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Skp;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class SkpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->get('nama');

        if (empty($query)) {
            $allSkp = Skp::with('pegawai')->get();
        } else {
            // Search menggunakan Eloquent join
            $allSkp = Skp::with('pegawai')
                ->whereHas('pegawai', function ($q) use ($query) {
                    $q->where('nama', 'like', '%' . $query . '%');
                })
                ->get();
        }

        return view('skp.index', compact('allSkp', 'query'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pegawai = Pegawai::all();
        return view('skp.create', compact('pegawai'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedSkp = $request->validate([
            'pegawai_id' => 'required',
            'tahun' => 'required|integer|min:1900|max:' . date('Y'),
            'file_skp' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
        ]);

        if ($request->hasFile('file_skp')) {
            $fileSkp = $request->file('file_skp');
            $namaFileSkp = time() . '_' . $fileSkp->getClientOriginalName();

            $validatedSkp['file_skp'] = $fileSkp->storeAs('uploads/file_skp', $namaFileSkp, 'public');
        }

        Skp::create($validatedSkp);
        return redirect()->route('skp.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Skp $skp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Skp $skp)
    {
        $pegawai = Pegawai::all();
        return view('skp.edit', compact('skp', 'pegawai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skp $skp)
    {
        $validatedSkp = $request->validate([
            'pegawai_id' => 'required',
            'tahun' => 'required|integer|min:1900|max:' . date('Y'),
            'file_skp' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
        ]);

        if ($request->hasFile('file_skp')) {
            $fileSkp = $request->file('file_skp');
            $namaFileSkp = time() . '_' . $fileSkp->getClientOriginalName();

            if ($request->skp_lama && Storage::disk('public')->exists($request->skp_lama)) {
                Storage::disk('public')->delete($request->skp_lama);
            }

            $validatedSkp['file_skp'] = $fileSkp->storeAs('uploads/file_skp', $namaFileSkp, 'public');
        }

        $skp->update($validatedSkp);

        return redirect()->route('skp.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skp $skp)
    {
        $data = ['file_skp'];
        foreach ($data as $d) {
            if ($skp->$d && Storage::exists('public/' . $skp->$d)) {
                Storage::delete('public/' . $skp->$d);
            }
        }
        $skp->delete();

        return redirect()->route('skp.index');
    }
}
