@extends('home.master')

@section('judul', 'Halaman Data Bahan')

@section('isi')
    <div class="pagetitle">
      <h1>Data Bahan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item">Manufacturing</li>
          <li class="breadcrumb-item active">Data Bahan</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Bahan</h5>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <div class="card-body">
                    <a href="/home/bahan/tambah"><button type="button" class="btn btn-primary">Tambah Bahan</button></a>
                    <a href="/home/bahan/cetak" target="_blank"><button type="button" class="btn btn-secondary">Cetak Bahan</button></a>
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Barcode</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Kode</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($bahan as $bhn)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{!! DNS1D::getBarcodeHTML('Rp. '. $bhn->harga, 'C39') !!}</td>
                      <td>{{ $bhn->nama }}</td>
                      <td>{{ $bhn->kode }}</td>
                      <td width="10%">{{ 'Rp. ' .$bhn->harga }}</td>
                      <td>{{ $bhn->stok }}</td>
                      <td width="25%">
                        <img src="{{ url('/img_bahan/'.$bhn->gambar) }}" width="40%" alt="">
                      </td>
                      <td>
                          <a href="/home/bahan/edit/{{ $bhn->id }}">Edit</a>
                          <a href="/home/bahan/delete/{{ $bhn->id }}">Hapus</a>
                      </td>
                    </tr>
                @endforeach
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>
@endsection