<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Contracts\Service\Attribute\Required;

class RiwayatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->get('nama');
        if (empty($query)) {
            $allRiwayat = Riwayat::with('pegawai')->get();
        } else {
            $allRiwayat = Riwayat::with('pegawai')->whereHas('pegawai', function ($q) use ($query) {
                $q->where('nama', 'like', '%' . $query . '%');
            })
                ->get();
        }
        return view('riwayat.index', compact('allRiwayat', 'query'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pegawai = Pegawai::all();
        return view('riwayat.create', compact('pegawai'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedRiwayat = $request->validate([
            'pegawai_id' => 'required',
            'sk_cpns' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
            'sk_pns' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
            'sk_jab_struktural' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
            'konversi_nip' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
        ]);

        if ($request->hasFile('sk_cpns')) {
            $fileCpns = $request->file('sk_cpns');
            $namaFileCpns = time() . '_' . $fileCpns->getClientOriginalName();

            $validatedRiwayat['sk_cpns'] = $fileCpns->storeAs('uploads/sk_cpns', $namaFileCpns, 'public');
        }

        if ($request->hasFile('sk_pns')) {
            $filePns = $request->file('sk_pns');
            $namaFilePns = time() . '_' . $filePns->getClientOriginalName();

            $validatedRiwayat['sk_pns'] = $filePns->storeAs('uploads/sk_pns', $namaFilePns, 'public');
        }

        if ($request->hasFile('sk_jab_struktural')) {
            $fileJab = $request->file('sk_jab_struktural');
            $namaFileJab = time() . '_' . $fileJab->getClientOriginalName();

            $validatedRiwayat['sk_jab_struktural'] = $fileJab->storeAs('uploads/sk_jab', $namaFileJab, 'public');
        }

        if ($request->hasFile('konversi_nip')) {
            $fileNip = $request->file('konversi_nip');
            $namaFileNip = time() . '_' . $fileNip->getClientOriginalName();

            $validatedRiwayat['konversi_nip'] = $fileNip->storeAs('uploads/konversi_nip', $namaFileNip, 'public');
        }

        Riwayat::create($validatedRiwayat);
        return redirect()->route('riwayat.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Riwayat $riwayat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Riwayat $riwayat)
    {
        $pegawai = Pegawai::all();
        return view('riwayat.edit', compact('riwayat', 'pegawai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Riwayat $riwayat)
    {
        $validatedRiwayat = $request->validate([
            'pegawai_id' => 'required',
            'sk_cpns' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
            'sk_pns' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
            'sk_jab_struktural' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
            'konversi_nip' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
        ]);

        if ($request->hasFile('sk_cpns')) {
            $fileCpns = $request->file('sk_cpns');
            $namaFileCpns = time() . '_' . $fileCpns->getClientOriginalName();

            if ($request->sk_cpns_lama && Storage::disk('public')->exists($request->sk_cpns_lama)) {
                Storage::disk('public')->delete($request->sk_cpns_lama);
            }

            $validatedRiwayat['sk_cpns'] = $fileCpns->storeAs('uploads/sk_cpns', $namaFileCpns, 'public');
        }

        if ($request->hasFile('sk_pns')) {
            $filePns = $request->file('sk_pns');
            $namaFilePns = time() . '_' . $filePns->getClientOriginalName();

            if ($request->sk_pns_lama && Storage::disk('public')->exists($request->sk_pns_lama)) {
                Storage::disk('public')->delete($request->sk_pns_lama);
            }

            $validatedRiwayat['sk_pns'] = $filePns->storeAs('uploads/sk_pns', $namaFilePns, 'public');
        }

        if ($request->hasFile('sk_jab_struktural')) {
            $fileJab = $request->file('sk_jab_struktural');
            $namaFileJab = time() . '_' . $fileJab->getClientOriginalName();

            if ($request->sk_jab_struktural_lama && Storage::disk('public')->exists($request->sk_jab_struktural_lama)) {
                Storage::disk('public')->delete($request->sk_jab_struktural_lama);
            }

            $validatedRiwayat['sk_jab_struktural'] = $fileJab->storeAs('uploads/sk_jab', $namaFileJab, 'public');
        }

        if ($request->hasFile('konversi_nip')) {
            $fileNip = $request->file('konversi_nip');
            $namaFileNip = time() . '_' . $fileNip->getClientOriginalName();

            if ($request->konversi_nip_lama && Storage::disk('public')->exists($request->konversi_nip_lama)) {
                Storage::disk('public')->delete($request->konversi_nip_lama);
            }

            $validatedRiwayat['konversi_nip'] = $fileNip->storeAs('uploads/konversi_nip', $namaFileNip, 'public');
        }
        $riwayat->update($validatedRiwayat);

        return redirect()->route('riwayat.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Riwayat $riwayat)
    {
        $data = ['sk_cpns', 'sk_pns', 'sk_jab_struktural', 'konversi_nip'];
        foreach ($data as $d) {
            if ($riwayat->$d && Storage::exists('public/' . $riwayat->$d)) {
                Storage::delete('public/' . $riwayat->$d);
            }
        }
        $riwayat->delete();

        return redirect()->route('riwayat.index');
    }
}
