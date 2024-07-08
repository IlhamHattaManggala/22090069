@extends('user.master-home')

@section('tittle')
Daftar Karakter
@endsection

@section('main')
<main id="main">

    <section class="about section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Apa itu Genshin Impact?</h2>
        </div><!-- End Section Title -->
        <div class="container">
            <div class="row gy-1">
                <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
                    <p style="font-size: 18px; text-align: justify;">Genshin Impact adalah permainan aksi RPG yang dikembangkan oleh miHoYo, diluncurkan pada September 2020. Game ini menawarkan dunia terbuka yang luas dan memukau bernama Teyvat, yang terdiri dari tujuh wilayah yang masing-masing terinspirasi oleh berbagai budaya dan mitologi dunia nyata. Pemain berperan sebagai "Traveler," yang menjelajahi dunia ini untuk mencari saudara kembarnya yang hilang, sambil mengungkap rahasia dan misteri yang menyelimuti Teyvat. Dunia Genshin Impact dikenal dengan grafis yang indah, mekanisme pertarungan berbasis elemen, dan alur cerita yang mendalam dan menarik.</p>
                    <p style="font-size: 18px; text-align: justify;">Salah satu fitur paling menonjol dari Genshin Impact adalah sistem gacha, yang memungkinkan pemain untuk mendapatkan karakter dan senjata baru melalui undian acak. Setiap karakter memiliki elemen dan kemampuan unik yang dapat digunakan dalam pertempuran melawan berbagai musuh dan bos. Selain itu, pemain dapat membentuk tim dengan maksimal empat karakter untuk memanfaatkan kombinasi elemen yang strategis dalam pertarungan. Game ini juga mendukung mode multiplayer kooperatif, memungkinkan pemain untuk menjelajahi dunia Teyvat bersama teman-teman. Genshin Impact terus diperbarui dengan konten baru, termasuk wilayah baru, karakter, dan misi, yang membuat permainan ini tetap segar dan menarik bagi para pemainnya.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="about section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Apa itu Karakter Dalam Genshin Impact?</h2>
        </div><!-- End Section Title -->
        <div class="container">
            <div class="row gy-1">
                <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
                    <p style="font-size: 18px; text-align: justify;">
                        Karakter dalam Genshin Impact adalah elemen inti dari permainan yang memberikan berbagai kemampuan dan keterampilan yang unik kepada pemain. Setiap karakter memiliki elemen tertentu, seperti Anemo (angin), Pyro (api), Hydro (air), Electro (listrik), Dendro (alam), Cryo (es), dan Geo (tanah). Elemen-elemen ini memainkan peran penting dalam pertempuran, teka-teki, dan eksplorasi di dunia Teyvat. Setiap karakter juga memiliki senjata khusus, mulai dari pedang, claymore, tombak, busur, hingga katalis, yang memberikan gaya bertarung berbeda dan strategi yang bervariasi dalam menghadapi musuh.
                    </p>
                    <p style="font-size: 18px; text-align: justify;">
                        Karakter-karakter ini tidak hanya berbeda dalam hal kemampuan dan elemen, tetapi juga memiliki latar belakang cerita dan kepribadian yang mendalam, yang diungkap melalui berbagai misi dan interaksi dalam permainan. Pemain dapat mengumpulkan karakter-karakter ini melalui sistem gacha yang disebut "Wish", di mana mereka dapat mengundi untuk mendapatkan karakter dan senjata baru. Kombinasi karakter yang tepat dalam tim dapat menghasilkan sinergi elemen yang kuat dan efektif dalam pertempuran, sehingga menambah kedalaman strategi dalam permainan. Selain itu, pengembang miHoYo terus memperkenalkan karakter baru dan memperbarui cerita, yang membuat Genshin Impact tetap segar dan menarik bagi para pemainnya.
                    </p>
                </div>
            </div>
        </div>
    </section>

    @include('user/partials/call-to-action')

    <section id="portfolio" class="portfolio">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Galeri</h2>
                <p>Galeri Genshin Impact</p>
            </div>

            <div class="row" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-12 d-flex justify-content-center">
                    <ul id="portfolio-flters">
                        <li data-filter="*" class="filter-active">All</li>
                        <li data-filter=".filter-mondstadt">Mondstadt</li>
                        <li data-filter=".filter-liyue">Liyue</li>
                        <li data-filter=".filter-inazuma">Inazuma</li>
                        <li data-filter=".filter-sumeru">Sumeru</li>
                        <li data-filter=".filter-fontaine">Fontaine</li>
                        <li data-filter=".filter-snezhnaya">Snezhnaya</li>
                    </ul>
                </div>
            </div>

            <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
                @foreach (['mondstadt' => $mondstadt, 'liyue' => $liyue, 'inazuma' => $inazuma, 'sumeru' => $sumeru, 'fontaine' => $fontaine, 'snezhnaya' => $snezhnaya] as $region => $characters)
                @foreach ($characters as $index => $charlist)
                <div class="col-lg-2 col-md-2 portfolio-item filter-{{ $region }}">
                    <div class="portfolio-wrap">
                        <img src="{{ $charlist->base64Image1 }}" class="img-fluid w-100" alt="">
                        <div class="portfolio-info">
                            <h4>{{ $charlist->nama }}</h4>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#modal{{ $region . $index }}">More Info</a>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modal{{ $region . $index }}" tabindex="-1" aria-labelledby="modal{{ $region . $index }}Label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal{{ $region . $index }}Label">Informasi Karakter</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-3">
                                        <img src="{{ $charlist->base64Image1 }}" class="card-img-top" alt="{{ $charlist->nama }}">
                                    </div>
                                    <div class="col-9">
                                        <ul class="list-group list-group-unbordered mb-3">
                                            <li class="list-group-item">
                                                <div class="d-flex justify-content-between">
                                                    <b>Nama</b> <span class="text-muted">{{ $charlist->nama }}</span>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="d-flex justify-content-between">
                                                    <b>Element</b> <span class="text-muted">{{ $charlist->element }}</span>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="d-flex justify-content-between">
                                                    <b>Region</b> <span class="text-muted">{{ $charlist->region }}</span>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="d-flex justify-content-between">
                                                    <b>Rarity</b> <span class="text-muted">{{ $charlist->rarity }}</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    @foreach ($columnOrder as $column)
                                                    <th scope="col" class="bg-dark">{{ ucwords(str_replace('_', ' ', $column)) }}</th>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($charlist->nilai->isNotEmpty())
                                                <tr>
                                                    @foreach ($charlist->nilai as $nilai)
                                                    @foreach ($columnOrder as $column)
                                                    <td>{{ str_replace('.0', '', $nilai->$column) }}</td>
                                                    @endforeach
                                                    @endforeach
                                                </tr>
                                                @else
                                                <tr>
                                                    <td colspan="{{ count($columnOrder) }}">Data nilai tidak tersedia.</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endforeach
            </div>

        </div>
    </section>


    <section id="download" class="download section">
        <div class="container">
            <div class="card text-white p-4" style="background-color: #37517e; border-radius: 10px">
                <div class="row gy-4">
                    <div class="col-lg-8 d-flex flex-column justify-content-center text-white" data-aos="fade-up">
                        <h2 class="text-white">Unduh Genshin Impact</h2>
                        <p style="font-size: 18px; text-align: justify;">
                            Genshin Impact adalah permainan aksi RPG yang dikembangkan oleh miHoYo dan dirilis pada September 2020. Permainan ini tersedia untuk diunduh dan dimainkan di berbagai platform, termasuk PlayStation 4, PlayStation 5, Windows PC, iOS, Android, dan macOS.
                        </p>
                        <div class="download-links mt-4">
                            <a href="https://play.google.com/store/apps/details?id=com.miHoYo.GenshinImpact" target="_blank" class="download-link">
                                <i class="fab fa-google-play fa-3x"></i>
                                <span>Download For Android</span>
                            </a>
                            <a href="https://www.microsoft.com/store/apps/9MX3N1QT60C8" target="_blank" class="download-link">
                                <i class="fab fa-windows fa-3x"></i>
                                <span>Download For Windows</span>
                            </a>
                            <a href="https://apps.apple.com/app/id1517783697" target="_blank" class="download-link">
                                <i class="fab fa-apple fa-3x"></i>
                                <span>Download For Apple</span>
                            </a>
                            <a href="https://genshin.mihoyo.com/en/download" target="_blank" class="download-link">
                                <i class="fab fa-linux fa-3x"></i>
                                <span>Download For Linux</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                        <img src="../AdminLTE/dist/img/wallpaper-download.jpg" class="img-fluid animated img-fluid" style="border-radius: 20px;" alt="Genshin Impact">
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

@endsection