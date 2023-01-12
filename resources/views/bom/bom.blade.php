@extends('home.master')

@section('judul', 'Halaman Data BoM')

@section('isi')
    <div class="pagetitle">
      <h1>Data Bill of Material</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item">BoM</li>
          <li class="breadcrumb-item active">Data BoM</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Bill of Material</h5>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <div class="card-body">
                    <a href="/home/bom-input"><button type="button" class="btn btn-primary">Tambah BoM</button></a>
                    <a href="/home/bom/cetak" target="_blank"><button type="button" class="btn btn-secondary">Cetak BoM</button></a>
                </div>
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Kuantitas</th>
                    <th scope="col">Nama BoM</th>
                    <th scope="col">Biaya Produksi</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @if($boms->count())
                  @foreach($boms as $item)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$item->nama}}</td>
                      <td>{{$item->kuantitas}}</td>
                      <td>{{$item->kode_bom}}</td>
                      <td>Rp. {{$item->total_harga}}</td>
                      <td>
                          <a href="{{ url('/home/bom-input-item/'.$item->kode_bom) }}"><span class="badge bg-success"> Edit</span></a>
                          <a href="{{ url('/home/bom-delete/'.$item->kode_bom) }}"><span class="badge bg-danger"> Hapus</span></a>
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