<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use Illuminate\Http\Request;
use File;

class BahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bahan = Bahan::latest()->get();
        return view ('bahan.bahan', compact('bahan'));
    }

    public function cetakBahan()
    {
        $dtBahan = Bahan::get();
        return view ('bahan.bahan-cetak', compact('dtBahan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('bahan.bahan-input');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'kode' => 'required',
            'harga' => 'required',
            'gambar' => 'file|image|mimes:jpeg,png,jpg:max:2048'
        ]);

        $gambar = $request->file('gambar');
        $nama_gambar = time()."_".$gambar->getClientOriginalName();
        $simpan_gambar = 'img_bahan';
        $gambar->move($simpan_gambar, $nama_gambar);

        Bahan::create([
            'nama' => $request->nama,
            'kode' => $request->kode,
            'harga' => $request->harga,
            'gambar' =>  $nama_gambar
        ]);
        return redirect('/home/bahan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bahan = Bahan::findorfail($id);
        return view ('bahan.bahan-edit', compact('bahan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required',
            'kode' => 'required',
            'harga' => 'required',
            'gambar' => 'file|image|mimes:jpeg,png,jpg:max:2048'
        ]);

        $bahan = Bahan::find($id);
        $bahan->nama = $request->nama;
        $bahan->kode = $request->kode;
        $bahan->harga = $request->harga;

        if($request->hasfile('gambar')) {
            File::delete('img_bahan/'.$produk->gambar);
            $gambar = $request->file('gambar');
            $nama_gambar = time()."_".$gambar->getClientOriginalName();
            $simpan_gambar = 'img_bahan';
            $gambar->move($simpan_gambar, $nama_gambar); 
            $bahan->gambar = $nama_gambar;
        }

        $bahan->save();
        return redirect('/home/bahan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // hapus file
        $bahan = Bahan::find($id);
        File::delete('img_bahan/'.$bahan->gambar);
      
        // hapus data
        $bahan->delete();
        return back();
    }
}
