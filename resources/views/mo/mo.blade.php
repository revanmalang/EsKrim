@extends('home.master')

@section('judul', 'Halaman Data MO')

@section('isi')
    <div class="pagetitle">
      <h1>Data Manufacturing Order</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item">MO</li>
          <li class="breadcrumb-item active">Data MO</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Manufacturing Order</h5>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <div class="card-body">
                    <a href="/home/mo-input"><button type="button" class="btn btn-primary">Tambah Manufacturing Order</button></a>
                    <a href="/home/mo/cetak" target="_blank"><button type="button" class="btn btn-secondary">Cetak</button></a>
                </div>
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Kode MO</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Kuantitas</th>
                    <th scope="col">Tanggal Order</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @if($moDatas->count())
                  @foreach($moDatas as $item)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$item->kode_mo}}</td>
                      <td>{{$item->nama}}</td>
                      <td>{{$item->kuantitas}}</td>
                      <td>{{$item->tanggal}}</td>
                      <td>
                        @if($item->status == 1 )
                        <span class="badge bg-primary">Draft</span>
                        @elseif($item->status == 2)
                        <span class="badge bg-secondary">Mark as Todo</span>
                        @elseif($item->status == 3)
                        <a href="{{ url('/home/mo-ca/'.$item->kode_mo) }}"><span class="badge bg-warning text-dark">Check Availability</span></a>
                        @elseif($item->status == 4)
                        <span class="badge bg-info text-dark">Production</span>
                        @elseif($item->status == 5)
                        <span class="badge bg-success">Done</span>
                        @endif
                      </td>
                      <td>
                        @if($item->status == 1 )
                        <form action="/home/mo/update/{{$item->kode_mo}}" method="post">
                          @method('put')
                          {{ csrf_field() }}
                          <button  type="submit" onclick="return confirm('Proses Mark as Todo?');" class="btn btn-info">Mark as Todo</button>
                        </form>
                        @elseif($item->status == 2)
                        <form action="/home/mo/update/{{$item->kode_mo}}" method="post">
                          @method('put')
                          {{ csrf_field() }}
                          <button  type="submit" onclick="return confirm('Proses Check Availability?');" class="btn btn-info">Check Availability</button>
                        </form>
                        @elseif($item->status == 3)
                        <form action="/home/mo-produce/{{$item->kode_mo}}" method="post">
                          {{ csrf_field() }}
                          <button  type="submit" onclick="return confirm('Proses Produce?');" class="btn btn-info">Produce</button>
                        </form>
                        @elseif($item->status == 4) 
                        <form action="/home/mo-done/{{$item->kode_mo}}" method="post">
                          @method('post')
                          {{ csrf_field() }}
                          <button  type="submit" onclick="return confirm('Sudah selesai?');" class="btn btn-info">Mark as done</button>
                        </form>
                          @endif
                        </form>
                        <a href="{{ url('/home/mo-delete/'.$item->kode_mo) }}" class="btn btn-danger delete-confirm">Hapus</a>
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