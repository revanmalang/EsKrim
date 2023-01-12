@extends('home.master')

@section('judul', 'Halaman Data Pembeli')

@section('isi')
    <div class="pagetitle">
      <h1>Data Pembeli</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item">Sales</li>
          <li class="breadcrumb-item active">Data Pembeli</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Pembeli</h5>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <div class="card-body">
                    <a href="/home/pembeli/tambah"><button type="button" class="btn btn-primary">Tambah Pembeli</button></a>
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Pembeli</th>
                    <th scope="col">Contact Person</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($pembeli as $pmbl)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $pmbl->nama }}</td>
                      <td>{{ $pmbl->kontak }}</td>
                      <td>{{ $pmbl->alamat }}</td>
                      <td>
                          <a href="/home/pembeli/edit/{{ $pmbl->id }}">Edit</a>
                          <a href="/home/pembeli/delete/{{ $pmbl->id }}">Hapus</a>
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
