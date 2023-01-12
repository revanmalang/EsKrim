<?php

namespace App\Http\Controllers;

use App\Models\BOM;
use App\Models\BOMList;
use App\Models\Produk;
use App\Models\Bahan;
use App\Models\MO;
use App\Models\RFQ;
use App\Models\RFQList;
use App\Models\Pembeli;
use App\Models\SQ;
use App\Models\SQList;
use PDF;
use Illuminate\Http\Request;

class SQController extends Controller
{
    public function sq()
    {
        $sq = SQ::join('pembeli', 'sq.kode_pembeli', '=', 'pembeli.id')
            ->get(['sq.*', 'pembeli.nama']);
        return view('sq.sq', ['sqs' => $sq]);
    }

    public function so()
    {
        $sq = SQ::join('pembeli', 'sq.kode_pembeli', '=', 'pembeli.id')
            ->get(['sq.*', 'pembeli.nama']);
        return view('sq.so', ['sqs' => $sq]);
    }

    public function sqInput()
    {
        $pembeli = Pembeli::get();
        return view('sq.sq-input', ['pembelis' => $pembeli]);
    }

    public function upload(Request $request)
    {
        // $this->validate($request, [
        //     'kode_bom' => 'required',
        //     'kode_produk' => 'required',
        //     'kuantitas' => 'kuantitas',
        // ]);
        $tanggal = date("Y-m-d");
        SQ::create([
            'kode_sq' => $request->kode_sq,
            'kode_pembeli' => $request->kode_pembeli,
            'tanggal_order'=> $tanggal,
            'status' => 1,
            'total_harga' => 0,
            'metode_pembayaran' => 0
        ]);
        return redirect('/home/sq-input-item/' . $request->kode_sq);
    }

    public function sqInputItems($kode_sq)
    {
        $sq = SQ::join('pembeli', 'sq.kode_pembeli', '=', 'pembeli.id')
            ->where('sq.kode_sq', $kode_sq)
            ->first(['sq.*', 'pembeli.nama']);
        $sqList = SQList::join('produk', 'sq_list.kode_produk', '=', 'produk.id')
            ->where('sq_list.kode_sq', $kode_sq)
            ->get(['sq_list.*', 'produk.nama', 'produk.harga']);
        $produk = Produk::all();
        return view('sq.sq-input-item', ['sq' => $sq, 'sqList' => $sqList, 'products' => $produk]);
    }

    public function sqUploadItems(Request $request)
    {
        SQList::create([
            'kode_sq' => $request->kode_sq,
            'kode_produk' => $request->kode_produk,
            'kuantitas' => $request->kuantitas
        ]);
        $product = Produk::find($request->kode_produk);
        $harga = $product->harga;
        $sq = SQ::find($request->kode_sq);
        $harga_lama = $sq->total_harga;
        $harga_baru = $harga_lama + ($harga * $request->kuantitas);

        $sq->total_harga = $harga_baru;
        $sq->save();

        return redirect('/home/sq-input-item/' . $request->kode_sq);
    }
    
    public function soInputItems($kode_sq)
    {
        $sq = SQ::join('pembeli', 'sq.kode_pembeli', '=', 'pembeli.id')
            ->where('sq.kode_sq', $kode_sq)
            ->first(['sq.*', 'pembeli.nama']);
        $sqList = SQList::join('produk', 'sq_list.kode_produk', '=', 'produk.id')
            ->where('sq_list.kode_sq', $kode_sq)
            ->get(['sq_list.*', 'produk.nama', 'produk.harga']);
        $produk = Produk::all();
        return view('sq.so-input-item', ['sq' => $sq, 'sqList' => $sqList, 'products' => $produk]);
    }

    public function soUploadItems(Request $request)
    {
        SQList::create([
            'kode_sq' => $request->kode_sq,
            'kode_produk' => $request->kode_produk,
            'kuantitas' => $request->kuantitas
        ]);
        $product = Produk::find($request->kode_produk);
        $harga = $product->harga;
        $sq = SQ::find($request->kode_sq);
        $harga_lama = $sq->total_harga;
        $harga_baru = $harga_lama + ($harga * $request->kuantitas);

        $sq->total_harga = $harga_baru;
        $sq->save();

        return redirect('/home/so-input-item/' . $request->kode_sq);
    }

    public function sqSave(Request $request)
    {
        $sq = SQ::find($request->kode_sq);
        $sq->status = $sq->status + 1;
        $sq->save();

        return redirect('/home/sq-input-item/' . $request->kode_sq);
    }

    public function sqSaveSo(Request $request)
    {
        $sq = SQ::find($request->kode_sq);
        $sq->status = $sq->status + 1;
        $sq->save();

        return redirect('/home/so-input-item/' . $request->kode_sq);
    }

    public function sqCreateInvoice(Request $request)
    {
        $sq = SQ::find($request->kode_sq);
        $sq->metode_pembayaran = $request->payment;
        $sq->status = $sq->status + 1;
        $sq->save();

        return redirect('/home/so-input-item/' . $request->kode_sq);
    }

    public function sqDelivery(Request $request)
    {
        $sqlist = SQList::Where('kode_sq', $request->kode_sq)->get();
        foreach ($sqlist as $item) {
            $product = Produk::find($item->kode_produk);
            $product->stok = $product->stok - $item->kuantitas;
            $product->save();
        }
        $sq = SQ::find($request->kode_sq);
        $sq->status = $sq->status + 1;
        $sq->save();
        return redirect('/home/so');
    }

    public function deleteSQ($kode_sq){
        $sq_list = SQList::where('kode_sq', $kode_sq);
        $sq_list->delete();

        $sq = SQ::find($kode_sq);
        $sq->delete();
       return redirect('/home/sq/');
    }

    public function deleteListSQ($kode_sq_list){
        $sq_list = SQList::find($kode_sq_list);
        $product = Produk::find($sq_list->kode_produk);
        $harga = $product->harga;
        $sq = SQ::find($sq_list->kode_sq);
        $harga_lama = $sq->total_harga;
        $harga_baru = $harga_lama - ($harga * $sq_list->kuantitas);

        $sq->total_harga = $harga_baru;
        $sq->save();

        $sq_list->delete();
       return redirect('/home/sq-input-item/' . $sq_list->kode_sq);
    }

    public function getPDF($kode_sq){
        $sqList = SQList::join('produk', 'sq_list.kode_produk', '=', 'produk.id')
            ->where('sq_list.kode_sq', $kode_sq)
            ->get(['sq_list.*', 'produk.nama', 'produk.harga']);
        $sq = SQ::join('pembeli', 'sq.kode_pembeli', '=', 'pembeli.id')
            ->where('sq.kode_sq', $kode_sq)
            ->get(['sq.*', 'pembeli.nama', 'pembeli.alamat']);

        return view('sq.so-invoice', ['sqlist' => $sqList, 'sq' => $sq]);

        // $pdf = app('dompdf.wrapper')->loadView('sq.so-invoice', ['sqlist' => $sqList, 'sq' => $sq]);
        // return $pdf->stream('invoice-sq.pdf');
    }
}
