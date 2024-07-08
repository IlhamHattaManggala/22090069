@extends('user.master-home')

@section('tittle', 'Profile')

@section('main')
<main class="main">
    <section class="profile" id="profile">
        <div class="container">
            <div class="row justify-content-center">
                <div class="row">
                    <div class="col-md-4">
                        <!-- Show current avatar -->
                        @if(Auth::user()->base64Image)
                        <img src="{{ Auth::user()->base64Image }}" alt="Profile Picture" class="img-fluid rounded-circle w-100 h-100">
                        @else
                        <img src="{{ asset('AdminLTE/dist/img/default-profile.png') }}" alt="Default Profile Picture" class="rounded-circle w-100 h-100">
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

                            <button type="submit" class="btn btn-outline-dark btn-block">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection