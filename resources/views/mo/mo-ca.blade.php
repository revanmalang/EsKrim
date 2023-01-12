@extends('home.master')

@section('judul', 'Halaman Check Availability')

@section('isi')
    <div class="pagetitle">
      <h1>Check Availability</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item">MO</li>
          <li class="breadcrumb-item active">Check Availability</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Check Availability</h5>
              
                <!-- General Form Elements -->
                <form action="{{ url('/home/bom-input-item')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Kode BOM</label>
                  <div class="col-sm-10">
                    <input type="text" name="kode_bom" id="kode_bom" class="form-control" value="{{$bom->kode_bom}}" readonly>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Nama Produk</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama" id="nama" class="form-control" value="{{$bom->nama}}" disabled>
                  </div>
                </div>
              </form><!-- End General Form Elements -->
            </div>
          </div>

          <div class="card">
            <div class="card-body">

              <!-- Table with stripped rows -->
              <table class="table datatable" id="myTable">
                <thead>
                  <tr>
                      <th scope="col">#</th>
                      <th scope="col">Kode</th>
                      <th scope="col">Nama Bahan</th>
                      <th scope="col">Dibutuhkan</th>
                      <th scope="col">Satuan</th>
                      <th scope="col">Harga Total</th>
                      <th scope="col">On Hand<th>
                      <th scope="col">Status</th>
                      <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @if($list->count())
                  @foreach($list as $item)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$item->kode_bom}}</td>
                      <td>{{$item->nama}}</td>
                      @php
                      {{
                          $total = $item->kuantitas * $mo->kuantitas;
                      }}
                      @endphp
                      <td>{{$total}}</td>
                      <td>{{$item->satuan}}</td>
                      <td>{{$item->harga * $total}}</td>
                      <td>{{$item->stok}}</td>
                      <td>
                      <td>
                        <span class="badge bg-primary">{{$item->stok < $total ? 'Bahan Kurang!' : 'Tersedia'}}</span>
                      </td>
                      @if($item->stok < $total )
                      <td>
                        <a href="{{ url('home/rfq-input') }}" class="btn btn-danger delete-confirm"> Tambah Bahan</a>
                      </td>
                      @else
                      <td>
                        <span class="badge bg-secondary">Bahan Tersedia</span>
                      </td>
                      @endif
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
              <label for="text_harga"> Total Biaya Produksi : </label>
              <label for="total_harga" id="val"> 0</label>
            </div>
          </div>
        </div>
      </div>
    </section>
    <script>
    updateSubTotal(); // Initial call

    function updateSubTotal() {
        var table = document.getElementById("myTable");
        let subTotal = Array.from(table.rows).slice(1).reduce((total, row) => {
            return total + parseFloat(row.cells[5].innerHTML);
        }, 0);
        document.getElementById("val").innerHTML = "Rp." + subTotal;
    }
    </script>
@endsection