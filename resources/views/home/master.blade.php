<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('judul')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('backend/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('backend/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('backend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/vendor/simple-datatables/style.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('backend/css/style.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.2.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="/home" class="logo d-flex align-items-center">
        <img src="{{ asset('backend/img/logo.png') }}" alt="">
        <span class="d-none d-lg-block">Es  Krim</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="{{ asset('backend/img/profile-img.jpg') }}" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->name }}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{ auth()->user()->name }}</h6>
              <span>{{ auth()->user()->level }}</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}">
                <i class="bi bi-box-arrow-right"></i>
                <span>Log Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="/home">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-heading">Manufacturing</li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#produk-nav" data-bs-toggle="collapse" href="#">
          <i class="bx bx-package"></i><span>Produk</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="produk-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/home/produk">
              <i class="bi bi-circle"></i><span>Data Produk</span>
            </a>
          </li>
          <li>
            <a href="/home/produk/tambah">
              <i class="bi bi-circle"></i><span>Tambah Produk</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#bahan-nav" data-bs-toggle="collapse" href="#">
          <i class="bx bx-shopping-bag"></i><span>Bahan</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="bahan-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/home/bahan">
              <i class="bi bi-circle"></i><span>Data Bahan</span>
            </a>
          </li>
          <li>
            <a href="/home/bahan/tambah">
              <i class="bi bi-circle"></i><span>Tambah Bahan</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#bom-nav" data-bs-toggle="collapse" href="#">
          <i class="bx bx-notepad"></i><span>Bill of Material</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="bom-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/home/bom">
              <i class="bi bi-circle"></i><span>Data BOM</span>
            </a>
          </li>
          <li>
            <a href="/home/bom-input">
              <i class="bi bi-circle"></i><span>Tambah BOM</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#mo-nav" data-bs-toggle="collapse" href="#">
          <i class="ri ri-clipboard-line"></i><span>Manufacturing Order</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="mo-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/home/mo">
              <i class="bi bi-circle"></i><span>Data MO</span>
            </a>
          </li>
          <li>
            <a href="/home/mo-input">
              <i class="bi bi-circle"></i><span>Tambah MO</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-heading">Purchasing</li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#vendor-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-truck"></i><span>Vendor</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="vendor-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/home/vendor">
              <i class="bi bi-circle"></i><span>Data Vendor</span>
            </a>
          </li>
          <li>
            <a href="/home/vendor/tambah">
              <i class="bi bi-circle"></i><span>Tambah Vendor</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#rfq-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-cart-plus"></i><span>Request For Quotation</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="rfq-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/home/rfq">
              <i class="bi bi-circle"></i><span>Data RFQ</span>
            </a>
          </li>
          <li>
            <a href="/home/rfq-input">
              <i class="bi bi-circle"></i><span>Tambah RFQ</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#purchase-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-cart-fill"></i><span>Purchase Orders</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="purchase-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/home/po">
              <i class="bi bi-cart-fill"></i><span>Data Purchase Order</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-heading">Sales</li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#pembeli-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-person"></i><span>Pembeli</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="pembeli-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/home/pembeli">
              <i class="bi bi-circle"></i><span>Data Pembeli</span>
            </a>
          </li>
          <li>
            <a href="/home/pembeli/tambah">
              <i class="bi bi-circle"></i><span>Tambah Pembeli</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#quotation-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bag-plus"></i><span>Sales Quotation</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="quotation-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/home/sq">
              <i class="bi bi-circle"></i><span>Data Sales Quotation</span>
            </a>
          </li>
          <li>
            <a href="/home/sq-input">
              <i class="bi bi-circle"></i><span>Tambah Sales Quotation</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#order-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bag-fill"></i><span>Sales Orders</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="order-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/home/so">
              <i class="bi bi-circle"></i><span>Data Sales Order</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-heading">Accounting</li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#accounting-nav" data-bs-toggle="collapse" href="#">
          <i class="ri ri-calculator-line"></i><span>Accounting</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="accounting-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/home/accounting">
              <i class="bi bi-circle"></i><span>Data Accounting</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">
    @yield('isi')
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('backend/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('backend/vendor/chart.js/chart.min.js') }}"></script>
  <script src="{{ asset('backend/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('backend/vendor/quill/quill.min.js') }}"></script>
  <script src="{{ asset('backend/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('backend/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('backend/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('backend/js/main.js') }}"></script>

</body>

</html>