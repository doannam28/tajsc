@extends('layouts.app')
@section('meta')
    <?php use App\Helpers\Utility;$setting = Utility::setting();
    $content = isset($setting->content) ? json_decode($setting->content) : '';
    ?>
    <title>{{$cat->title}}</title>
    <meta name="description" content="{{$cat->meta_description}}">
    <meta property="og:title" content="{{$cat->title}}">
    <meta name="keywords" content="{{$cat->title}}">
    <meta property="og:description" content="{{$cat->meta_description}}">
    <meta property="og:type" content="article">
    <meta property="og:image" content="{{Storage::disk('admin')->url($cat->image_og)}}"/>
@endsection
@section('content')
    <section id="body-content">
        <div id="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
            <span typeof="v:Breadcrumb"><a href="/" rel="v:url" property="v:title">Trang chủ</a></span> › <span
                typeof="v:Breadcrumb"><span class="breadcrumb_last" property="v:title">{{$cat->title}}</span></span>
        </div>
        <div id="content-new">
            <?php if(!empty($cat->title_detail)) {?>
            <h2 class="dudoanxs">{{$cat->title_detail}}</h2>
            <?php }?>
            {!! $cat->content !!}
        </div>
    </section>
@stop
@push('js')
@endpush

