<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Skiv;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class SkivController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $query = $request->get('nama');

        if(empty($query)){
            $allSkiv = Skiv::with('pegawai')->get();
        }else{
            $allSkiv = Skiv::with('pegawai')->whereHas('pegawai', function($q) use ($query){
                $q->where('nama', 'like', '%' . $query . '%');
            })->get();
        }
        return view('skiv.index', compact('allSkiv', 'query'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pegawai = Pegawai::all();
        return view('skiv.create', compact('pegawai'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedSkiv = $request->validate([
            'pegawai_id' => 'required',
            'skiv_a' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
            'skiv_b' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
        ]);

        if ($request->hasFile('skiv_a')) {
            $fileSkiva = $request->file('skiv_a');
            $namaFileSkiva = time() . '_' . $fileSkiva->getClientOriginalName();

            $validatedSkiv['skiv_a'] = $fileSkiva->storeAs('uploads/skiv_a', $namaFileSkiva, 'public');
        }

        if ($request->hasFile('skiv_b')) {
            $fileSkivb = $request->file('skiv_b');
            $namaFileSkivb = time() . '_' . $fileSkivb->getClientOriginalName();

            $validatedSkiv['skiv_b'] = $fileSkivb->storeAs('uploads/skiv_b', $namaFileSkivb, 'public');
        }

        Skiv::create($validatedSkiv);
        return redirect()->route('skiv.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Skiv $skiv)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Skiv $skiv)
    {
        $pegawai = Pegawai::all();
        return view('skiv.edit', compact('skiv', 'pegawai'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Skiv $skiv)
    {
        $validatedSkiv = $request->validate([
            'pegawai_id' => 'required',
            'skiv_a' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
            'skiv_b' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
        ]);

        if ($request->hasFile('skiv_a')) {
            $fileSkiva = $request->file('skiv_a');
            $namaFileSkiva = time() . '_' . $fileSkiva->getClientOriginalName();

            if ($request->skiva_lama && Storage::disk('public')->exists($request->skiva_lama)) {
                Storage::disk('public')->delete($request->skiva_lama);
            }

            $validatedSkiv['skiv_a'] = $fileSkiva->storeAs('uploads/skiv_a', $namaFileSkiva, 'public');
        }

        if ($request->hasFile('skiv_b')) {
            $fileSkivb = $request->file('skiv_b');
            $namaFileSkivb = time() . '_' . $fileSkivb->getClientOriginalName();

            if ($request->skivb_lama && Storage::disk('public')->exists($request->skivb_lama)) {
                Storage::disk('public')->delete($request->skivb_lama);
            }

            $validatedSkiv['skiv_b'] = $fileSkivb->storeAs('uploads/skiv_b', $namaFileSkivb, 'public');
        }

        $skiv->update($validatedSkiv);

        return redirect()->route('skiv.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skiv $skiv)
    {
         $data = ['skiv_a', 'skiv_b'];
        foreach ($data as $d) {
            if ($skiv->$d && Storage::exists('public/' . $skiv->$d)) {
                Storage::delete('public/' . $skiv->$d);
            }
        }
        $skiv->delete();

        return redirect()->route('skiv.index');
    }
}
