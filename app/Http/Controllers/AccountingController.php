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
use Carbon\Carbon;
use Illuminate\Http\Request;

class AccountingController extends Controller
{
    public function index()
    {
        return view ('accounting.accounting');
    }

    public function invoicing()
    {
        $sq = SQ::join('pembeli', 'sq.kode_pembeli', '=', 'pembeli.id')
            ->get(['sq.*', 'pembeli.nama']);

        return view('accounting.accounting-invoicing', ['sqs' => $sq]);
    }

    public function tampilInvoicePertanggal($tglawal, $tglakhir){
        // dd(["Tanggal Awal : ".$tglawal, "Tanggal Akhir : ".$tglakhir]);
        $sq = SQ::join('pembeli', 'sq.kode_pembeli', '=', 'pembeli.id')
            ->whereBetween('tanggal_order', [$tglawal, $tglakhir]) ->get();

        return view('accounting.accounting-invoicing', ['sqs' => $sq]);
    }

    public function cetakLaporan(){
        $sqList = SQList::join('produk', 'sq_list.kode_produk', '=', 'produk.id')
            ->get(['sq_list.*', 'produk.nama', 'produk.harga']);
        $sq = SQ::join('pembeli', 'sq.kode_pembeli', '=', 'pembeli.id')
            ->get(['sq.*', 'pembeli.nama', 'pembeli.alamat']);

        return view('accounting.accounting-invoicing-cetak', ['sqlist' => $sqList, 'sq' => $sq]);

        // $pdf = app('dompdf.wrapper')->loadView('accounting.accounting-invoicing-cetak', ['sqlist' => $sqList, 'sq' => $sq]);
        // return $pdf->stream('cetak-sales.pdf');
    }

    public function cetakLaporanPertanggal($tglawal, $tglakhir){
        $sq = SQ::join('pembeli', 'sq.kode_pembeli', '=', 'pembeli.id')
            ->whereBetween('tanggal_order', [$tglawal, $tglakhir]) ->get();

        return view('accounting.accounting-invoicing-cetakPertanggal', ['sq' => $sq]);

        // $pdf = app('dompdf.wrapper')->loadView('accounting.accounting-invoicing-cetak', ['sqlist' => $sqList, 'sq' => $sq]);
        // return $pdf->stream('cetak-sales.pdf');
    }

    public function bill()
    {
        $rfq = RFQ::join('vendor', 'rfq.kode_vendor', '=', 'vendor.id')
            ->get(['rfq.*', 'vendor.nama']);

        return view('accounting.accounting-bill', ['rfqs' => $rfq]);
    }

    public function tampilBillPertanggal($tglawal, $tglakhir){
        // dd(["Tanggal Awal : ".$tglawal, "Tanggal Akhir : ".$tglakhir]);
        $rfq = RFQ::join('vendor', 'rfq.kode_vendor', '=', 'vendor.id')
            ->whereBetween('tanggal_order', [$tglawal, $tglakhir]) ->get();

        return view('accounting.accounting-bill', ['rfqs' => $rfq]);
    }

    public function cetakLaporanBill(){
        $rfqList = RFQList::join('bahan', 'rfq_list.kode_bahan', '=', 'bahan.id')
            ->get(['rfq_list.*', 'bahan.nama', 'bahan.harga']);
        $rfq = RFQ::join('vendor', 'rfq.kode_vendor', '=', 'vendor.id')
            ->get(['rfq.*', 'vendor.nama', 'vendor.alamat']);
        
        return view('accounting.accounting-bill-cetak', ['rfqlist' => $rfqList, 'rfq' => $rfq]);

        // $pdf = app('dompdf.wrapper')->loadView('accounting.accounting-bill-cetak', ['rfqlist' => $rfqList, 'rfq' => $rfq]);
        // return $pdf->stream('cetak-purchase.pdf.pdf');
    }

    public function cetakLaporanBillPertanggal($tglawal, $tglakhir){
        $rfq = RFQ::join('vendor', 'rfq.kode_vendor', '=', 'vendor.id')
            ->whereBetween('tanggal_order', [$tglawal, $tglakhir]) ->get();

        return view('accounting.accounting-bill-cetakPertanggal', ['rfq' => $rfq]);

        // $pdf = app('dompdf.wrapper')->loadView('accounting.accounting-bill-cetak', ['rfqlist' => $rfqList, 'rfq' => $rfq]);
        // return $pdf->stream('cetak-purchase.pdf.pdf');
    }
}
