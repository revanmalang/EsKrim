@extends('home.master')

@section('judul', 'Halaman Data Vendor')

@section('isi')
    <div class="pagetitle">
      <h1>Data Vendor</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item">Purchasing</li>
          <li class="breadcrumb-item active">Data Vendor</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Vendor</h5>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <div class="card-body">
                    <a href="/home/vendor/tambah"><button type="button" class="btn btn-primary">Tambah Vendor</button></a>
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Vendor</th>
                    <th scope="col">Contact Person</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($vendor as $vnd)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $vnd->nama }}</td>
                      <td>{{ $vnd->kontak }}</td>
                      <td>{{ $vnd->alamat }}</td>
                      <td>
                          <a href="/home/vendor/edit/{{ $vnd->id }}">Edit</a>
                          <a href="/home/vendor/delete/{{ $vnd->id }}">Hapus</a>
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
