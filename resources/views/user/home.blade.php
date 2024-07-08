@extends('user.master-home')

@section('tittle')
Beranda
@endsection

@section('main')
<main id="main">

  <!-- ======= About Section ======= -->
  <section id="about" class="about">
    <div class="container" data-aos="fade-up">
      <div class="row">
        <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
          <img src="../AdminLTE/dist/img/image1.jpg" class="img-fluid rounded" alt="Genshin Impact Characters">
        </div>
        <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content" data-aos="fade-right" data-aos-delay="100">
          <h3>Sistem Pendukung Keputusan Pemilihan Karakter Genshin Impact</h3>
          <p class="fst-italic">
            Selamat datang di sistem pendukung keputusan pemilihan karakter Genshin Impact! Kami hadir untuk membantu Anda memilih karakter terbaik sesuai kebutuhan Anda.
          </p>
          <ul>
            <li><i class="ri-check-double-line"></i> Analisis mendalam berdasarkan statistik dan kemampuan karakter.</li>
            <li><i class="ri-check-double-line"></i> Rekomendasi karakter terbaik untuk berbagai skenario permainan.</li>
            <li><i class="ri-check-double-line"></i> Alat yang mudah digunakan untuk membandingkan berbagai karakter.</li>
          </ul>
          <p>
            Dengan sistem kami, Anda dapat membuat keputusan yang lebih baik dan strategis dalam memilih karakter untuk tim Anda. Kami menggunakan metode analitik canggih untuk memberikan saran yang akurat dan dapat diandalkan.
          </p>
        </div>
      </div>
    </div>
  </section>


  <!-- ======= Clients Section ======= -->
  <section id="clients" class="clients">
    <div class="container" data-aos="zoom-in">

      <div class="clients-slider swiper">
        <div class="swiper-wrapper align-items-center">
          <div class="swiper-slide"><img src="../AdminLTE/dist/img/pyro.png" class="img-fluid" alt=""></div>
          <div class="swiper-slide"><img src="../AdminLTE/dist/img/hydro.png" class="img-fluid" alt=""></div>
          <div class="swiper-slide"><img src="../AdminLTE/dist/img/Dendro.png" class="img-fluid" alt=""></div>
          <div class="swiper-slide"><img src="../AdminLTE/dist/img/Geo.png" class="img-fluid" alt=""></div>
          <div class="swiper-slide"><img src="../AdminLTE/dist/img/Anemo.png" class="img-fluid" alt=""></div>
          <div class="swiper-slide"><img src="../AdminLTE/dist/img/Electro.png" class="img-fluid" alt=""></div>
          <div class="swiper-slide"><img src="../AdminLTE/dist/img/Cryo.png" class="img-fluid" alt=""></div>
        </div>
        <div class="swiper-pagination"></div>
      </div>

    </div>
  </section><!-- End Clients Section -->

  <!-- ======= Features Section ======= -->
  <section id="features" class="features">
    <div class="container" data-aos="fade-up">
      <div class="row">
        <div class="image col-lg-6 rounded" style='background-image: url("../AdminLTE/dist/img/image2.jpg");' data-aos="fade-right"></div>
        <div class="col-lg-6" data-aos="fade-left" data-aos-delay="100">
          <div class="icon-box mt-5 mt-lg-0" data-aos="zoom-in" data-aos-delay="150">
            <i class="bx bx-calculator"></i>
            <h4>Perhitungan TOPSIS</h4>
            <p>Gunakan metode TOPSIS untuk menganalisis dan menentukan karakter terbaik berdasarkan berbagai kriteria.</p>
          </div>
          <div class="icon-box mt-5" data-aos="zoom-in" data-aos-delay="150">
            <i class="bx bxs-analyse"></i>
            <h4>Perhitungan SAW</h4>
            <p>Implementasi metode SAW untuk evaluasi dan pemilihan karakter yang optimal sesuai kebutuhan Anda.</p>
          </div>
          <div class="icon-box mt-5" data-aos="zoom-in" data-aos-delay="150">
            <i class="bx bx-list-ul"></i>
            <h4>Daftar Karakter</h4>
            <p>Telusuri daftar lengkap karakter Genshin Impact dengan informasi detail tentang kemampuan dan statistik mereka.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Features Section -->

  <!-- ======= Cta Section ======= -->
  @include('user.partials.call-to-action')<!-- End Cta Section -->

  <!-- ======= Services Section ======= -->
  <section id="services" class="services">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Kriteria</h2>
        <p>Kriteria Perhitungan</p>
      </div>

      <div class="row">
        @foreach ($nilaiHome as $kolom)
        <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
          <div class="icon-box w-100 m-3">
            <div class="icon"><i class='bx bxs-check-circle bx-burst'></i></div>
            <!-- <div class="icon"><i class='bx bxs-badge-check'></i></div> -->
            <h4><a href="">{{ ucwords(str_replace('_', ' ', $kolom)) }}</a></h4>
          </div>
        </div>
        @endforeach
      </div>

    </div>
  </section><!-- End Services Section -->


</main><!-- End #main -->

@endsection