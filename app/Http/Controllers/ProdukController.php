<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use File;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = Produk::latest()->get();
        return view ('produk.produk', compact('produk'));
    }

    public function cetakProduk()
    {
        $dtProduk = Produk::get();
        return view ('produk.produk-cetak', compact('dtProduk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('produk.produk-input');
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
        $simpan_gambar = 'img_produk';
        $gambar->move($simpan_gambar, $nama_gambar);

        Produk::create([
            'nama' => $request->nama,
            'kode' => $request->kode,
            'harga' => $request->harga,
            'gambar' =>  $nama_gambar
        ]);
        return redirect('/home/produk');
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
        $produk = Produk::findorfail($id);
        return view ('produk.produk-edit', compact('produk'));
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

        $produk = Produk::find($id);
        $produk->nama = $request->nama;
        $produk->kode = $request->kode;
        $produk->harga = $request->harga;

        if($request->hasfile('gambar')) {
            File::delete('img_produk/'.$produk->gambar);
            $gambar = $request->file('gambar');
            $nama_gambar = time()."_".$gambar->getClientOriginalName();
            $simpan_gambar = 'img_produk';
            $gambar->move($simpan_gambar, $nama_gambar); 
            $produk->gambar = $nama_gambar;
        }

        $produk->save();
        return redirect('/home/produk');
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
        $produk = Produk::find($id);
        File::delete('img_produk/'.$produk->gambar);
      
        // hapus data
        $produk->delete();
        return back();  
    }
}
