<!-- Modal Form Tambah Data -->
<div class="modal fade" id="modalPerhitunganSAW" tabindex="-1" aria-labelledby="modalFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFormLabel">Hasil Perhitungan SAW</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if(session()->has('ranked_data_saw'))
                <div class="row p-2">
                    <div class="col-md-12">
                        <h5>Nilai Asli</h5>
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
                                @foreach(session()->get('ranked_data_saw', []) as $rankedItem)
                                <tr>
                                    <td>{{ $rankedItem->nama_karakter_saw }}</td>
                                    @foreach($KriteriaSelect as $criterion)
                                    <td>{{ $rankedItem->nilai_asli[$criterion] }}</td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>MINMAX</td>
                                    @foreach($KriteriaSelect as $criterion)
                                    <td>
                                        @php
                                        $maxValue = null;
                                        $minValue = null;
                                        @endphp
                                        @foreach(session()->get('ranked_data_saw', []) as $rankedItem)
                                        @if(isset($rankedItem->minmax['max'][$criterion]))
                                        @php
                                        $maxValue = number_format($rankedItem->minmax['max'][$criterion], 1);
                                        @endphp
                                        @endif
                                        @if(isset($rankedItem->minmax['min'][$criterion]))
                                        @php
                                        $minValue = number_format($rankedItem->minmax['min'][$criterion], 1);
                                        @endphp
                                        @endif
                                        @endforeach
                                        @if($maxValue !== null)
                                        <span class="badge bg-success">MAX</span> {{ $maxValue }}
                                        @endif
                                        @if($minValue !== null)
                                        <span class="badge bg-danger">MIN</span> {{ $minValue }}
                                        @endif
                                    </td>
                                    @endforeach
                                </tr>
                            </tfoot>
                        </table>
                        <h5>Normalisasi</h5>
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
                                @foreach(session()->get('ranked_data_saw', []) as $rankedItem)
                                <tr>
                                    <td>{{ $rankedItem->nama_karakter_saw }}</td>
                                    @foreach($KriteriaSelect as $criterion)
                                    <td>{{ number_format($rankedItem->normalisasi[$criterion], 2) }}</td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>