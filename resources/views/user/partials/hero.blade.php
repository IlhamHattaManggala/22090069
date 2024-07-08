<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center justify-content-center">
    <div class="container" data-aos="fade-up">
        @auth
        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
            <div class="col-xl-6 col-lg-8">
                <h1>Hai, {{ auth()->user()->name }}<span>.</span></h1>
                <h2>Bingung Pilih Karakter Genshin Impact? <span>{{ $website->nama }}</span> Solusinya</h2>
            </div>
        </div>
        @endauth

        @guest
        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
            <div class="col-xl-6 col-lg-8">
                <h1>Selamat Datang Di {{ $website->nama }}<span>.</span></h1>
                <h2>Bingung Pilih Karakter Genshin Impact? <span>{{ $website->nama }}</span> Solusinya</h2>
            </div>
        </div>
        @endguest

        <div class="row gy-4 mt-5 justify-content-center" data-aos="zoom-in" data-aos-delay="250">
            <div class="col-xl-2 col-md-4">
                <div class="icon-box">
                    <i class="ri-store-line"></i>
                    <h3><a href="">Daftar Karakter</a></h3>
                </div>
            </div>
            <div class="col-xl-2 col-md-4">
                <div class="icon-box">
                    <i class="ri-bar-chart-box-line"></i>
                    <h3><a href="">Metode Topsis</a></h3>
                </div>
            </div>
            <div class="col-xl-2 col-md-4">
                <div class="icon-box">
                    <i class="ri-calendar-todo-line"></i>
                    <h3><a href="">Metode SAW</a></h3>
                </div>
            </div>
        </div>

    </div>
</section><!-- End Hero -->