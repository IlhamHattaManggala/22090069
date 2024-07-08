<!-- ======= Footer ======= -->
<footer id="footer">
  <div class="footer-top">
    <div class="container">
      <div class="row">

        <div class="col-lg-3 col-md-6">
          <div class="footer-info">
            <h3>{{ $website->nama }}</h3>
            <p>
              Kab. Tegal, Jawa Tegah <br>
              Indonesia, Asia Tenggara<br><br>
              <strong>Instagram:</strong> @runtahhh__<br>
              <strong>Email:</strong> ilhamhattamanggala123@gmail.com<br>
            </p>
            <div class="social-links mt-3">
              <a href="https://www.facebook.com/ilham.hatta.714?mibextid=ZbWKwL" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="https://www.instagram.com/runtahhhh__?igsh=Znl6OGh2em5xbGl4" class="instagram"><i class="bx bxl-instagram"></i></a>
              <a href="https://www.linkedin.com/in/ilham-manggala-359277280?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
          </div>
        </div>
        @auth
        <div class="col-lg-2 col-md-6 footer-links">
          <h4>Links</h4>
          <ul>
            <li><i class="bx bx-chevron-right"></i> <a href="{{ route('user.home') }}">Beranda</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="{{ route('user.karakter') }}">Daftar Karakter</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="{{ route('user.rekomendasi') }}">Rekomendasi Karakter</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="{{ route('user.feedback') }}">Feedback</a></li>
          </ul>
        </div>
        @endauth
        @guest
        <div class="col-lg-2 col-md-6 footer-links">
          <h4>Links</h4>
          <ul>
            <li><i class="bx bx-chevron-right"></i> <a href="{{ route('home') }}">Beranda</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="{{ route('karakter') }}">Daftar Karakter</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="{{ route('login') }}">Login</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="{{ route('register') }}">Register</a></li>
          </ul>
        </div>
        @endguest

        <div class="col-lg-3 col-md-6 footer-links">
          <h4>Servis</h4>
          <ul>
            <li><i class="bx bx-chevron-right"></i> <a href="#">Desain Web</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="#">Pengembangan Web</a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-6 footer-newsletter">
          <h4>Terima Kasih</h4>
          <p>Terimakasih sudah menggunakan website ini, berikan feedback untuk pengembangan website ini</p>

        </div>

      </div>
    </div>
  </div>

  <div class="container">
    <div class="copyright">
      &copy; Copyright <strong><span>{{ $website->nama }}</span></strong> All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="https://www.linkedin.com/in/ilham-manggala-359277280?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app">Ilham Hatta Manggala</a>
    </div>
  </div>
</footer>