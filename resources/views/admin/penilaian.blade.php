@extends('layout.app')

@section('tittle')
Penilaian
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
                        <li class="breadcrumb-item active">Penilaian</li>
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
                <h3 class="card-title">PENILAIAN</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered w-100">
                        <thead class="bg-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nama Karakter</th>
                                @foreach ($columns as $column)
                                @if($column != 'karakter_id_karakter' && $column != 'id_penilaian' && $column != 'pembobotan_id_bobot')
                                <th>{{ ucwords(str_replace('_', ' ', $column)) }}</th>
                                @endif
                                @endforeach
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($nilai as $n)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $n->karakter ? $n->karakter->nama : 'Karakter tidak ditemukan' }}</td>
                                @foreach ($columns as $column)
                                @if($column != 'karakter_id_karakter' && $column != 'id_penilaian' && $column != 'pembobotan_id_bobot')
                                <td>{{ $n->$column }}</td>
                                @endif
                                @endforeach
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal{{ $n->id_penilaian }}">Edit</button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $n->id_penilaian }}">Delete</button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#addModal">Tambah Penilaian</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('penilaian.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Penilaian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="karakter_id_karakter">Nama Karakter</label>
                        <select class="form-control" id="karakter_id_karakter" name="karakter_id_karakter" required>
                            @foreach($karakterBelumAda as $k)
                            <option value="{{ $k->id_karakter }}">{{ $k->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    @foreach ($columns as $column)
                    @if($column != 'karakter_id_karakter' && $column != 'id_penilaian' && $column != 'pembobotan_id_bobot')
                    <div class="form-group">
                        <label for="{{ $column }}">{{ ucwords(str_replace('_', ' ', $column)) }}</label>
                        <input type="number" class="form-control" id="{{ $column }}" name="{{ $column }}" required>
                    </div>
                    @endif
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
@foreach($nilai as $n)
<div class="modal fade" id="editModal{{ $n->id_penilaian }}" tabindex="-1" aria-labelledby="editModalLabel{{ $n->id_penilaian }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('penilaian.update', $n->id_penilaian) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel{{ $n->id_penilaian }}">Edit Penilaian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="karakter_id_karakter">Nama Karakter</label>
                        <select class="form-control" id="karakter_id_karakter" name="karakter_id_karakter" required>
                            @foreach($karakter as $k)
                            <option value="{{ $k->id_karakter }}" {{ $n->karakter_id_karakter == $k->id_karakter ? 'selected' : '' }}>{{ $k->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    @foreach($columns as $column)
                    @if($column != 'karakter_id_karakter' && $column != 'id_penilaian' && $column != 'pembobotan_id_bobot')
                    <div class="form-group">
                        <label for="{{ $column }}">{{ ucwords(str_replace('_', ' ', $column)) }}</label>
                        <input type="number" class="form-control" id="{{ $column }}" name="{{ $column }}" value="{{ $n->$column }}" required>
                    </div>
                    @endif
                    @endforeach
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

<!-- Delete Modal -->
@foreach($nilai as $n)
<div class="modal fade" id="deleteModal{{ $n->id_penilaian }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $n->id_penilaian }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('penilaian.destroy', $n->id_penilaian) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel{{ $n->id_penilaian }}">Konfirmasi Hapus</h5>
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
@endsection