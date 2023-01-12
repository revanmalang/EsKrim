@extends('home.master')

@section('judul', 'Halaman Tambah Item RFQ')

@section('isi')
    <div class="pagetitle">
      <h1>Tambah Item Request For Quotation</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item">Purchasing</li>
          <li class="breadcrumb-item">RFQ</li>
          <li class="breadcrumb-item active">Tambah Item RFQ</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tambah Data Item Request For Quotation</h5>
              
                <!-- General Form Elements -->
                <form action="{{ url('/home/rfq-input-item')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Kode RFQ</label>
                  <div class="col-sm-10">
                    <input type="text" name="kode_rfq" id="kode_rfq" class="form-control" value="{{$rfq->kode_rfq}}" readonly>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Nama Vendor</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama" id="nama" class="form-control" value="{{$rfq->nama}}" disabled>
                  </div>
                </div>
                @if($rfq->status == 1 )
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Pilih Bahan</label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" name="kode_bahan" id="kode_bahan">
                      <option selected>Pilih Bahan</option>
                        @if($products->count())
                        @foreach($products as $item)
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

                <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name="simpan">Tambah Bahan</button>
                </div>
                @endif
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
                      <th scope="col">Harga Satuan</th>
                      <th scope="col">Harga Total<th>
                      <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @if($rfqList->count())
                  @foreach($rfqList as $item)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$item->kode_rfq}}</td>
                      <td>{{$item->nama}}</td>
                      <td>{{$item->kuantitas}}</td>
                      <td>{{$item->harga}}</td>
                      @php
                      {{
                          $total = $item->harga * $item->kuantitas;
                      }}
                      @endphp
                      <td>{{$total}}</td>
                      <td>
                      @if($rfq->status == 1)
                      <td>
                          <a href="{{ url('home/rfq-delete-item/'.$item->kode_rfq_list) }}"><span class="badge bg-success"> Hapus</span></a>
                      </td>
                      @else
                        <td>
                          <span class="badge bg-success"> Fix</span>
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
              <label for="text_harga"> Total Harga : </label>
              <label for="total_harga" id="val"> 0</label>
            </div>
          </div>

          @if($rfq->status == 1 )
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Edit Status Request For Quotation</h5>
                <form action="{{ url('/home/rfq/save') }}" method="post" class="btn p-0" name="input-form" id="input-form">
                    {{ csrf_field() }}
                    <input type="text" id="kode_rfq" value="{{$rfq->kode_rfq}}" name="kode_rfq" hidden>
                    <button type="submit" onclick="return confirm('Confirm Order?');" class="btn btn-success">Confirm Order</button>
                </form>
            </div>
          </div>
          @endif

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