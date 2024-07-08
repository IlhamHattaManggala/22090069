<!-- Modal Form Tambah Data -->
<div class="modal fade" id="modalPerhitungan" tabindex="-1" aria-labelledby="modalFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFormLabel">Hasil Perhitungan Topsis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if(session()->has('ranked_data_topsis'))
                <div class="row p-2">
                    <h5>Nilai Normalisasi</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Karakter</th>
                                @foreach($KriteriaSelect as $criterion)
                                <th>{{ ucwords(str_replace('_', ' ', $criterion)) }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(session()->get('ranked_data_topsis', []) as $rankedItem)
                            <tr>
                                <td>{{ $rankedItem->nama_karakter }}</td>
                                @foreach($rankedItem->normalisasi as $kriteria => $nilai)
                                <td>{{ number_format($nilai, 3) }}</td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row mt-2 p-2">
                    <h5>Nilai Normalisasi Terbobot</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Karakter</th>
                                @foreach($KriteriaSelect as $criterion)
                                <th>{{ ucwords(str_replace('_', ' ', $criterion)) }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(session()->get('ranked_data_topsis', []) as $rankedItem)
                            <tr>
                                <td>{{ $rankedItem->nama_karakter }}</td>
                                @foreach($rankedItem->normalisasi_terbobot as $nilai)
                                <td>{{ number_format($nilai, 3) }}</td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


                <div class="row mt-2 p-2">
                    <h5>Ideal Positif Dan Negatif</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Ideal</th>
                                @foreach($KriteriaSelect as $criterion)
                                <th>{{ ucwords(str_replace('_', ' ', $criterion)) }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>A+</td>
                                @foreach($KriteriaSelect as $criterion)
                                <td>{{ isset(session('idealPositif')[$criterion]) ? number_format(session('idealPositif')[$criterion], 3) : '' }}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>A-</td>
                                @foreach($KriteriaSelect as $criterion)
                                <td>{{ isset(session('idealNegatif')[$criterion]) ? number_format(session('idealNegatif')[$criterion], 3) : '' }}</td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="row mt-2 p-2">
                    <h5>Jarak</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Karakter</th>
                                <th>Jarak Positif</th>
                                <th>Jarak Negatif</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(session()->get('ranked_data_topsis', []) as $rankedItem)
                            <tr>
                                <td>{{ $rankedItem->nama_karakter }}</td>
                                <td>{{ number_format($rankedItem->jarakPositif, 3) }}</td>
                                <td>{{ number_format($rankedItem->jarakNegatif, 3) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>