@extends('layout.app')

@section('tittle')
Website Setting
@endsection

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Website Setting</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Website Setting</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <!-- Show current avatar -->
                        <img src="{{ $website->base64Image }}" class="img-fluid" alt="Current Avatar">
                    </div>
                    <div class="col-md-10">
                        <!-- Form for profile settings -->
                        <form method="POST" action="{{ route('website.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <!-- Input fields for profile settings -->
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input id="nama" type="text" class="form-control" name="nama" value="{{ old('nama') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="logo">Logo</label>
                                <input id="logo" type="file" class="form-control-file" name="logo">
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>

@endsection