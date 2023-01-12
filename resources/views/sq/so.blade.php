@extends('home.master')

@section('judul', 'Halaman Data SO')

@section('isi')
    <div class="pagetitle">
      <h1>Data Sales Orders</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item">Sales</li>
          <li class="breadcrumb-item active">Data Sales Orders</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Sales Orders</h5>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <div class="card-body">
                    
                </div>
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Kode Sales</th>
                    <th scope="col">Nama Customer</th>
                    <th scope="col">Tanggal Order</th>
                    <th scope="col">Status</th>
                    <th scope="col">Total Harga</th>
                    <th scope="col">Metode Pembayaran</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @if($sqs->count())
                  @foreach($sqs as $item)
                  @if($item->status >1)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$item->kode_sq}}</td>
                      <td>{{$item->nama}}</td>
                      <td>{{$item->tanggal_order}}</td>
                      <td>
                        @if($item->status == 1 )
                        <span class="badge bg-primary">Quotation</span>
                        @elseif($item->status == 2)
                        <span class="badge bg-secondary">To Invoice</span>
                        @elseif($item->status == 3)
                        <span class="badge bg-warning text-dark">Draft Invoice</span>
                        @elseif($item->status == 4)
                        <span class="badge bg-info text-dark">Fully Invoiced</span>
                        @elseif($item->status == 5)
                        <span class="badge bg-success">Delivered</span>
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
                        <a href="{{ url('/home/so-input-item/'.$item->kode_sq) }}"><span class="badge bg-success"> Edit</span></a>
                        @if($item->status >= 3 )
                        <a href="{{ url('/home/so-invoice/'.$item->kode_sq) }}" target="_blank"><span class="badge bg-info text-dark"> Invoice</span></a>
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

        </div>
      </div>
    </section>
@endsection