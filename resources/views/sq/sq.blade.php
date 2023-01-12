@extends('home.master')

@section('judul', 'Halaman Data SQ')

@section('isi')
    <div class="pagetitle">
      <h1>Data Sales Quotation</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item">Sales</li>
          <li class="breadcrumb-item active">Data Sales Quotation</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Sales Quotation</h5>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <div class="card-body">
                    <a href="/home/sq-input"><button type="button" class="btn btn-primary">Tambah Sales Quotation</button></a>
                </div>
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Kode Sales</th>
                    <th scope="col">Nama Customer</th>
                    <th scope="col">Tanggal Order</th>
                    <th scope="col">Status</th>
                    <th scope="col">Total Harga</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @if($sqs->count())
                  @foreach($sqs as $item)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$item->kode_sq}}</td>
                      <td>{{$item->nama}}</td>
                      <td>{{$item->tanggal_order}}</td>
                      <td>
                        @if($item->status == 1 )
                        <span class="badge bg-primary">Quotation</span>
                        @elseif($item->status > 1)
                        <span class="badge bg-secondary">Sales Orders</span>
                        @endif
                      </td>
                      <td>{{$item->total_harga}}</td>
                      <td>
                        <a href="{{ url('/home/sq-input-item/'.$item->kode_sq) }}"><span class="badge bg-success"> Edit</span></a>
                        <a href="{{ url('/home/sq-delete/'.$item->kode_sq) }}"><span class="badge bg-danger"> Hapus</span></a>
                      </td>
                    </tr>
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