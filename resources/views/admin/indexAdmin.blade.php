<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/busnela.png" alt="" height="50">
        <span class="d-none d-lg-block">BusNela</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <!-- ... Bagian lain dari dropdown ... -->
      <li class="nav-item dropdown pe-3">
        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <span class="d-none d-md-block dropdown-toggle ps-2" id="user-name-dropdown">
              <!-- Nama pengguna akan ditampilkan di sini -->
          </span>
      </a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <script>
              // Mengambil data nama pengguna dari Local Storage
              const name = localStorage.getItem('name');
              // Menetapkan nama pengguna ke elemen dengan ID 'user-name-dropdown'
              document.getElementById('user-name-dropdown').textContent = name;
              document.getElementById('name-head').textContent = name;

            </script>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                    <i class="bi bi-person"></i>
                    <span id="user-profile">My Profile</span>
                </a>
            </li>
          
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <a class="dropdown-item d-flex align-items-center" href="#" onclick="logout()">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Sign Out</span>
                </a>
                <script>
                function logout() {
                    // Menghapus data pengguna dari localStorage saat logout
                    localStorage.removeItem('name');
                    localStorage.removeItem('token');
                    localStorage.removeItem('role');
                    localStorage.removeItem('id_role');
                    localStorage.removeItem('npm');
                    localStorage.removeItem('isLoggedIn');
                    localStorage.removeItem('prodi')
                    localStorage.removeItem('id_major')
                    localStorage.removeItem('isAdmin')
                    localStorage.removeItem('isUser')
                    localStorage.removeItem('major_name')
                  
                    // Redirect ke halaman login atau halaman lain setelah logout
                    window.location.href = "login";
                  }
                  </script>
            </li>
        </ul><!-- End Profile Dropdown Items -->
      </li>
  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item mb-1">
        <a class="nav-link collapsed" href="{{ route('Admin.index') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
      
      <li class="nav-item mb-1">
        <a class="nav-link collapsed" href="{{ route('AdminPeminjaman.index') }}">
          <i class="bi bi-journal-text"></i>
          <span>Peminjaman</span>
        </a>
      </li><!-- End Peminjaman Nav -->
      
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('AdminProfile.index') }}">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Nav -->

      

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard pt-3">
      <div class="row">
        <!-- Left side columns -->
        <div class="col-md-3 mx-auto">
          <div class="card" style="width: 15rem;">
              <div class="card-body">
                  <h2 class="card-title text-center">Semua</h2>
                  <h1 class="text-center"><b> {{ $allCount }}</b></h1>
              </div>
          </div>
      </div>
        <div class="col-md-3 mx-auto">
          <div class="card" style="width: 15rem;">
              <div class="card-body">
                  <h2 class="card-title text-center">Total Pengajuan</h2>
                  <h1 class="text-center"><b> {{ $pendingCount }}</b></h1>
              </div>
          </div>
      </div>
      <div class="col-md-3 mx-auto">
          <div class="card" style="width: 15rem;">
              <div class="card-body">
                  <h2 class="card-title text-center">Pengajuan Diterima</h2>
                  <h1 class="text-center"><b>{{ $approvedCount }}</b></h1>
              </div>
          </div>
      </div>
      <div class="col-md-3 mx-auto">
          <div class="card" style="width: 15rem;">
              <div class="card-body">
                  <h2 class="card-title text-center">Pengajuan Ditolak</h2>
                  <h1 class="text-center"><b>{{ $rejectedCount }}</p></b></h1>
              </div>
          </div>
      </div>
      
        <div class="row mt-4">
            <div class="col-lg-10 mx-auto">
              <div class="card mb-5 mt-2 pb-5 pt-4">
                <table class="table align-middle mb-0 bg-white">
                  <thead class="bg-light">
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Tanggal</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($bookings as $peminjam)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $peminjam->user ? $peminjam->user->name : 'User Not Found' }}</td>
                    <td>{{ $peminjam->created_at }}</td>
                    <td>
                      @if($peminjam->id_status == 1)
                          <p class="statusPengajuan">Pengajuan</p>
                      @elseif($peminjam->id_status == 2)
                          <p class="statusDiterima" style="color: green"><b>Diterima</b></p>
                      @elseif($peminjam->id_status == 3)
                          <p class="statusDitolak" style="color: red"><b>Ditolak</b></p>
                      @else
                          Status Tidak Dikenal
                      @endif
                    </td>
                    <td>
                        <div class="d-grid gap-1 col-3">
                          <a class="btn btn-sm btn-success" href="{{ route('AdminPeminjaman.show', $peminjam->id) }}">Detail</a>
                        </div>
                    </td>
                </tr>
            @endforeach
                          
                      
                  </tbody>
                </table>
              </div>
            </div>
            </div>
        </div>
        </div><!-- End Right side columns -->
      </div>
    </section>

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
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>