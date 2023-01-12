@extends('home.master')

@section('judul', 'Halaman Tambah Bahan')

@section('isi')
    <div class="pagetitle">
      <h1>Tambah Bahan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item">Manufacturing</li>
          <li class="breadcrumb-item active">Tambah Bahan</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tambah Data Bahan</h5>
              
                <!-- General Form Elements -->
                <form action="{{ route('bahan-simpan')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Nama Bahan</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama" id="nama" class="form-control">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Kode Bahan</label>
                  <div class="col-sm-10">
                    <input type="text" name="kode" id="kode" class="form-control">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Harga Bahan</label>
                  <div class="col-sm-10">
                    <input type="text" name="harga" id="harga" class="form-control">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputFile" class="col-sm-2 col-form-label">Gambar</label>
                  <div class="col-sm-10">
                    <input type="file" name="gambar" id="gambar" class="form-control">
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