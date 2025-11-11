@extends('layouts.app')
@section('meta')
    <?php use App\Helpers\Utility;$setting = Utility::setting();
    $content = isset($setting->content) ? json_decode($setting->content) : '';
    ?>
    <title>{{$setting->site_title}}</title>
    <meta name="description" content="{{$setting->meta_description}}">
    <meta property="og:title" content="{{$setting->site_title}}">
    <meta name="keywords" content="{{$setting->site_title}}">
    <meta property="og:description" content="{{$setting->meta_description}}">
    <meta property="og:type" content="article">
    <meta property="og:image" content="{{Storage::disk('admin')->url($setting->image_og)}}"/>
@endsection
@section('content')
    <section id="section_kq">
        <header style="padding-top: 30px;" class="page-header-news">
            <h1 class="page-title"><span>{{$title}}</span></h1>
            <div class="text-center star-border"></div>
        </header>
        <form id="form-ketqua" method="GET" action="">
            <div class="row">
              <div class="col-sm-3">
                   {{-- <div class="form-group">
                        <label class="col-form-label" for="continent">Chọn tỉnh/Tp</label>
                        <select class="form-control" id="continent" name="tinh" onchange="countryChange(this);">
                            <option selected="selected" value="empty">---</option>
                            <option value="mien-bac">Miền Bắc</option>
                        </select>
                    </div>--}}
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="col-form-label" for="country">Chọn ngày</label>
                        <select class="form-control" id="country" name="date">
                            <option selected="selected" value="">---</option>
                            <?php foreach ($list_date as $row){?>
                            <option
                                <?php if (isset($date) && $date == $row->date) echo 'selected="selected"'?> value="{{$row->date}}">{{date('d/m/Y',strtotime($row->date))}}</option><?php } ?>
                        </select>
                    </div>
                </div>
                <div style="padding-top: 28px;" class="col-sm-4">
                    <input class="btn btn-danger btn-lg" type="submit" value="Xem kết quả">
                </div>
            </div>
        </form>
        <div class="chotsoform">
            <div class="tbl-ketquaxoso">
                <table width="100%" cellspacing="0" cellpadding="0" border="0"
                       class="table table-bordered table-striped mainkqxs">
                    <tbody>
                    <tr>
                        <th class="col-xs-2 th_title"><span style="color: #0358a8;font-size: 14px;">KH</span></th>
                        <th class="red th_number">
                            <ul class="ul_ketqua">
                                <li class="lv waiting">{{isset($keys->title)?$keys->title:''}}</li>
                            </ul>
                        </th>
                    </tr>
                    <tr class="tr_db">
                        <th class="col-xs-2 th_title">ĐB</th>
                        <th class="red th_number">
                            <ul class="ul_ketqua">
                                <?php $i=0;$j=0;?>
                                <li class="wgdb waiting">{{isset($mang[$i][$j])?$mang[$i][$j]:'*'}}</li>
                            </ul>
                        </th>
                    </tr>
                    <tr>
                        <th class="th_title">G1</th>
                        <th class="th_number">
                            <ul class="ul_ketqua">
                                <?php $i=1;$j=0;?>
                                <li class="wg1 waiting">{{isset($mang[$i][$j])?$mang[$i][$j]:'*'}}</li>
                            </ul>
                        </th>
                    </tr>
                    <tr>
                        <th class="th_title">G2</th>
                        <th class="th_number">
                            <ul class="ul_ketqua">
                                <?php $i=2;$j=0;?>
                                <li class="wg2 waiting">{{isset($mang[$i][$j])?$mang[$i][$j++]:'*'}}</li>
                                <li class="wg2 waiting">{{isset($mang[$i][$j])?$mang[$i][$j]:'*'}}</li>
                            </ul>
                        </th>
                    </tr>
                    <tr>
                        <th class="th_title">G3</th>
                        <th class="th_number">
                            <ul class="ul_ketqua">
                                <?php $i=3;$j=0;?>
                                <li class="wg3 waiting">{{isset($mang[$i][$j])?$mang[$i][$j++]:'*'}}</li>
                                <li class="wg3 waiting">{{isset($mang[$i][$j])?$mang[$i][$j++]:'*'}}</li>
                                <li class="wg3 waiting">{{isset($mang[$i][$j])?$mang[$i][$j++]:'*'}}</li>
                                <li class="wg3 waiting" style="border-top: 1px solid #d9d9d9;">{{isset($mang[$i][$j])?$mang[$i][$j++]:'*'}}</li>
                                <li class="wg3 waiting" style="border-top: 1px solid #d9d9d9;">{{isset($mang[$i][$j])?$mang[$i][$j++]:'*'}}</li>
                                <li class="wg3 waiting" style="border-top: 1px solid #d9d9d9;">{{isset($mang[$i][$j])?$mang[$i][$j++]:'*'}}</li>
                            </ul>
                        </th>
                    </tr>
                    <tr>
                        <th class="th_title">G4</th>
                        <th class="th_number">
                            <ul class="ul_ketqua">
                                <?php $i=4;$j=0;?>
                                <li class="wg4 waiting">{{isset($mang[$i][$j])?$mang[$i][$j++]:'*'}}</li>
                                <li class="wg4 waiting">{{isset($mang[$i][$j])?$mang[$i][$j++]:'*'}}</li>
                                <li class="wg4 waiting">{{isset($mang[$i][$j])?$mang[$i][$j++]:'*'}}</li>
                                <li class="li_bor_top wg4 waiting">{{isset($mang[$i][$j])?$mang[$i][$j++]:'*'}}</li>
                            </ul>
                        </th>
                    </tr>
                    <tr>
                        <th class="th_title">G5</th>
                        <th class="th_number">
                            <ul class="ul_ketqua">
                                <?php $i=5;$j=0;?>
                                <li class="wg5 waiting">{{isset($mang[$i][$j])?$mang[$i][$j++]:'*'}}</li>
                                <li class="wg5 waiting">{{isset($mang[$i][$j])?$mang[$i][$j++]:'*'}}</li>
                                <li class="wg5 waiting">{{isset($mang[$i][$j])?$mang[$i][$j++]:'*'}}</li>
                                <li class="wg5 waiting" style="border-top: 1px solid #d9d9d9;">{{isset($mang[$i][$j])?$mang[$i][$j++]:'*'}}</li>
                                <li class="wg5 waiting" style="border-top: 1px solid #d9d9d9;">{{isset($mang[$i][$j])?$mang[$i][$j++]:'*'}}</li>
                                <li class="wg5 waiting" style="border-top: 1px solid #d9d9d9;">{{isset($mang[$i][$j])?$mang[$i][$j++]:'*'}}</li>
                            </ul>
                        </th>
                    </tr>
                    <tr>
                        <th class="th_title">G6</th>
                        <th class="th_number">
                            <ul class="ul_ketqua">
                                <?php $i=6;$j=0;?>
                                <li class="wg6 waiting">{{isset($mang[$i][$j])?$mang[$i][$j++]:'*'}}</li>
                                <li class="wg6 waiting">{{isset($mang[$i][$j])?$mang[$i][$j++]:'*'}}</li>
                                <li class="wg6 waiting">{{isset($mang[$i][$j])?$mang[$i][$j++]:'*'}}</li>
                            </ul>
                        </th>
                    </tr>
                    <tr>
                        <th class="th_title">G7</th>
                        <th class="th_number">
                            <ul class="ul_ketqua">
                                <?php $i=7;$j=0;?>
                                <li class="wg7 waiting" style="color: red;">{{isset($mang[$i][$j])?$mang[$i][$j++]:'*'}}</li>
                                <li class="wg7 waiting" style="color: red;">{{isset($mang[$i][$j])?$mang[$i][$j++]:'*'}}</li>
                                <li class="wg7 waiting" style="color: red;">{{isset($mang[$i][$j])?$mang[$i][$j++]:'*'}}</li>
                                <li class="wg7 waiting" style="color: red;">{{isset($mang[$i][$j])?$mang[$i][$j++]:'*'}}</li>
                            </ul>
                        </th>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="arrow_table">
                <div class="row" style="margin: 0px;">
                    <!-- Bảng Đầu -->
                    <div class="col-md-6 col-xs-6" style="padding-right: 3px; padding-left: 0px;">
                        <table class="tbl_dau table table-striped" style="table-layout: fixed;">
                            <thead style="width: 100%;">
                            <tr class="db info">
                                <th class="thdau">Đầu</th>
                                <th class="thsau">Lô Tô</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php for($i=0;$i<10;$i++) {?>
                            <tr>
                                <td class="number_dau_duoi">{{$i}}</td>
                                <td class="waiting">{{(isset($dau[$i]) && count($dau[$i])>0) ? implode(" ; ", $dau[$i]): ''}}</td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Bảng Đuôi -->
                    <div class="col-md-6 col-xs-6" style="padding-left: 3px; padding-right: 0px;">
                        <table class="tbl_dau table table-striped" style="table-layout: fixed;">
                            <thead style="width: 100%;">
                            <tr class="db info">
                                <th class="thdau">Đuôi</th>
                                <th class="thsau">Lô Tô</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php for($i=0;$i<10;$i++) {?>
                                <tr>
                                    <td class="number_dau_duoi">{{$i}}</td>
                                    <td class="waiting">{{(isset($duoi[$i]) && count($duoi[$i])>0) ? implode(" ; ", $duoi[$i]): ''}}</td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@push('js')
@endpush

