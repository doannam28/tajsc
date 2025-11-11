<!doctype html>
<html itemscope itemtype="http://schema.org/WebPage" lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/assets/libraries/bootstrap-5.3.0/css/bootstrap.min.css" rel="stylesheet">
    @yield('meta')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&display=swap"
          rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Smooch&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel='stylesheet' id='font-awesome-official-css' href='https://use.fontawesome.com/releases/v6.2.0/css/all.css' type='text/css' media='all' integrity="sha384-SOnAn/m2fVJCwnbEYgD4xzrPtvsXdElhOVvR8ND1YjB5nhGNwwf7nBQlhfAwHAZC" crossorigin="anonymous" />
    <link href="/assets/css/styles.css?v={{ env('VERSION_CSS') }}" rel="stylesheet">
    <link rel="canonical" href="{{ url()->current() }}" itemprop="url" />
    <?php $setting = App\Helpers\Utility::setting();?>
    <link rel="shortcut icon" href="{{Storage::disk('admin')->url($setting->favicon)}}">
    @stack('css')
</head>
<body>
<div class="container main-container">
    @include('layouts.header')
    @yield('content')
    @include('layouts.footer')
</div>
</body>
<script
    src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
    crossorigin="anonymous"></script>
<script src="/assets/libraries//bootstrap-5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="/assets/js/soicaumb247.js?v={{ env('VERSION_JS') }}"></script>
@stack('js')
</html>
