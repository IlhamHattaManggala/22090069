<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('tittle') | {{ $website->nama }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ url('AdminLTE/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('AdminLTE/plugins/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap4.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('AdminLTE/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ url('AdminLTE/dist/css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ url('AdminLTE/plugins/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ url('AdminLTE/plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ url('AdminLTE/plugins/chart.js/Chart.min.css') }}">
    <script src="{{ url('AdminLTE/plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ url('AdminLTE/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <link href="{{ $website->base64Image }}" rel="icon">

</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        @include('layout.navbar')
        @include('layout.sidebar')
        @yield('content')
        @include('layout.footer')
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ url('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ url('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap4.js"></script>

    <!-- SweetAlert -->
    <script src="{{ url('AdminLTE/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ url('AdminLTE/plugins/toastr/toastr.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('AdminLTE/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ url('AdminLTE/dist/js/dashboard.js') }}"></script>
    @if ($message = Session::get('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ $message }}',
            confirmButtonText: 'OK'
        });
    </script>
    @endif

    @if ($message = Session::get('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ $message }}',
            confirmButtonText: 'OK'
        });
    </script>
    @endif

    <script>
        $(document).ready(function() {
            $('#example1').DataTable({
                searching: true,
                ordering: true,
                paging: true
            });
        });
        $(document).ready(function() {
            $('#example2').DataTable({
                searching: true,
                ordering: true,
                paging: true
            });
        });
    </script>

    @php
    $queryCount = DB::table('telescope_entries')
    ->where('type', 'query')
    ->count();
    @endphp

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var forms = document.getElementsByTagName('form');
            var validationErrorMessages = document.querySelectorAll('[data-validation-error-msg]');

            for (var i = 0; i < forms.length; i++) {
                forms[i].addEventListener('submit', function(event) {
                    var isValid = true;

                    // Validate each select with required attribute
                    for (var j = 0; j < validationErrorMessages.length; j++) {
                        var select = validationErrorMessages[j];
                        if (select.hasAttribute('required') && select.value === '') {
                            var errorMessage = select.getAttribute('data-validation-error-msg');
                            alert(errorMessage); // Ganti dengan cara menampilkan pesan yang sesuai di UI Anda
                            isValid = false;
                            event.preventDefault();
                            break;
                        }
                    }

                    // Proceed with form submission if valid
                    if (isValid) {
                        // Continue with form submission
                    }
                });
            }
        });
    </script>

</body>

</html>