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
    <meta name="twitter:card" content="Nuôi lô 66, nuôi lô 247, nuôi lô khung 247 miền bắc"/>
    <meta name="twitter:site" content="Nuôi lô 66"/>
    <meta name="twitter:title" content="Nuôi lô 66, nuôi lô 247, nuôi lô khung 247 miền bắc"/>
    <meta name="twitter:description" content="{{$setting->meta_description}}"/>
@endsection
@section('content')
    <section id="body-content">
        <div class="khungvien"><h1><span class="chukhungvien">Nuôi lô khung 247 Chính Xác Nhất</span></h1></div>
        <div class="list1">
            {!! $setting->text1 !!}
        </div>
        <h3 class="header title-h3-cam">{{$title_soicau}}</h3>
        <div class="list1">
            {!! $setting->text2 !!}
        </div>
        <div class="d-flex d-soicau">
            <img src="{{Storage::disk('admin')->url($setting->img_soicau)}}" alt="soi cầu loto">
            <div>
                {!! $soicau->content !!}
            </div>
        </div>
        <div class="d-flex d-soicau justify-content-end">
            <div>
                {!! $soicau->content1 !!}
            </div>
            <img src="{{Storage::disk('admin')->url($setting->img_soicau)}}" alt="soi cầu loto">
        </div>
        <div class="marquee-container">
            {!! $content->text_run !!}
        </div>
    </section>
    <section id="section_kq">
        <div class="chotsoform">
            <h3 class="header title-h3-cam"> Kết quả xổ số miền Bắc mới nhất</h3>
            <div class="kqxshomnay">
                <h2>KẾT QUẢ XỔ SỐ MIỀN BẮC</h2>
                <!--KQXS-->
                <span style="font-size: 15px"><font color="#e00000">{{$title}}</font></span>
                <a href="/ket-qua">
                    <i class="far fa-calendar-alt icon-calendar"></i>
                </a>
            </div>
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
    <section id="section_banglotop">
        <h3 class="header title-h3-cam">Bảng lô top Rồng Bạch Kim</h3>
        <div class="trentablelotop">
            <div class="tab active" id="today-tab">Ngày hôm nay</div>
            <div class="tab" id="yesterday-tab">Ngày hôm qua</div>
            <div class="tab" id="nextyesterday-tab">Ngày hôm kia</div>

            <div class="content-lotop" id="tab-content"><style>
                    .top2-trend {
                        color: blue;
                    }
                </style>
                <div class="contentbox"><div class="contentbox_header"><div style="color:#3E3E3E">Bảng lô top ngày 01/10/2025</div></div><div class="contentbox_body"><div><div class="trendholder" rel="2025-10-01"><span class="top2-trend top2-34">81</span><span class="top2-trend top2-34">82</span><span class="top2-trend top2-34">76</span><span class="top2-trend top2-31">88</span><span class="top2-trend top2-31">96</span><span class="top2-trend top2-31">68</span><span class="top2-trend top2-31">73</span><span class="top2-trend top2-31">10</span><span class="top2-trend top2-31">18</span><span class="top2-trend top2-31">28</span><span class="top2-trend top2-31">89</span><span class="top2-trend top2-31">46</span><span class="top2-trend top2-31">57</span><span class="top2-trend top2-28">94</span><span class="top2-trend top2-28">01</span><span class="top2-trend top2-28">09</span><span class="top2-trend top2-28">37</span><span class="top2-trend top2-28">45</span><span class="top2-trend top2-28">80</span><span class="top2-trend top2-28">39</span></div></div><div style="clear:both"></div></div></div></div>
            <button id="fetch-data-btn" data="0">Xem đầy đủ</button>
            <p class="note-toplo" style="text-align: justify;"><b>Bảng Lô Top</b> là nơi thống kê kết quả dự đoán loto có khả năng về nhiều nhất được sắp xếp từ cao xuống thấp trong hôm nay nhằm mục đích tham khảo.</p>
            <script type="text/javascript">
                let useTrendLimit = false; // Biến để theo dõi trạng thái sử dụng trend limit

                // Function to fetch data based on selected tab
                function fetchData(url) {
                    fetch('/' + url)
                        .then(response => response.text())
                        .then(data => {
                            document.getElementById('tab-content').innerHTML = data;
                        })
                        .catch(error => console.error('Error fetching data:', error));
                }

                // Function to switch tabs
                function switchTab(tabId) {
                    // Reset active class for all tabs
                    document.querySelectorAll('.tab').forEach(tab => {
                        tab.classList.remove('active');
                    });

                    // Activate the selected tab
                    document.getElementById(tabId).classList.add('active');

                    // Fetch data based on selected tab
                    if (tabId === 'today-tab') {
                        fetchData('data-today.php' + (useTrendLimit ? '?trendlimit=100' : ''));
                    } else if (tabId === 'yesterday-tab') {
                        fetchData('data-yesterday.php' + (useTrendLimit ? '?trendlimit=100' : ''));
                    }
                    else if (tabId === 'nextyesterday-tab') {
                        fetchData('data-nextyesterday.php' + (useTrendLimit ? '?trendlimit=100' : ''));
                    }
                }

                // Initial load: Fetch data for "Ngày hôm nay" by default
                switchTab('today-tab');

                // Add click event listener to "Fetch Data with Trend Limit" button
                document.getElementById('fetch-data-btn').addEventListener('click', function() {
                    useTrendLimit = !useTrendLimit; // Đảo ngược trạng thái sử dụng trend limit
                    // Fetch data with trend limit
                    switchTab(document.querySelector('.tab.active').id);
                });

                // Add click event listeners to tabs
                document.getElementById('today-tab').addEventListener('click', function() {
                    switchTab('today-tab');
                });

                document.getElementById('yesterday-tab').addEventListener('click', function() {
                    switchTab('yesterday-tab');
                });

                document.getElementById('nextyesterday-tab').addEventListener('click', function() {
                    switchTab('nextyesterday-tab');
                });
            </script>
        </div>
    </section>
    <section id="section-post">
        @foreach($cats as $row)
        <div class="div-cat">
            <h3 class="header title-h3-cam">{{$row->name}}</h3>
            @foreach($row->posts as $post)
                <div class="list1">
                    <?php if(isset($row->icon) && $row->icon!='')?>
                    <img src="{{Storage::disk('admin')->url($row->icon)}}" alt="dự đoán xsmb 247" width="20" height="20">&nbsp;
                    <a href="/{{$row->slug}}/{{$post->slug}}" title="{{$post->title}}">{{$post->title}}
                       <?php if($post->hot == 1) {?>
                        <img src="assets/images/HOT.gif">
                        <?php } ?>
                    </a>
                </div>
            @endforeach
        </div>
        @endforeach
    </section>
    <section>
        <h3 class="header title-h3-cam">Quy định của {{$setting->name}}</h3>
        {!! $setting->textfooter !!}
    </section>
@stop
@push('js')
@endpush

