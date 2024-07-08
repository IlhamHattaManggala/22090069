<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>@yield('tittle') | {{ $website->nama }}</title>

  @include('user.components.link')
</head>

<body>

  <!-- ======= Header ======= -->
  @include('user.navbar')

  @include('user.partials.hero')

  @yield('main')

  @include('user.footer')

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  @include('user.components.scripts')

</body>

</html>