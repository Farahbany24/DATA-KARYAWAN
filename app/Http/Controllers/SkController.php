<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Sk;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class SkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->get('nama');

        if(empty($query)){
            $allSk = Sk::with('pegawai')->get();
        }else{
            $allSk = Sk::with('pegawai')->whereHas('pegawai', function($q) use ($query){
                $q->where('nama', 'like', '%' . $query . '%');
            })->get();
        }
        return view('sk.index', compact('allSk', 'query'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pegawai = Pegawai::all();
        return view('sk.create', compact('pegawai'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedSk = $request->validate([
            'pegawai_id' => 'required',
            'skiii_a' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
            'skiii_b' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
            'skiii_c' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
            'skiii_d' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
        ]);

        if ($request->hasFile('skiii_a')) {
            $fileSka = $request->file('skiii_a');
            $namaFileSka = time() . '_' . $fileSka->getClientOriginalName();

            $validatedSk['skiii_a'] = $fileSka->storeAs('uploads/skiii_a', $namaFileSka, 'public');
        }

        if ($request->hasFile('skiii_b')) {
            $fileSkb = $request->file('skiii_b');
            $namaFileSkb = time() . '_' . $fileSkb->getClientOriginalName();

            $validatedSk['skiii_b'] = $fileSkb->storeAs('uploads/skiii_b', $namaFileSkb, 'public');
        }

        if ($request->hasFile('skiii_c')) {
            $fileSkc = $request->file('skiii_c');
            $namaFileSkc = time() . '_' . $fileSkc->getClientOriginalName();

            $validatedSk['skiii_c'] = $fileSkc->storeAs('uploads/skiii_c', $namaFileSkc, 'public');
        }

        if ($request->hasFile('skiii_d')) {
            $fileSkd = $request->file('skiii_d');
            $namaFileSkd = time() . '_' . $fileSkd->getClientOriginalName();

            $validatedSk['skiii_d'] = $fileSkd->storeAs('uploads/skiii_d', $namaFileSkd, 'public');
        }

        Sk::create($validatedSk);
        return redirect()->route('sk.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sk $sk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sk $sk)
    {
        $pegawai = Pegawai::all();
        return view('sk.edit', compact('sk', 'pegawai'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Sk $sk)
    {
        $validatedSk = $request->validate([
            'pegawai_id' => 'required',
            'skiii_a' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
            'skiii_b' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
            'skiii_c' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
            'skiii_d' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
        ]);

        if ($request->hasFile('')) {
            $fileSka = $request->file('skiii_a');
            $namaFileSka = time() . '_' . $fileSka->getClientOriginalName();
                
            if ($request->ska_lama && Storage::disk('public')->exists($request->ska_lama)) {
                Storage::disk('public')->delete($request->ska_lama);
            }

            $validatedSk['skiii_a'] = $fileSka->storeAs('uploads/skiii_a', $namaFileSka, 'public');
        }

        if ($request->hasFile('')) {
            $fileSkb = $request->file('skiii_b');
            $namaFileSkb = time() . '_' . $fileSkb->getClientOriginalName();
                
            if ($request->skb_lama && Storage::disk('public')->exists($request->skb_lama)) {
                Storage::disk('public')->delete($request->skb_lama);
            }

            $validatedSk['skiii_b'] = $fileSkb->storeAs('uploads/skiii_b', $namaFileSkb, 'public');
        }

        if ($request->hasFile('')) {
            $fileSkc = $request->file('skiii_c');
            $namaFileSkc = time() . '_' . $fileSkc->getClientOriginalName();
                
            if ($request->skc_lama && Storage::disk('public')->exists($request->skc_lama)) {
                Storage::disk('public')->delete($request->skc_lama);
            }

            $validatedSk['skiii_c'] = $fileSkc->storeAs('uploads/skiii_c', $namaFileSkc, 'public');
        }

        if ($request->hasFile('')) {
            $fileSkd = $request->file('skiii_d');
            $namaFileSkd = time() . '_' . $fileSkd->getClientOriginalName();
                
            if ($request->skd_lama && Storage::disk('public')->exists($request->skd_lama)) {
                Storage::disk('public')->delete($request->skd_lama);
            }

            $validatedSk['skiii_d'] = $fileSkd->storeAs('uploads/skiii_d', $namaFileSkd, 'public');
        }

        $sk->update($validatedSk);

        return redirect()->route('sk.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sk $sk)
    {
         $data = ['skiii_a', 'skiii_b', 'skiii_c', 'skiii_d'];
        foreach ($data as $d) {
            if ($sk->$d && Storage::exists('public/' . $sk->$d)) {
                Storage::delete('public/' . $sk->$d);
            }
        }
        $sk->delete();

        return redirect()->route('sk.index');
    }
}
