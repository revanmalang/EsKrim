@extends('home.master')

@section('judul', 'Halaman Edit Produk')

@section('isi')
    <div class="pagetitle">
      <h1>Edit Produk</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item">Manufacturing</li>
          <li class="breadcrumb-item active">Edit Produk</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Edit Data Produk</h5>
              
                <!-- General Form Elements -->
                <form action="{{ url('/home/produk/update/'.$produk->id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Nama Produk</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama" id="nama" class="form-control" value="{{ $produk->nama }}">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Kode Produk</label>
                  <div class="col-sm-10">
                    <input type="text" name="kode" id="kode" class="form-control" value="{{ $produk->kode }}">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Harga Produk</label>
                  <div class="col-sm-10">
                    <input type="text" name="harga" id="harga" class="form-control" value="{{ $produk->harga }}">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Gambar Lama</label>
                  <img src="{{ asset('/img_produk/'.$produk->gambar) }}" style="width: 20%" alt="">
                  <div class="col-sm-10">
                    <input type="file" name="gambar" id="gambar" class="form-control" value="{{ asset('/img_produk/'.$produk->gambar) }}">
                  </div>
                </div>
                <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Edit Produk</button>
                </div>
              </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>
      </div>
    </section>
@endsection