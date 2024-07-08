@extends('user.master-home')

@section('tittle')
Rekomendasi Karakter
@endsection

@section('main')
<main id="main">

    <section class="about section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Apa itu Metode Simple Additive Weighting (SAW)?</h2>
        </div><!-- End Section Title -->
        <div class="container">
            <div class="row gy-1">
                <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
                    <p style="font-size: 18px; text-align: justify;">Metode SAW atau Simple Additive Weighting adalah salah satu metode dalam Sistem Pendukung Keputusan (SPK) yang digunakan untuk pemilihan alternatif terbaik berdasarkan sejumlah kriteria. Metode ini sering juga disebut metode penjumlahan terbobot.</p>
                    <p>Langkah-langkah:</p>
                    <li style="list-style-type: none;"><i class='bx bx-check'></i> Menentukan Kriteria</li>
                    <li style="list-style-type: none;"><i class='bx bx-check'></i> Membuat Matriks Keputusan</li>
                    <li style="list-style-type: none;"><i class='bx bx-check'></i> Normalisasi Matriks Keputusan</li>
                    <li style="list-style-type: none;"><i class='bx bx-check'></i> Menghitung Skor Akhir</li>
                    <li style="list-style-type: none;"><i class='bx bx-check'></i> Menentukan Alternatif Terbaik</li>
                </div>
            </div>
        </div>
    </section>

    <section class="about section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Apa itu Metode Technique for Order of Preference by Similarity to Ideal Solution (TOPSIS)?</h2>
        </div><!-- End Section Title -->
        <div class="container">
            <div class="row gy-1">
                <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
                    <p style="font-size: 18px; text-align: justify;">
                        Metode TOPSIS atau Technique for Order of Preference by Similarity to Ideal Solution adalah metode lain dalam SPK yang digunakan untuk memilih alternatif terbaik dengan mempertimbangkan jarak terpendek dari solusi ideal positif dan jarak terjauh dari solusi ideal negatif.
                    </p>
                    <p>Langkah-langkah:</p>
                    <li style="list-style-type: none;"><i class='bx bx-check'></i> Menentukan Kriteria</li>
                    <li style="list-style-type: none;"><i class='bx bx-check'></i> Membuat Matriks Keputusan</li>
                    <li style="list-style-type: none;"><i class='bx bx-check'></i> Normalisasi Matriks Keputusan</li>
                    <li style="list-style-type: none;"><i class='bx bx-check'></i> Membuat Matriks Keputusan Ternormalisasi Terbobot</li>
                    <li style="list-style-type: none;"><i class='bx bx-check'></i> Menentukan Solusi Ideal Positif dan Negatif</li>
                    <li style="list-style-type: none;"><i class='bx bx-check'></i> Menghitung Jarak ke Solusi Ideal</li>
                    <li style="list-style-type: none;"><i class='bx bx-check'></i> Menghitung Nilai Preferensi</li>
                    <li style="list-style-type: none;"><i class='bx bx-check'></i> Menentukan Alternatif Terbaik</li>
                </div>
            </div>
        </div>
    </section>

    @include('user/partials/call-to-action')

    <section id="rekomendasi" class="section rekomendasi">
        <div class="container mt-4">
            <h2 class="text-center" data-aos="fade-up" data-aos-delay="100">Rekomendasi Karakter</h2>
            @if ($latestBobot)
            <form method="POST" action="{{ route('user.addCharacter') }}" data-aos="fade-up" data-aos-delay="200">
                @csrf
                <div class="row mb-4">
                    <div class="col-md-8">
                        <select name="character_id" id="character-select" class="form-control">
                            <option value="">Pilih Karakter</option>
                            @foreach($allCharacters as $character)
                            <option value="{{ $character->id_karakter }}">{{ $character->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary btn-block">Add</button>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered" id="character-table">
                        <thead>
                            <tr>
                                <th style="width: 100px;">No</th>
                                <th style="width: 800px;">Nama</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($characters as $index => $character)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $character->nama }}</td>
                                <td>
                                    <form method="POST" action="{{ route('user.deleteCharacter', $character->id_karakter) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @else
            <div class="alert alert-danger" role="alert" data-aos="fade-up" data-aos-delay="200">
                Anda Belum Memasukkan Bobot
            </div>
            @endif

            <div class="row mt-4">
                <div class="col-md-2 mt-2" data-aos="fade-up" data-aos-delay="100">
                    <button type="button" class="btn btn-outline-dark btn-block" data-bs-toggle="modal" data-bs-target="#modalForm">Pembobotan</button>
                </div>
                @php
                $charCollect = collect(session('characters', []));
                @endphp
                @if ($charCollect->count() > 1)
                <div class="col-md-3 mt-2" data-aos="fade-up" data-aos-delay="300">
                    <button type="button" class="btn btn-outline-dark btn-block" data-bs-toggle="modal" data-bs-target="#modalPerhitunganSAW">Lihat Perhitungan SAW</button>
                </div>
                <div class="col-md-3 mt-2" data-aos="fade-up" data-aos-delay="300">
                    <button type="button" class="btn btn-outline-dark btn-block" data-bs-toggle="modal" data-bs-target="#modalPerhitungan">Lihat Perhitungan Topsis</button>
                </div>
                <div class="col-md-2 mt-2" data-aos="fade-up" data-aos-delay="300">
                    <a href="{{ route('user.hitungTopsis') }}" class="btn btn-outline-warning btn-block">Hitung Topsis</a>
                </div>
                <div class="col-md-2 mt-2" data-aos="fade-up" data-aos-delay="300">
                    <a href="{{ route('user.hitungSAW') }}" class="btn btn-outline-warning btn-block">Hitung SAW</a>
                </div>
                @else
                <div class="col-md-8 mt-2">
                    <div class="alert alert-danger" role="alert" data-aos="fade-up" data-aos-delay="300">
                        Anda Harus Memasukkan Lebih dari 1 Karakter
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>

    <section class="section perhitungan" id="perhitungan">
        <div class="container">
            <div class="row mt-2">
                @if(session()->has('ranked_data_topsis'))
                <h2 class="mb-4" data-aos="fade-up" data-aos-delay="100">Hasil Perhitungan Rekomendasi Karakter Menggunakan Metode Topsis</h2>
                @foreach(session()->get('ranked_data_topsis', []) as $rankedItem)
                <div class="col-md-3 mb-4">
                    <div class="card" data-aos="fade-up" data-aos-delay="200">
                        @if(isset($rankedItem->gambar_karakter))
                        <img src="data:image/jpeg;base64,{{ base64_encode($rankedItem->gambar_karakter) }}" class="card-img-top" alt="{{ $rankedItem->nama_karakter }}">
                        @else
                        <div class="text-center pt-3 pb-3">
                            Image not available
                        </div>
                        @endif
                        <div class="card-body">
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between">
                                        <b>Nama</b> <span class="text-muted">{{ $rankedItem->nama_karakter }}</span>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between">
                                        <b>Ranking</b> <span class="text-muted">{{ $rankedItem->rank }}</span>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between">
                                        <b>Nilai</b> <span class="text-muted">{{ number_format($rankedItem->nilai_preferensi, 3) }}</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
            <div class="row mt-1">
                @if(session()->has('ranked_data_saw'))
                <h2 class="mb-4" data-aos="fade-up" data-aos-delay="100">Hasil Perhitungan Rekomendasi Karakter Menggunakan Metode SAW</h2>
                @foreach(session()->get('ranked_data_saw', []) as $rankedItemSAW)
                <div class="col-md-3 mb-4">
                    <div class="card" data-aos="fade-up" data-aos-delay="200">
                        @if(isset($rankedItemSAW->gambar_karakter_saw))
                        <img src="data:image/jpeg;base64,{{ base64_encode($rankedItemSAW->gambar_karakter_saw) }}" class="card-img-top" alt="{{ $rankedItemSAW->nama_karakter_saw }}">
                        @else
                        <div class="text-center pt-3 pb-3">
                            Image not available
                        </div>
                        @endif
                        <div class="card-body">
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between">
                                        <b>Nama</b> <span class="text-muted">{{ $rankedItemSAW->nama_karakter_saw }}</span>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between">
                                        <b>Ranking</b> <span class="text-muted">{{ $rankedItemSAW->rank_saw }}</span>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between">
                                        <b>Nilai</b> <span class="text-muted">{{ number_format($rankedItemSAW->nilai_preferensi_saw, 3) }}</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </section>

    @include('user.partials.modal-pembobotan')
    @include('user.partials.modal-perhitungan')
    @include('user.partials.modal-saw')

</main><!-- End #main -->

@endsection