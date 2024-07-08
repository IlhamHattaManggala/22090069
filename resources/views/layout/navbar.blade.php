<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light fixed-top mb-2">
    <!-- Left navbar links -->
    <div class="container-fluid">
        <div class="d-flex justify-content-between w-100">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('admin.website') }}" class="nav-link">Website Setting</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item d-none d-sm-inline-block" data-toggle="modal" data-target="#logoutModal">
                    <a href="#" class="btn btn-primary btn-block nav-link float-right text-white">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- log out modal -->
<!-- Modal Konfirmasi Logout -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Keluar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin keluar?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-block btn-primary">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>