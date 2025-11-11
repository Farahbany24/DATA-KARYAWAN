<?php

namespace App\Http\Controllers;

use App\Models\Administrasi;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Contracts\Service\Attribute\Required;

class AdministrasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->get('nama');

        if(empty($query)){
            $allAdministrasi = Administrasi::with('pegawai')->get();
        }else{
            $allAdministrasi = Administrasi::with('pegawai')->whereHas('pegawai', function($q) use ($query){
                $q->where('nama', 'like', '%' . $query . '%');
            })->get();
        }
        return view('adminis.index', compact('allAdministrasi', 'query'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pegawai = Pegawai::all();
        return view('adminis.create', compact('pegawai'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedAdministrasi = $request->validate([
            'pegawai_id' => 'required',
            'ijazah' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
            'gaji_berkala' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
            'taspen' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
        ]);

        if ($request->hasFile('ijazah')) {
            $fileIjazah = $request->file('ijazah');
            $namaFileIjazah = time() . '_' . $fileIjazah->getClientOriginalName();

            $validatedAdministrasi['ijazah'] = $fileIjazah->storeAs('uploads/ijazah', $namaFileIjazah, 'public');
        }

        if ($request->hasFile('gaji_berkala')) {
            $fileGaji = $request->file('gaji_berkala');
            $namaFileGaji = time() . '_' . $fileGaji->getClientOriginalName();

           $validatedAdministrasi['gaji_berkala'] = $fileGaji->storeAs('uploads/gaji_berkala', $namaFileGaji, 'public');
        }

        if ($request->hasFile('taspen')) {
            $fileTaspen = $request->file('taspen');
            $namaFileTaspen = time() . '_' . $fileTaspen->getClientOriginalName();

           $validatedAdministrasi['taspen'] = $fileTaspen->storeAs('uploads/taspen', $namaFileTaspen, 'public');
        }

        Administrasi::create($validatedAdministrasi);
        return redirect()->route('administrasi.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Administrasi $administrasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Administrasi $administrasi)
    {
        $pegawai = Pegawai::all();
        return view('adminis.edit', compact('administrasi', 'pegawai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Administrasi $administrasi)
    {
        $validatedAdministrasi = $request->validate([
            'pegawai_id' => 'required',
            'ijazah' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
            'gaji_berkala' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
            'taspen' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
        ]);

        if ($request->hasFile('ijazah')) {
            $fileIjazah = $request->file('ijazah');
            $namaFileIjazah = time() . '_' . $fileIjazah->getClientOriginalName();
                
            if ($request->ijazah_lama && Storage::disk('public')->exists($request->ijazah_lama)) {
                Storage::disk('public')->delete($request->ijazah_lama);
            }

            $validatedAdministrasi['ijazah'] = $fileIjazah->storeAs('uploads/ijazah', $namaFileIjazah, 'public');
        }

         if ($request->hasFile('gaji_berkala')) {
            $fileGaji = $request->file('gaji_berkala');
            $namaFileGaji = time() . '_' . $fileGaji->getClientOriginalName();

            if ($request->gaji_lama && Storage::disk('public')->exists($request->gaji_lama)) {
                Storage::disk('public')->delete($request->gaji_lama);
            }

           $validatedAdministrasi['gaji_berkala'] = $fileGaji->storeAs('uploads/gaji_berkala', $namaFileGaji, 'public');
        }

        if ($request->hasFile('taspen')) {
            $fileTaspen = $request->file('taspen');
            $namaFileTaspen = time() . '_' . $fileTaspen->getClientOriginalName();

            if ($request->taspen_lama && Storage::disk('public')->exists($request->taspen_lama)) {
                Storage::disk('public')->delete($request->taspen_lama);
            }

           $validatedAdministrasi['taspen'] = $fileTaspen->storeAs('uploads/taspen', $namaFileTaspen, 'public');
        }

        $administrasi->update($validatedAdministrasi);

        return redirect()->route('administrasi.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Administrasi $administrasi)
    {
        $data = ['ijazah', 'gaji_berkala', 'taspen'];
        foreach ($data as $d) {
            if ($administrasi->$d && Storage::exists('public/' . $administrasi->$d)) {
                Storage::delete('public/' . $administrasi->$d);
            }
        }
        $administrasi->delete();

        return redirect()->route('administrasi.index');
    }
}
