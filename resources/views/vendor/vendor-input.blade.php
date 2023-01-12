@extends('home.master')

@section('judul', 'Halaman Tambah Vendor')

@section('isi')
    <div class="pagetitle">
      <h1>Tambah Vendor</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item">Purchasing</li>
          <li class="breadcrumb-item active">Tambah Vendor</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tambah Data Vendor</h5>
              
                <!-- General Form Elements -->
                <form action="{{ route('vendor-simpan')}}" method="post">
                {{ csrf_field() }}
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Nama Vendor</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama" id="nama" class="form-control">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Contact Person</label>
                  <div class="col-sm-10">
                    <input type="text" name="kontak" id="kontak" class="form-control">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Alamat</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" name="alamat" id="alamat" style="height: 100px"></textarea>
                  </div>
                </div>
                <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Simpan</button>
                </div>
              </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>
      </div>
    </section>
@endsection