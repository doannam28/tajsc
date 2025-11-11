@extends('layouts.app')
@section('meta')
    <?php use App\Helpers\Utility;$setting = Utility::setting();
    $content = isset($setting->content) ? json_decode($setting->content) : '';
    ?>
    <title>{{$post->title_web}}</title>
    <meta name="description" content="{{$post->meta}}">
    <meta property="og:title" content="{{$post->title_web}}">
    <meta name="keywords" content="{{$post->title_web}}">
    <meta property="og:description" content="{{$post->meta}}">
    <meta property="og:type" content="article">
    <meta property="og:image" content="{{Storage::disk('admin')->url($post->thumbnail)}}"/>
@endsection
@section('content')
    <section id="body-content">
        <div id="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
            <span typeof="v:Breadcrumb"><a href="/" rel="v:url" property="v:title">Trang chủ</a></span>
            › <span typeof="v:Breadcrumb"><a href="/{{$cat->slug}}" rel="v:url" property="v:title">{{$cat->name}}</a></span>
            › <span typeof="v:Breadcrumb"><span class="breadcrumb_last" property="v:title">{{$post->title}}</span>
            </span>
        </div>
        <div class="info">
            <h1><a href="/bai-viet/{{$post->slug}}" rel="bookmark">{{$post->title}}</a></h1>
        </div>
        <div id="content-new">
            {!! $post->content !!}
        </div>
        <div id="div-tags">
            <span class="tag">Từ Khóa:</span>
            <?php foreach ($post->tags as $k=>$row) {?>
                <a href="/tag/{{$row->slug}}" rel="tag">{{$row->name}}</a>{{($k < count($post->tags)-1)?',':''}}
            <?php } ?>
        </div>
        <h3 class="header title-h3-cam"> Cùng chuyên mục</h3>
       <?php foreach ($posts as $row) {?>
           <div class="list1"> <span style="color: #EE0000;"> ✪ </span> &nbsp;
               <a href="/{{$cat->slug}}/{{$row->slug}}" title="{{$row->title}}"> {{$row->title}}</a>
               <?php if($row->hot == 1){?>
               <img src="/assets/images/HOT.gif">
               <?php }?>
           </div>
        <?php } ?>
    </section>
@stop
@push('js')
@endpush

