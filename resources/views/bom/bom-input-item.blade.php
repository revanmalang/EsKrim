@extends('home.master')

@section('judul', 'Halaman Tambah Item BoM')

@section('isi')
    <div class="pagetitle">
      <h1>Tambah Item Bill of Material</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item">BoM</li>
          <li class="breadcrumb-item active">Tambah Item BoM</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tambah Data Item Bill of Material</h5>
              
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

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Pilih Bahan</label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" name="kode_bahan" id="kode_bahan">
                      <option selected>Pilih Bahan</option>
                        @if($materials->count())
                        @foreach($materials as $item)
                          <option value="{{$item->id}}">{{$item->nama}}</option>
                        @endforeach
                        @endif
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Kuantitas</label>
                    <div class="col-sm-10">
                      <input type="text" name="kuantitas" id="kuantitas" class="form-control">
                    </div>
                </div>  

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Satuan</label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" name="satuan" id="satuan">
                      <option selected>Pilih Satuan</option>
                        <option value="Gram">Gram</option>
                        <option value="Kg">Kg</option>
                        <option value="Liter">Liter</option>
                        <option value="Ml">Ml</option>
                        <option value="Butir">Butir</option>
                        <option value="Sachet">Sachet</option>
                        <option value="Pcs">Pcs</option>
                        <option value="Orang">Orang</option>
                    </select>
                  </div>
                </div>

                <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name="simpan">Tambah Bahan</button>
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
                      <th scope="col">Kuantitas</th>
                      <th scope="col">Satuan</th>
                      <th scope="col">Harga Satuan</th>
                      <th scope="col">Harga Total<th>
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
                      <td>{{$item->kuantitas}}</td>
                      <td>{{$item->satuan}}</td>
                      <td>{{$item->harga}}</td>
                      @php
                      {{
                          $total = $item->harga * $item->kuantitas;
                      }}
                      @endphp
                      <td>{{$total}}</td>
                      <td>
                      <td>
                          <a href="{{ url('home/bom-delete-item/'.$item->kode_bom_list) }}"><span class="badge bg-success"> Hapus</span></a>
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

          <div class="card">
            <div class="card-body">
            <h5 class="card-title">Total Harga</h5>
              <label for="text_harga"> Total Harga : </label>
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
            return total + parseFloat(row.cells[6].innerHTML);
        }, 0);
        document.getElementById("val").innerHTML = "Rp." + subTotal;
    }
    </script>
@endsection