<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;


class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->get('nama');

        if (empty($query)) {
            $allPegawai = Pegawai::all();
        } else {
            // Search langsung di model Pegawai
            $allPegawai = Pegawai::where('nama', 'like', '%' . $query . '%')
            ->orWhere('nip', 'like', '%' . $query . '%')
                ->get();
        }

        return view('datUm.index', compact('allPegawai', 'query'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('datUm.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $validatedPegawai = $request->validate([
            'nip' => 'required|max:255|unique:pegawais,nip,',
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'pangkat_gol' => 'required|string|max:255',
            'karpeg' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
            'karis_karsu' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
        ]);

        if ($request->hasFile('karpeg')) {
            $fileKarpeg = $request->file('karpeg');
            $namaFileKarpeg = time() . '_' . $fileKarpeg->getClientOriginalName();

            $validatedPegawai['karpeg'] = $fileKarpeg->storeAs('uploads/karpeg', $namaFileKarpeg, 'public');
        }

        if ($request->hasFile('karis_karsu')) {
            $fileKaris = $request->file('karis_karsu');
            $namaFileKaris = time() . '_' . $fileKaris->getClientOriginalName();

            $validatedPegawai['karis_karsu'] = $fileKaris->storeAs('uploads/karis_karsu', $namaFileKaris, 'public');
        }

        Pegawai::create($validatedPegawai);

        return redirect()->route('pegawai.index');
    }

    /**
     * Display the specified resource.  
     */
    public function show(Pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegawai $pegawai)
    {
        return view('datUm.edit', compact('pegawai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        $validatedPegawai = $request->validate([
            'nip' => ['required', 'max:255', Rule::unique('pegawais')->ignore($pegawai->id)],
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'pangkat_gol' => 'required|string|max:255',
            'karpeg' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
            'karis_karsu' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
        ]);

        if ($request->hasFile('karpeg')) {
            $fileKarpeg = $request->file('karpeg');
            $namaFileKarpeg = time() . '_' . $fileKarpeg->getClientOriginalName();

            if ($request->karpeg_lama && Storage::disk('public')->exists($request->karpeg_lama)) {
                Storage::disk('public')->delete($request->karpeg_lama);
            }

            $validatedPegawai['karpeg'] = $fileKarpeg->storeAs('uploads/karpeg', $namaFileKarpeg, 'public');
        }

        if ($request->hasFile('karis_karsu')) {
            $fileKaris = $request->file('karis_karsu');
            $namaFileKaris = time() . '_' . $fileKaris->getClientOriginalName();

            if ($request->karis_karsu_lama && Storage::disk('public')->exists($request->karis_karsu_lama)) {
                Storage::disk('public')->delete($request->karis_karsu_lama);
            }

            $validatedPegawai['karis_karsu'] = $fileKaris->storeAs('uploads/karis_karsu', $namaFileKaris, 'public');
        }
        $pegawai->update($validatedPegawai);

        return redirect()->route('pegawai.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai)
    {
        $data = ['karpeg', 'karis_karsu'];
        foreach ($data as $d) {
            if ($pegawai->$d && Storage::exists('public/' . $pegawai->$d)) {
                Storage::delete('public/' . $pegawai->$d);
            }
        }
        $pegawai->delete();

        return redirect()->route('pegawai.index');
    }
}
