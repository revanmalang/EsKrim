@extends('home.master')

@section('judul', 'Halaman Data Accounting')

@section('isi')
    <div class="pagetitle">
      <h1>Data Accounting</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item">Accounting</li>
          <li class="breadcrumb-item active">Data Accounting</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Accounting</h5>

              <!-- Table with stripped rows -->
                <div class="card-body">
                    <a href="/home/accounting-invoicing"><button type="button" class="btn btn-primary w-100">Customer Invoicing</button></a>
                    <br>
                    <br>
                    <a href="/home/accounting-bill"><button type="button" class="btn btn-secondary w-100">Vendor Bill</button></a>
                </div>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>
@endsection