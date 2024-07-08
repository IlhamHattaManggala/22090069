<!-- Vendor JS Files -->
<script src="{{ asset('AdminLTE/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('AdminLTE/assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('AdminLTE/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('AdminLTE/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('AdminLTE/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('AdminLTE/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('AdminLTE/assets/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ url('AdminLTE/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('AdminLTE/assets/js/main.js') }}"></script>
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