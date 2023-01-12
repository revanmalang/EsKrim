@extends('home.master')

@section('judul', 'Halaman Data Pembelian')

@section('isi')
    <div class="pagetitle">
      <h1>Data Pembelian Bahan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item">Accounting</li>
          <li class="breadcrumb-item active">Data Pembelian Bahan</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Pembelian Bahan</h5>

              <!-- Table with stripped rows -->
              <table class="table datatable" id="myTable">
                <div class="card-body">
                <a href="/home/accounting-bill"><button type="button" class="btn btn-success">Tampilkan Semua Data</button></a>
                <a href="/home/accounting-bill/cetak/" target="_blank"><button type="button" class="btn btn-primary">Cetak Laporan</button></a>
                <a href="" onclick="this.href='/home/accounting-bill/cetak-pertanggal/'+ document.getElementById('tglawal').value + '/' + document.getElementById('tglakhir').value" target="_blank" class="btn btn-secondary">Cetak Laporan Per Tanggal</a>

                <h5 class="card-title">Filter Berdasarkan Tanggal</h5>
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-2 col-form-label">Tanggal Awal</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="tglawal" id="tglawal">
                  </div>
                  <br>
                  <br>
                  <label for="inputDate" class="col-sm-2 col-form-label">Tanggal Akhir</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="tglakhir" id="tglakhir">
                  </div>
                  <br>
                  <br>
                  <a href="" onclick="this.href='/home/accounting-bill/tampil-pertanggal/'+ document.getElementById('tglawal').value + '/' + document.getElementById('tglakhir').value" class="btn btn-secondary">Tampilkan Data Per Tanggal</a>
                </div>

                </div>
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Reference</th>
                    <th scope="col">Nama Vendor</th>
                    <th scope="col">Tanggal Order</th>
                    <th scope="col">Status</th>
                    <th scope="col">Total Harga</th>
                    <th scope="col">Metode Pembayaran</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @if($rfqs->count())
                  @foreach($rfqs as $item)
                  @if($item->status > 4)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$item->kode_rfq}}</td>
                      <td>{{$item->nama}}</td>
                      <td>{{$item->tanggal_order}}</td>
                      <td>
                        @if($item->status == 1 )
                        <span class="badge bg-primary">Draft</span>
                        @elseif($item->status == 2)
                        <span class="badge bg-secondary">Purchase Order</span>
                        @elseif($item->status == 3)
                        <span class="badge bg-warning text-dark">Nothing to Bill</span>
                        @elseif($item->status == 4)
                        <span class="badge bg-info text-dark">Waiting to Bill</span>
                        @elseif($item->status == 5)
                        <span class="badge bg-success">Fully Billed</span>
                        @endif
                      </td>
                      <td>{{$item->total_harga}}</td>
                      <td> 
                        @if($item->metode_pembayaran == 0 )
                        <span class="badge bg-secondary">Belum Dibuat</span>
                        @elseif($item->metode_pembayaran == 1)
                        <span class="badge bg-primary">Cash</span>
                        @elseif($item->metode_pembayaran == 2)
                        <span class="badge bg-primary">Transfer</span>
                        @endif
                      </td>
                      <td>
                        @if($item->status >= 5 )
                        <a href="{{ url('/home/po-invoice/'.$item->kode_rfq) }}" target="_blank"><span class="badge bg-info text-dark">Cek Invoice</span></a>
                        @endif
                      </td>
                    </tr>
                  @endif
                  @endforeach
                  @else
                  <tr>
                        <td colspan="7"> No record found </td>
                  </tr>
                  @endif
                </tbody>
              </table>
              <!-- End Table with stripped rows -->
            </div>
          </div>

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Total Pembelian Bahan</h5>
              <label for="text_harga"> Total Pembelian : </label>
              <label for="total_harga" id="val"> 0</label>
            </div>
         </div>

        </div>
      </div>
    </section>

    <script>
    updateSubTotal(); // Initial call

    function updateSubTotal() {
        var table = document.getElementById("myTable");
        let subTotal = Array.from(table.rows).slice(1).reduce((total, row) => {
            return total + parseFloat(row.cells[5].innerHTML);
        }, 0);
        document.getElementById("val").innerHTML = "Rp." + subTotal;
    }
    </script>
@endsection
