@extends('layout.app')

@section('tittle')
Profile Setting
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
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Profile</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <!-- Show current avatar -->
                        @if(Auth::user()->base64Image)
                        <img src="{{ Auth::user()->base64Image }}" alt="Profile Picture" class="img-fluid rounded-circle w-100">
                        @else
                        <img src="{{ asset('AdminLTE/dist/img/default-profile.png') }}" alt="Default Profile Picture" class="rounded-circle w-100">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <!-- Form for profile settings -->
                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Input fields for profile settings -->
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') ?? auth()->user()->name }}" required autocomplete="name" autofocus>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') ?? auth()->user()->email }}" required autocomplete="email">
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password" class="form-control" name="password">
                                <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah</small>
                            </div>

                            <div class="form-group">
                                <label for="avatar">Avatar</label>
                                <input id="avatar" type="file" class="form-control-file" name="avatar">
                                <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah</small>
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