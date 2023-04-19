<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>@yield('pageTitle') - CMS Belajar</title>
    @include('layouts.partials.inc.css')
    @livewireStyles
  </head>
  <body >
    <script src="{{asset('assets/dist/js/demo-theme.min.js?1674944402')}}"></script>
    <div class="page">
      <!-- Navbar -->
      @include('layouts.partials.navbar')
      <div class="page-wrapper">
        <!-- Page body -->
        <div class="page-wrapper">
            {{$slot}}
        </div>
        @include('layouts.partials.footer')
      </div>
    </div>
    @include('layouts.partials.inc.js')
    @livewireScripts
  </body>
</html>
