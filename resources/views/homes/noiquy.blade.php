@extends('layouts.app')
@section('meta')
    <?php use App\Helpers\Utility;$setting = Utility::setting();
    $content = isset($setting->content) ? json_decode($setting->content) : '';
    ?>
    <title>{{$title}}</title>
    <meta name="description" content="{{$setting->meta_description}}">
    <meta property="og:title" content="{{$setting->site_title}}">
    <meta name="keywords" content="{{$setting->site_title}}">
    <meta property="og:description" content="{{$setting->meta_description}}">
    <meta property="og:type" content="article">
    <meta property="og:image" content="{{Storage::disk('admin')->url($setting->image_og)}}"/>
@endsection
@section('content')
    <section id="body-content">
        <div id="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
            <span typeof="v:Breadcrumb"><a href="/" rel="v:url" property="v:title">Trang chủ</a></span>
            › <span typeof="v:Breadcrumb"><span class="breadcrumb_last" property="v:title">{{$title}}</span>
            </span>
        </div>
        <div class="info">
            <h1><a href="/noi-qui-va-dieu-khoan" rel="bookmark">{{$title}}</a></h1>
        </div>
        <div id="content-new">
            {!! $content->soicau !!}
        </div>
    </section>
@stop
@push('js')
@endpush

