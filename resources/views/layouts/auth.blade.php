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
  <body  class=" d-flex flex-column">
    {{$slot}}
    @include('layouts.partials.inc.js')
    @livewireScripts
  </body>
</html>
