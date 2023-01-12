<?php

namespace App\Http\Controllers;

use App\Models\BOM;
use App\Models\BOMList;
use App\Models\Produk;
use App\Models\Bahan;
use Illuminate\Http\Request;

class BOMController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function material()
    {
        $bom = BOM::join('produk', 'bom.kode_produk', '=', 'produk.id')
            ->get(['bom.*', 'produk.nama']);
        return view('bom.bom', ['boms' => $bom]);
    }

    public function materialInput()
    {
        $produk = Produk::get();
        return view('bom.bom-input', ['products' => $produk]);
    }

    public function materialInputItems($kode_bom)
    {
        $bom = BOM::join('produk', 'bom.kode_produk', '=', 'produk.id')
            ->where('bom.kode_bom', $kode_bom)
            ->first(['bom.*', 'produk.nama','produk.harga']);
        $bomList = BOMList::join('bahan', 'bom_list.kode_bahan', '=', 'bahan.id')
            ->where('bom_list.kode_bom', $kode_bom)
            ->get(['bom_list.*', 'bahan.nama', 'bahan.harga']);
        $produk = Bahan::get();
        return view('bom.bom-input-item', ['bom' => $bom, 'materials' => $produk, 'list' => $bomList]);
    }

    public function upload(Request $request)
    {
        // $this->validate($request, [
        //     'kode_bom' => 'required',
        //     'kode_produk' => 'required',
        //     'kuantitas' => 'kuantitas',
        // ]);
        BOM::create([
            'kode_bom' => $request->kode_bom,
            'kode_produk' => $request->kode_produk,
            'kuantitas' => $request->kuantitas,
        ]);
        return redirect('/home/bom-input-item/' . $request->kode_bom);
    }

    public function uploadList(Request $request)
    {
        BOMList::create([
            'kode_bom' => $request->kode_bom,
            'kode_bahan' => $request->kode_bahan,
            'kuantitas' => $request->kuantitas,
            'satuan' => $request->satuan
        ]);
        $product = Bahan::find($request->kode_bahan);
        $harga = $product->harga;
        $bom = BOM::find($request->kode_bom);
        $harga_lama = $bom->total_harga;
        $harga_baru = $harga_lama + ($harga * $request->kuantitas);

        $bom->total_harga = $harga_baru;
        $bom->save();

        return redirect('/home/bom-input-item/' . $request->kode_bom);
    }

    public function deleteList($kode_bom_list){
        $bom_list = BOMList::find($kode_bom_list);
        $product = Bahan::find($bom_list->kode_bahan);
        $harga = $product->harga;
        $bom = BOM::find($bom_list->kode_bom);
        $harga_lama = $bom->total_harga;
        $harga_baru = $harga_lama - ($harga * $bom_list->kuantitas);

        $bom->total_harga = $harga_baru;
        $bom->save();

        $bom_list->delete();
       return redirect('/home/bom-input-item/' . $bom_list->kode_bom);
    }

    public function deleteBom($kode_bom){
        $bom_list = BOMList::where('kode_bom', $kode_bom);
        $bom_list->delete();

        $bom = BOM::find($kode_bom);
        $bom->delete();
       return redirect('/home/bom/');
    }

    public function cetakBom()
    {
        $bom = BOM::join('produk', 'bom.kode_produk', '=', 'produk.id')
            ->get(['bom.*', 'produk.nama']);
        return view ('bom.bom-cetak', compact('bom'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
