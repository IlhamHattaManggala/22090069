@extends('layout.app')

@section('tittle')
Pembobotan
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
                        <li class="breadcrumb-item active">Pembobotan</li>
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
                <h3 class="card-title">Pembobotan</h3>

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
                            <th>Waktu</th>
                            <th>User</th>
                            @foreach ($columns as $column)
                                @if($column != 'id_bobot' && $column != 'waktu' && $column != 'users_id')
                                    <th>{{ ucwords(str_replace('_', ' ', $column)) }}</th>
                                @endif
                            @endforeach
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bobot as $b)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $b->waktu }}</td>
                                <td>{{ $b->user->name }}</td>
                                @foreach ($columns as $column)
                                    @if($column != 'id_bobot' && $column != 'waktu' && $column != 'users_id')
                                        <td>{{ $b->$column }}</td>
                                    @endif
                                @endforeach
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal{{ $b->id_bobot }}">Edit</button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $b->id_bobot }}">Delete</button>
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
                        <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#addModal">Tambah Pembobotan</button>
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
            <form action="{{ route('pembobotan.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Pembobotan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="users_id">Nama User</label>
                        <select class="form-control" id="users_id" name="users_id" required>
                            @foreach($user as $u)
                                <option value="{{ $u->id }}">{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="waktu">Waktu</label>
                        <input type="datetime-local" class="form-control" id="waktu" name="waktu" value="{{ now()->format('Y-m-d\TH:i') }}" readonly>
                    </div>
                    @foreach ($columns as $column)
                        @if($column != 'id_bobot' && $column != 'waktu' && $column != 'users_id')
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
@foreach($bobot as $k)
<div class="modal fade" id="editModal{{ $k->id_bobot }}" tabindex="-1" aria-labelledby="editModalLabel{{ $k->id_bobot }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('pembobotan.update', $k->id_bobot) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel{{ $k->id_bobot }}">Edit Pembobotan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="users_id">Nama User</label>
                        <select class="form-control" id="users_id" name="users_id" required>
                            @foreach($user as $u)
                                <option value="{{ $u->id }}" {{ $k->users_id == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="waktu">Waktu</label>
                        <input type="datetime-local" class="form-control" id="waktu" name="waktu" value="{{ \Carbon\Carbon::parse($k->waktu)->format('Y-m-d\TH:i') }}" readonly>
                    </div>
                    @foreach ($columns as $column)
                        @if($column != 'id_bobot' && $column != 'waktu' && $column != 'users_id')
                            <div class="form-group">
                                <label for="{{ $column }}">{{ ucwords(str_replace('_', ' ', $column)) }}</label>
                                <input type="number" class="form-control" id="{{ $column }}" name="{{ $column }}" value="{{ $k->$column }}" required>
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
@foreach($bobot as $k)
<div class="modal fade" id="deleteModal{{ $k->id_bobot }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $k->id_bobot }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('pembobotan.destroy', $k->id_bobot) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel{{ $k->id_bobot }}">Konfirmasi Hapus</h5>
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
