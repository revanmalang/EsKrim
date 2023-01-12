@extends('home.master')

@section('judul', 'Halaman Edit Status SO')

@section('isi')
    <div class="pagetitle">
      <h1>Edit Status Sales Order</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item">Sales</li>
          <li class="breadcrumb-item">Sales Orders</li>
          <li class="breadcrumb-item active">Data Item Sales Order</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Item Sales Order</h5>
              
                <!-- General Form Elements -->
                <form action="{{ url('/home/sq-input-item')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Kode Sales Quotation</label>
                  <div class="col-sm-10">
                    <input type="text" name="kode_sq" id="kode_sq" class="form-control" value="{{$sq->kode_sq}}" readonly>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Nama Pembeli</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama" id="nama" class="form-control" value="{{$sq->nama}}" disabled>
                  </div>
                </div>
                @if($sq->status == 1 )
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Pilih Produk</label>
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
                  <label for="inputText" class="col-sm-2 col-form-label">Kuantitas</label>
                    <div class="col-sm-10">
                      <input type="text" name="kuantitas" id="kuantitas" class="form-control">
                    </div>
                </div>  

                <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name="simpan">Tambah Produk</button>
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
                      <th scope="col">Nama Produk</th>
                      <th scope="col">Kuantitas</th>
                      <th scope="col">Harga Satuan</th>
                      <th scope="col">Harga Total<th>
                      <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @if($sqList->count())
                  @foreach($sqList as $item)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$item->kode_sq}}</td>
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
                      @if($sq->status == 1)
                      <td>
                          <a href="{{ url('home/sq-delete-item/'.$item->kode_sq_list) }}"><span class="badge bg-success"> Hapus</span></a>
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

          <div class="card">
            <div class="card-body">
              @if($sq->status < 5)
              <h5 class="card-title">Edit Status Sales Orders</h5>
              @elseif($sq->status == 5)
              <h5 class="card-title">Status Sales Orders</h5>
              @endif
                @if($sq->status == 1 )
                <form action="{{ url('/home/sq/saveSo') }}" method="post" class="btn p-0" name="input-form" id="input-form">
                    {{ csrf_field() }}
                    <input type="text" id="kode_sq" value="{{$sq->kode_sq}}" name="kode_sq" hidden>
                    <button type="submit" onclick="return confirm('Confirm Order?');" class="btn btn-secondary">Confirm Order</button>
                </form>
                @elseif($sq->status == 2 )
                <form action="{{ url('/home/sq/invoice') }}" method="post" class="btn p-0" name="input-form" id="input-form">
                    {{ csrf_field() }}
                    <label for="inputText" class="col-form-label">Pilih Metode Pembayaran:</label>
                    <fieldset class="row mb-3">
                    <div class="col-sm-10">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment" id="payment" value="1" checked>
                        <label class="form-check-label" for="gridRadios1">
                          Cash
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment" id="payment" value="2">
                        <label class="form-check-label" for="gridRadios2">
                          Transfer
                        </label>
                      </div>
                    </div>
                    </fieldset>
                    <input type="text" id="kode_sq" value="{{$sq->kode_sq}}" name="kode_sq" hidden>
                    <button type="submit" onclick="return confirm('Create Invoice?');" class="btn btn-secondary">Create Invoice</button>
                </form>
                @elseif($sq->status == 3)
                <label for="inputText" class="col-form-label">Metode Pembayaran:
                    <span class="badge bg-success"> {{$sq->metode_pembayaran == 1 ? 'Cash' : 'Transfer'}}</span>
                </label>
                <br>
                <form action="{{ url('/home/sq/saveSo') }}" method="post" class="btn p-0" name="input-form" id="input-form">
                    {{ csrf_field() }}
                    <input type="text" id="kode_sq" value="{{$sq->kode_sq}}" name="kode_sq" hidden>
                    <button type="submit" onclick="return confirm('Validate?');" class="btn btn-secondary">Validate</button>
                </form>
                <button type="submit" class="btn btn-dark"><a href="{{ url('/home/so-invoice/'.$sq->kode_sq) }}" target="_blank" class="text-white">Lihat Invoice</a></button>
                @elseif($sq->status == 4)
                <form action="{{ url('/home/sq/delivery') }}" method="post" class="btn p-0" name="input-form" id="input-form">
                    {{ csrf_field() }}
                    <input type="text" id="kode_sq" value="{{$sq->kode_sq}}" name="kode_sq" hidden>
                    <button type="submit" onclick="return confirm('Confirm Delivery?');" class="btn btn-success">Delivery</button>
                </form>
                <button type="submit" class="btn  btn-dark"><a href="{{ url('/home/so-invoice/'.$sq->kode_sq) }}" target="_blank" class="text-white">Lihat Invoice</a></button>
                @elseif($sq->status == 5)
                <label>Metode Pembayaran : 
                  <span class="badge bg-success"> {{$sq->metode_pembayaran == 1 ? 'Cash' : 'Transfer'}}</span>
                </label><br>
                <label>Status Invoice : <span class="badge bg-success"> Invoice Paid</span></label>
                <br>
                <label>Status Pengiriman : <span class="badge bg-success">Delivered</span></label><br>
                <br>
                <button type="submit" class="btn  btn-dark"><a href="{{ url('/home/so-invoice/'.$sq->kode_sq) }}" target="_blank" class="text-white">Lihat Invoice</a></button>
                @endif
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