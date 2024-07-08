@extends('layout.app')

@section('tittle')
Alternatif
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Alternatif</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">ALTERNATIF</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered w-100">
                    <thead class="bg-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Element</th>
                            <th>Region</th>
                            <th>Rarity</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($karakter as $k)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $k->nama }}</td>
                            <td>{{ $k->element }}</td>
                            <td>{{ $k->region }}</td>
                            <td>{{ $k->rarity }}</td>
                            <td>
                                @if($k->gambar)
                                <img src="{{ $k->base64Image1 }}" alt="Gambar" width="50" height="50">
                                @else
                                Tidak ada gambar
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal{{ $k->id_karakter }}">Edit</button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $k->id_karakter }}">Delete</button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#addModal">Tambah Alternatif</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>

@foreach ($karakter as $k)
<div class="modal fade" id="editModal{{ $k->id_karakter }}" tabindex="-1" aria-labelledby="editModalLabel{{ $k->id_karakter }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('alternatif.update', ['karakter' => $k]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel{{ $k->id_karakter }}">Edit Alternatif</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $k->nama }}" required>
                    </div>
                    <div class="form-group">
                        <label for="element">Element</label>
                        <select class="form-control" id="element" name="element" data-validation-error-msg="Please select an item in list">
                            <option value="">Pilih Element</option>
                            @foreach($elements as $element)
                            <option value="{{ $element }}" {{ $k->element == $element ? 'selected' : '' }}>{{ $element }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="region">Region</label>
                        <select class="form-control" id="region" name="region" data-validation-error-msg="Please select an item in list">
                            <option value="">Pilih Region</option>
                            @foreach($regions as $region)
                            <option value="{{ $region }}" {{ $k->region == $region ? 'selected' : '' }}>{{ $region }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="rarity">Rarity</label>
                        <select class="form-control" id="rarity" name="rarity" data-validation-error-msg="Please select an item in list">
                            <option value="">Pilih Rarity</option>
                            @foreach($rarities as $rarity)
                            <option value="{{ $rarity }}" {{ $k->rarity == $rarity ? 'selected' : '' }}>{{ $rarity }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <input type="file" class="form-control" id="gambar" name="gambar">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach


@foreach ($karakter as $k)
<div class="modal fade" id="deleteModal{{ $k->id_karakter }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $k->id_karakter }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('alternatif.destroy', ['karakter' => $k]) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel{{ $k->id_karakter }}">Konfirmasi Hapus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('alternatif.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Alternatif</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="element">Element</label>
                        <select class="form-control" id="element" name="element" data-validation-error-msg="Please select an item in list">
                            <option value="">Pilih Element</option>
                            @foreach($elements as $element)
                            <option value="{{ $element }}">{{ $element }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="region">Region</label>
                        <select class="form-control" id="region" name="region" data-validation-error-msg="Please select an item in list">
                            <option value="">Pilih Region</option>
                            @foreach($regions as $region)
                            <option value="{{ $region }}">{{ $region }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="rarity">Rarity</label>
                        <select class="form-control" id="rarity" name="rarity" data-validation-error-msg="Please select an item in list">
                            <option value="">Pilih Rarity</option>
                            @foreach($rarities as $rarity)
                            <option value="{{ $rarity }}">{{ $rarity }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <input type="file" class="form-control" id="gambar" name="gambar" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection