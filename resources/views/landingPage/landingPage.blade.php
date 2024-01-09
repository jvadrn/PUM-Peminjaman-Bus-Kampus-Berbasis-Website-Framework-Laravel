<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Beranda</title>

    <!-- css -->
    <link rel="stylesheet" href="assets/css/cssLandingPage.css">
    {{-- responsive --}}
    <link rel="stylesheet" href="css/responsive.css">

    <!-- Font Google-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- end Font Google-->

    <!-- css -->
    <link rel="stylesheet" href="css/style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body style="background-color: ">
    {{-- Start Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent position-fixed w-100" data-bs-theme="dark">
      <div class="container">
        <a class="navbar-brand" href="#">BusNela</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item mx-3">
              <a class="nav-link active" aria-current="page" href="#">Beranda</a>
            </li>
            <li class="nav-item mx-3">
              <a class="nav-link" href="#">Produk</a>
            </li>
            <li class="nav-item mx-3">
              <a class="nav-link" href="#">Sewa</a>
            </li>
            <li class="nav-item mx-3">
              <a class="nav-link" href="#">Tentang Kami</a>
            </li>
          </ul>
          <div>
            <ul class="navbar-nav">
              <li class="nav-item">
                <li class="nav-item mx-3">
                    <a class="btn bg-transparent" href="login">Login</a>
                </li>
              </li>
          </div>
        </div>
      </div>
    </nav>
    {{-- end Navbar --}}

    {{-- Hero Section --}}
    <section id="hero">
    <div class="container h-100 py-5">
      <div class="row my-5">
        <div class="col-md-6 hero-tagline">
          <h1>"Tumpangkan Impianmu, Selesaikan Perjalananmu!"</h1>
          <p><span class="fw-bold">BusNela</span> Layanan peminjaman bus kampus ! Menawarkan solusi transportasi yang efisien dan nyaman untuk keperluan perjalanan kelompok di dalam dan sekitar kampus.</p>
          <div class="button-sewa text-center">
            <a class="btn" href="" role="button"><span class="text fw-bold">Sewa Sekarang</span></a>
          </div>
        </div>
        <div class="col-md-6">
          <img src="https://www.bluebirdgroup.com/storage/armadaservicecars/6268f216178fd.png" alt="" class="img-fluid" width="700">
        </div>
      </div>
    </div>
    </div>
  </section>
    {{-- End Hero Section --}}
    <section id="jenis-bus">
      <div class="main-content">
        <div class="container h-100 ">
          <div class="row py-5 ">
            <div class="col-12 hero-text">
              <h1>B U S N E L A</h1>
              <p>Nikmati sepenuhnya keuntungan berkendara 
                bersama <b>BusNela.</b></p>
            </div>
          </div>
          <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col mb-3 pb-5">
              <div class="card h-100">
                <img src="https://www.bluebirdgroup.com/storage/armadaservicecars/6268f216178fd.png" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
              </div>
            </div>
            <div class="col mb-3 pb-5">
              <div class="card h-100">
                <img src="https://www.bluebirdgroup.com/storage/armadaservicecars/6268f216178fd.png" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">This is a short card.</p>
                </div>
              </div>
            </div>
            <div class="col mb-3 pb-5">
              <div class="card h-100">
                <img src="https://www.bluebirdgroup.com/storage/armadaservicecars/6268f216178fd.png" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    {{-- Section Promo --}}
    <section id="hero" class="my-5">
      <div class="container ">
        <div class="row">
          <div class="col md-12">
            <h1 class="text-center text-light">Promo Perjalanan</h1>
            <div id="carouselExampleSlidesOnly" class="carousel slide my-3" data-bs-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="https://www.bluebirdgroup.com/storage/promotion/656d47ff13a6f.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="https://www.bluebirdgroup.com/storage/promotion/656da19f9afba.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="https://www.bluebirdgroup.com/storage/news/651ceae5357a7.jpg" class="d-block w-100" alt="...">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    {{-- end section promo --}}
    <script src="assets/js/jsLandingPage.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
  <footer class=" text-center text-lg-start my-5">
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
    
      <a class="text-body" href="https://mdbootstrap.com/">MDBootstrap.com</a>
    </div>
    <!-- Copyright -->
  </footer>
</html> 