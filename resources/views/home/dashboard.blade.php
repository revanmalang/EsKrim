@extends('home.master')

@section('judul', 'Halaman Dashboard')

@section('isi')
    <div class="pagetitle">
      <h1>Selamat Datang di Halaman Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/admin">Home</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-6">
            Halaman Dashboard
        </div>
      </div>
    </section>
@endsection
