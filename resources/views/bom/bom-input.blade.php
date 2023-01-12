@extends('home.master')

@section('judul', 'Halaman Tambah BoM')

@section('isi')
    <div class="pagetitle">
      <h1>Tambah Bill of Material</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item">BoM</li>
          <li class="breadcrumb-item active">Tambah BoM</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tambah Data Bill of Material</h5>
              
                <!-- General Form Elements -->
                <form action="{{ url('/home/bom-input')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Produk</label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" name="kode_produk" id="kode_produk">
                      <option selected>Pilih Produk</option>
                        @if($products->count())
                        @foreach($products as $item)
                          <option value="{{$item->id}}">{{$item->nama}}</option>
                        @endforeach
                        @endif
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Kode BOM</label>
                  <div class="col-sm-10">
                    <input type="text" name="kode_bom" id="kode_bom" class="form-control">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Kuantitas</label>
                  <div class="col-sm-10">
                    <input type="text" name="kuantitas" id="kuantitas" class="form-control">
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