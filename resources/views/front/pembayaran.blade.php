@extends('layouts.frontend')

<style>
    .jumbotron {
  padding-top: 6rem;
  background-color: #e2edff;
}
#projects {
    
  background-color: #e2edff;
}
section {
  padding-top: 5rem;
}

</style>
@section('content')
      <body id="home">
           
        <!-- Jumbotron -->
        <section class="jumbotron text-center">
            <img src="{{ asset('/gambar/Img1.jpg')}}" alt="DCO" width="200px" class="rounded-circle img-thumbnail" />
            <h1 class="display-4">DCO</h1>
            <p class="lead">Jalan Sisingamangaraja, Sitoluama, Laguboti, Kabupaten Toba Samosir, Sumatera Utara</p>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path
              fill="#ffffff"
              fill-opacity="1"
              d="M0,96L60,133.3C120,171,240,245,360,240C480,235,600,149,720,133.3C840,117,960,171,1080,176C1200,181,1320,139,1380,117.3L1440,96L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"
            ></path>
          </svg>
        </section>
        <!-- Akhir Jumbotron -->
    
        <!-- About -->
        <section id="about">
          <div class="container">
            <div class="row text-center">
              <div class="col mb-3">
                <h2>Tentang Deltizen Corner</h2>
              </div>
              <div class="row justify-content-center fs-5 text-center">
                <div class="col-md-4">
                    <p> Deltizen Corner merupakan sebuah 
                        cafe yang menjual makanan dan 
                        minuman dengan berbagai menu. 
                        Usaha ini berlokasi di Jalan Sisingamangaraja, Sitoluama, Laguboti, Kabupaten Toba Samosir, Sumatera Utara. 
                        </p>
                </div>
                <div class="col-md-4">
                    Pemilik dari Deltizen Corner ini yaitu Bapak Hermanto Sinaga  
                </div>
                <div class="col-md-4">
                  Deltizen Corner saat ini memiliki pegawai sebanyak tiga 
                    orang. Cafe ini mulai berjualan dari pukul 08.00 WIB pagi sampai dengan pukul 22.00 WIB.
                </div>
              </div>
            </div>
          </div>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path
              fill="#e2edff"
              fill-opacity="1"
              d="M0,96L60,133.3C120,171,240,245,360,240C480,235,600,149,720,133.3C840,117,960,171,1080,176C1200,181,1320,139,1380,117.3L1440,96L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"
            ></path>
          </svg>
        </section>
        <!-- Akhir About -->
    
        <!-- Projects -->
        <section id="projects">
          <div class="container">
            <div class="row text-center mb-3">
              <div class="col mb-3">
                <h2>Suasana di Deltizen Corner</h2>
              </div>
              <div class="row justify-content-center">
                <div class="col-md-4 mb-3">
                  <div class="card">
                    <img src="{{ asset('/gambar/Img4.jpg')}}" class="card-img-top" alt="1" />
                    <div class="card-body">
                      <p class="card-text">Tampak depan Deltizen Corner</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 mb-3">
                  <div class="card">
                    <img src="{{ asset('/gambar/Img2.jpg')}}" class="card-img-top" alt="2" />
                    <div class="card-body">
                      <p class="card-text">Didalam Deltizen Corner</p>
                   </div>
                  </div>
                </div>
                <div class="col-md-4 mb-3">
                  <div class="card">
                    <img src="{{ asset('/gambar/Img3.jpg')}}" class="card-img-top" alt="3" />
                    <div class="card-body">
                      <p class="card-text">Didalam Deltizen Corner</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path
              fill="#0d6efd"
              fill-opacity="1"
              d="M0,96L60,133.3C120,171,240,245,360,240C480,235,600,149,720,133.3C840,117,960,171,1080,176C1200,181,1320,139,1380,117.3L1440,96L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"
            ></path>
          </svg>
        </section>
        <!-- Akhir Projects -->
    
    
        <!-- Akhir Contact -->
        <footer class="bg-primary text-white text-center pb-5">
          <p>Deltizen Corner <i class="bi bi-heart-fill text-danger"></i></p>
        </footer>
        <!-- Footer -->
    
        <!-- Akhir Footer -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
      </body>

@endsection