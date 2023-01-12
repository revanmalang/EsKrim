@extends('home.master')

@section('judul', 'Halaman Edit Status PO')

@section('isi')
    <div class="pagetitle">
      <h1>Edit Status Purchase Orders</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item">Purchasing</li>
          <li class="breadcrumb-item">Purchase Orders</li>
          <li class="breadcrumb-item active">Data Item Purchase Orders</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Item Purchase Orders</h5>
              
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

          <div class="card">
            <div class="card-body">
              @if($rfq->status < 5)
              <h5 class="card-title">Edit Status Purchase Orders</h5>
              @elseif($rfq->status == 5)
              <h5 class="card-title">Status Purchase Orders</h5>
              @endif
                @if($rfq->status == 1 )
                <form action="{{ url('/home/po/savePo') }}" method="post" class="btn p-0" name="input-form" id="input-form">
                    {{ csrf_field() }}
                    <input type="text" id="kode_rfq" value="{{$rfq->kode_rfq}}" name="kode_rfq" hidden>
                    <button type="submit" onclick="return confirm('Confirm Order?');" class="btn btn-success">Confirm Order</button>
                </form>
                @elseif($rfq->status == 2 )
                <form action="{{ url('/home/po/savePo') }}" method="post" class="btn p-0" name="input-form" id="input-form">
                    {{ csrf_field() }}
                    <input type="text" id="kode_rfq" value="{{$rfq->kode_rfq}}" name="kode_rfq" hidden>
                    <button type="submit" onclick="return confirm('Receive Product?');" class="btn btn-success">Receive Product</button>
                </form>
                @elseif($rfq->status == 3)
                <form action="{{ url('/home/po/savePo') }}" method="post" class="btn p-0" name="input-form" id="input-form">
                    {{ csrf_field() }}
                    <input type="text" id="kode_rfq" value="{{$rfq->kode_rfq}}" name="kode_rfq" hidden>
                    <button type="submit" onclick="return confirm('Validate?');" class="btn btn-success">Validate</button>
                </form>
                @elseif($rfq->status == 4)
                <form action="{{ url('/home/po/create-bill') }}" method="post" class="p-0" name="input-form" id="input-form">
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
                    <input type="text" id="kode_rfq" value="{{$rfq->kode_rfq}}" name="kode_rfq" hidden>
                    <button type="submit" onclick="return confirm('Create Bill?');" class="btn btn-success">Create Bill</button>
                </form>
                @elseif($rfq->status == 5)
                <label>Metode Pembayaran : 
                  <span class="badge bg-success"> {{$rfq->metode_pembayaran == 1 ? 'Cash' : 'Transfer'}}</span>
                </label><br>
                <label>Status Pembayaran : <span class="badge bg-success">Fully Billed</span></label><br>
                <br>
                <button type="submit" class="btn btn-dark"><a href="{{ url('/home/po-invoice/'.$rfq->kode_rfq) }}" target="_blank" class="text-white">Lihat Invoice</a></button>
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