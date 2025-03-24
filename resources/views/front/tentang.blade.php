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
            <img src="{{ asset('/gambar/Img1.jpg')}}" alt="WrBarokah" width="200px" class="rounded-circle img-thumbnail" />
            <h1 class="display-4">Warung Makan Barokah</h1>
            <p class="lead">Jalan Bakulan-Imogiri, Jetis, Bantul, Yogyakarta</p>
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
                <h2>Tentang Warung Makan Barokah</h2>
              </div>
              <div class="row justify-content-center fs-5 text-center">
                <div class="col-md-4">
                    <p> Warung makan barokah merupakan sebuah 
                        warung makan sederhana yang menjual makanan dan 
                        minuman dengan sajian utama yaitu masakan soto. 
                        Usaha ini berlokasi di Jalan Bakulan-Imogiri, Jetis, Bantul, zYogyakarta. 
                        </p>
                </div>
                <div class="col-md-4">
                    Pemilik dari warung makan barokah ini yaitu Purwanta Sudarma yang 
                    berusia 65 tahun menuturkan bahwa warung ini telah berdiri sejak tahun 
                    1990-an yang telah berganti lokasi sebanyak satu kali, dikarenakan masalah 
                    sengketa tanah.  
                </div>
                <div class="col-md-4">
                    Warung makan barokah saat ini memiliki pegawai sebanyak enam 
                    orang dan mayoritas berasal dari keluarga pemilik usaha sendiri. Warung makan 
                    ini mulai berjualan dari pukul 07.00 WIB pagi sampai dengan pukul 17.00 WIB.
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
                <h2>Suasana di Warung Makan Barokah</h2>
              </div>
              <div class="row justify-content-center">
                <div class="col-md-4 mb-3">
                  <div class="card">
                    <img src="{{ asset('/gambar/Img4.jpg')}}" class="card-img-top" alt="1" />
                    <div class="card-body">
                      <p class="card-text">Tampak depan warung makan barokah</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 mb-3">
                  <div class="card">
                    <img src="{{ asset('/gambar/Img2.jpg')}}" class="card-img-top" alt="2" />
                    <div class="card-body">
                      <p class="card-text">Didalam warung makan barokah</p>
                   </div>
                  </div>
                </div>
                <div class="col-md-4 mb-3">
                  <div class="card">
                    <img src="{{ asset('/gambar/Img3.jpg')}}" class="card-img-top" alt="3" />
                    <div class="card-body">
                      <p class="card-text">Didalam warung makan barokah</p>
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
          <p>Warung Makan Barokah <i class="bi bi-heart-fill text-danger"></i></p>
        </footer>
        <!-- Footer -->
    
        <!-- Akhir Footer -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
      </body>

@endsection