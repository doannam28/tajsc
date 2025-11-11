@extends('layouts.app')
@section('meta')
    <?php use App\Helpers\Utility;$setting = Utility::setting();
    $content = isset($setting->content) ? json_decode($setting->content) : '';
    ?>
    <title>{{$cat->title_web}}</title>
    <meta name="description" content="{{$cat->meta_description}}">
    <meta property="og:title" content="{{$cat->title_web}}">
    <meta name="keywords" content="{{$cat->name}}">
    <meta property="og:description" content="{{$cat->meta_description}}">
    <meta property="og:type" content="article">
    <meta property="og:image" content="{{Storage::disk('admin')->url($cat->image_og)}}"/>
@endsection
@section('content')
    <section id="body-content">
        <div id="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
            <span typeof="v:Breadcrumb"><a href="/" rel="v:url" property="v:title">Trang chủ</a></span> › <span typeof="v:Breadcrumb"><span class="breadcrumb_last" property="v:title">{{$cat->name}}</span></span></div>
       <?php foreach ($posts as $row) {?>
           <div class="list1"> <span style="color: #EE0000;"> ✪ </span> &nbsp;
               <a href="/{{$cat->slug}}/{{$row->slug}}" title="{{$row->title}}"> {{$row->title}}</a>
               <?php if($row->hot == 1){?>
               <img src="/assets/images/HOT.gif">
               <?php }?>
           </div>
        <?php } ?>
        <div id="div-pagination-new" class="col-12 d-flex justify-content-center">
            {{$posts->links('homes.pagination')}}
        </div>
    </section>
    <section>
        <div class="list1">
            {!! $cat->content !!}
        </div>
    </section>
@stop
@push('js')
@endpush

