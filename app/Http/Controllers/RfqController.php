<?php

namespace App\Http\Controllers;

use App\Models\BOM;
use App\Models\BOMList;
use App\Models\Produk;
use App\Models\Bahan;
use App\Models\MO;
use App\Models\RFQ;
use App\Models\RFQList;
use App\Models\Vendor;
use Illuminate\Http\Request;

class RfqController extends Controller
{
    public function rfq()
    {
        $rfq = RFQ::join('vendor', 'rfq.kode_vendor', '=', 'vendor.id')
            ->get(['rfq.*', 'vendor.nama']);
        return view('rfq.rfq', ['rfqs' => $rfq]);
    }

    public function po()
    {
        $rfq = RFQ::join('vendor', 'rfq.kode_vendor', '=', 'vendor.id')
            ->get(['rfq.*', 'vendor.nama']);
        return view('rfq.po', ['rfqs' => $rfq]);
    }

    public function rfqInput()
    {
        $vendor = Vendor::get();
        return view('rfq.rfq-input', ['vendors' => $vendor]);
    }

    public function upload(Request $request)
    {
        // $this->validate($request, [
        //     'kode_bom' => 'required',
        //     'kode_produk' => 'required',
        //     'kuantitas' => 'kuantitas',
        // ]);
        $tanggal = date("Y-m-d");
        RFQ::create([
            'kode_rfq' => $request->kode_rfq,
            'kode_vendor' => $request->kode_vendor,
            'tanggal_order'=> $tanggal,
            'status' => 1,
            'total_harga' => 0,
            'metode_pembayaran' => 0
        ]);
        return redirect('/home/rfq-input-item/' . $request->kode_rfq);
    }

    public function rfqInputItems($kode_rfq)
    {
        $rfq = RFQ::join('vendor', 'rfq.kode_vendor', '=', 'vendor.id')
            ->where('rfq.kode_rfq', $kode_rfq)
            ->first(['rfq.*', 'vendor.nama']);
        $rfqList = RFQList::join('bahan', 'rfq_list.kode_bahan', '=', 'bahan.id')
            ->where('rfq_list.kode_rfq', $kode_rfq)
            ->get(['rfq_list.*', 'bahan.nama', 'bahan.harga']);
        $produk = Bahan::all();
        return view('rfq.rfq-input-item', ['rfq' => $rfq, 'rfqList' => $rfqList, 'products' => $produk]);
    }

    public function rfqUploadItems(Request $request)
    {
        RFQList::create([
            'kode_rfq' => $request->kode_rfq,
            'kode_bahan' => $request->kode_bahan,
            'kuantitas' => $request->kuantitas
        ]);
        $product = Bahan::find($request->kode_bahan);
        $harga = $product->harga;
        $rfq = RFQ::find($request->kode_rfq);
        $harga_lama = $rfq->total_harga;
        $harga_baru = $harga_lama + ($harga * $request->kuantitas);

        $rfq->total_harga = $harga_baru;
        $rfq->save();

        return redirect('/home/rfq-input-item/' . $request->kode_rfq);
    }

    public function poInputItems($kode_rfq)
    {
        $rfq = RFQ::join('vendor', 'rfq.kode_vendor', '=', 'vendor.id')
            ->where('rfq.kode_rfq', $kode_rfq)
            ->first(['rfq.*', 'vendor.nama']);
        $rfqList = RFQList::join('bahan', 'rfq_list.kode_bahan', '=', 'bahan.id')
            ->where('rfq_list.kode_rfq', $kode_rfq)
            ->get(['rfq_list.*', 'bahan.nama', 'bahan.harga']);
        $produk = Bahan::all();
        return view('rfq.po-input-item', ['rfq' => $rfq, 'rfqList' => $rfqList, 'products' => $produk]);
    }

    public function deleteList($kode_rfq_list){
        $rfq_list = RFQList::find($kode_rfq_list);
        $product = Bahan::find($rfq_list->kode_bahan);
        $harga = $product->harga;
        $rfq = RFQ::find($rfq_list->kode_rfq);
        $harga_lama = $rfq->total_harga;
        $harga_baru = $harga_lama - ($harga * $rfq_list->kuantitas);

        $rfq->total_harga = $harga_baru;
        $rfq->save();

        $rfq_list->delete();
       return redirect('/home/rfq-input-item/' . $rfq_list->kode_rfq);
    }

    public function rfqSaveItems(Request $request)
    {
        $rfq = RFQ::find($request->kode_rfq);
        $rfq->status = $rfq->status + 1;
        $rfq->save();

        return redirect('/home/rfq-input-item/' . $request->kode_rfq);
    }

    public function poSaveItems(Request $request)
    {
        $rfq = RFQ::find($request->kode_rfq);
        $rfq->status = $rfq->status + 1;
        $rfq->save();

        return redirect('/home/po-input-item/' . $request->kode_rfq);
    }

    public function poCreateBill(Request $request)
    {
        $rfqlist = RFQList::Where('kode_rfq', $request->kode_rfq)->get();
        foreach ($rfqlist as $item) {
            $product = Bahan::find($item->kode_bahan);
            $product->stok = $product->stok + $item->kuantitas;
            $product->save();
        }

        $rfq = RFQ::find($request->kode_rfq);
        $rfq->metode_pembayaran = $request->payment;
        $rfq->status = $rfq->status + 1;
        $rfq->save();

        return redirect('/home/po');
    }

    public function deleteRfq($kode_rfq){
        $rfq_list = RFQList::where('kode_rfq', $kode_rfq);
        $rfq_list->delete();

        $rfq = RFQ::find($kode_rfq);
        $rfq->delete();
       return redirect('/home/rfq/');
    }

    public function getPDF($kode_rfq){
        $rfqList = RFQList::join('bahan', 'rfq_list.kode_bahan', '=', 'bahan.id')
            ->where('rfq_list.kode_rfq', $kode_rfq)
            ->get(['rfq_list.*', 'bahan.nama', 'bahan.harga']);
        $rfq = RFQ::join('vendor', 'rfq.kode_vendor', '=', 'vendor.id')
            ->where('rfq.kode_rfq', $kode_rfq)
            ->get(['rfq.*', 'vendor.nama', 'vendor.alamat']);
        
        return view('rfq.po-invoice', ['rfqlist' => $rfqList, 'rfq' => $rfq]);

        // $pdf = app('dompdf.wrapper')->loadView('rfq.po-invoice', ['rfqlist' => $rfqList, 'rfq' => $rfq]);
        // return $pdf->stream('invoice-po.pdf');
    }
}
