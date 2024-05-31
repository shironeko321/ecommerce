<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Home</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @stack('style')
</head>

<body>
  @include('templates.home.header')

  @yield('main')

  @stack('js')

</body>

</html>
