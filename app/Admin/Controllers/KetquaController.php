<?php
namespace App\Admin\Controllers;
use App\Admin\Controllers\BaseAdminController;
use App\Models\Keys;
use App\Models\Number;
use Feeds;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use XmlParser;
include(base_path('/inc/simple_html_dom.php'));
include(base_path('/inc/htmlfixer.class.php'));
/**
 * Created by PhpStorm.
 * User: May2
 * Date: 9/18/2015
 * Time: 10:03 AM
 */

class KetquaController extends BaseAdminController
{
    public $domain = 'https://ketqua04.net/';
    public $domainData = 'https://data.thantai1.net/';
    public function get_data($url,$contentype = '',$header=0)
    {
        $ch = curl_init();
        $timeout = 5;
        $userAgent[] = 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:40.0) Gecko/20100101 Firefox/40.0';
        $userAgent[] = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.93 Safari/537.36';
        curl_setopt($ch, CURLOPT_USERAGENT, $userAgent[rand(0,1)]);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

        /*curl_setopt($ch, CURLOPT_PROXYPORT, $proxy[1]);
        curl_setopt($ch, CURLOPT_PROXY, $proxy[0]);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);*/


        curl_setopt($ch, CURLOPT_COOKIEFILE,'cookies.txt');
        curl_setopt($ch, CURLOPT_COOKIEJAR,'cookies.txt');

        if($contentype!=''){
            curl_setopt($ch, CURLOPT_ENCODING, $contentype);
        }
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);
        return preg_replace('/[\n|\t]/', "", $data);
    }
    public function get_kyhieu(){
        $date=  date('Y-m-d');
        $date1=  date('d-m-Y',strtotime($date));
        $html = $this->get_data( $this->domain.'xo-so-mien-bac?ngay=' . $date1);
        $objHtml = str_get_html($html);
        $kyhieu = isset($objHtml->find('table#result_tab_mb td div#rs_8_0',0)->innertext)?$objHtml->find('table#result_tab_mb td div#rs_8_0',0)->innertext:'';
        $objKyhieu = Keys::where('date',$date)->first();
        if($kyhieu != '' && $kyhieu != '&nbsp;' && (!isset($objKyhieu->title) || (isset($objKyhieu->title) && $objKyhieu->title!=$kyhieu))) {
            if(!isset($objKyhieu->id)){
                $objKyhieu = new Keys();
            }
            $objKyhieu->title = $kyhieu;
            $objKyhieu->cat_id = 13;
            $objKyhieu->date = $date;
            $objKyhieu->status = 1;
            $objKyhieu->save();
        }
        echo 'xong';die;
    }
    public function get()
    {

        //if(date('H')=='18'){
        //$minute = intval(date('i'));
        // if($minute%2==0){
        $date=  date('Y-m-d');
        $date1=  date('d-m-Y',strtotime($date));
        echo $date;
        $cat_id=13;
        $obj = new Number();
        $count = $obj->where('date',$date)->where('cat_id',$cat_id)->where('page', '<>', 'xskt.com.vn')->count();
        $obj1 = $obj->where('date',$date)->where('cat_id',$cat_id)->where('giai',0)->where('page','<>','xskt.com.vn')->first();
        if($count<27 || (isset($obj1->number) && $obj1->number=='*') || !isset($obj1->number)) {
            $html = $this->get_data( $this->domain.'xo-so-mien-bac?ngay=' . $date1);
            $objHtml = str_get_html($html);
            $check_date=isset($objHtml->find('table#result_tab_mb #result_date',0)->innertext)?$objHtml->find('table#result_tab_mb #result_date',0)->innertext:'';
            $check_date=trim(strip_tags($check_date));
            $check_date = explode('ngày',$check_date);
            if(isset($check_date[1])){
                $check_date = trim($check_date[1]);
            }else $check_date='';
            if($check_date==$date1){
                $kyhieu = isset($objHtml->find('table#result_tab_mb td div#rs_8_0',0)->innertext)?$objHtml->find('table#result_tab_mb td div#rs_8_0',0)->innertext:'';
                $objKyhieu = Keys::where('date',$date)->first();
                if($kyhieu != '' && $kyhieu != '&nbsp;' && (!isset($objKyhieu->title) || (isset($objKyhieu->title) && $objKyhieu->title!=$kyhieu))) {
                    if(!isset($objKyhieu->id)){
                        $objKyhieu = new Keys();
                    }
                    $objKyhieu->title = $kyhieu;
                    $objKyhieu->cat_id = 13;
                    $objKyhieu->date = $date;
                    $objKyhieu->status = 1;
                    $objKyhieu->save();
                }
                $mang1 = array();
                $i = 0;
                foreach ($objHtml->find("table#result_tab_mb td div.vietdam") as $row) {
                    $name = trim(strip_tags(@$row->innertext));
                    $name = str_replace('&nbsp', '', $name);
                    $name = str_replace(';', '', $name);
                    $name =str_replace('*','',$name);
                    $name =str_replace('-','',$name);
                    $mang1[] = trim($name);

                }
                foreach ($mang1 as $k => $row){
                    if ($k == 2) $giai = 2.1;
                    elseif ($k == 3) $giai = 2.2;
                    elseif ($k == 4) $giai = 3.1;
                    elseif ($k == 5) $giai = 3.2;
                    elseif ($k == 6) $giai = 3.3;
                    elseif ($k == 7) $giai = 3.4;
                    elseif ($k == 8) $giai = 3.5;
                    elseif ($k == 9) $giai = 3.6;
                    elseif ($k == 10) $giai = 4.1;
                    elseif ($k == 11) $giai = 4.2;
                    elseif ($k == 12) $giai = 4.3;
                    elseif ($k == 13) $giai = 4.4;
                    elseif ($k == 14) $giai = 5.1;
                    elseif ($k == 15) $giai = 5.2;
                    elseif ($k == 16) $giai = 5.3;
                    elseif ($k == 17) $giai = 5.4;
                    elseif ($k == 18) $giai = 5.5;
                    elseif ($k == 19) $giai = 5.6;
                    elseif ($k == 20) $giai = 6.1;
                    elseif ($k == 21) $giai = 6.2;
                    elseif ($k == 22) $giai = 6.3;
                    elseif ($k == 23) $giai = 7.1;
                    elseif ($k == 24) $giai = 7.2;
                    elseif ($k == 25) $giai = 7.3;
                    elseif ($k == 26) $giai = 7.4;
                    else $giai = $k;
                    $data = array(
                        'number' => trim($row),
                        'date' => $date,
                        'giai' => floatval($giai),
                        'cat_id' => $cat_id,
                    );
                    $this->save_number($data);
                }
            }
            // }
            //}

        }
        echo ' - xong'; return;
    }

    public function get_mb()
    {
        $date=  date('Y-m-d');
        $cat_id=13;
        $obj = new Number();
        $count = $obj->where('date',$date)->where('cat_id',$cat_id)->count();
        $obj1 = $obj->where('date',$date)->where('cat_id',$cat_id)->where('giai',0)->first();
        if($count<27 || (isset($obj1->number) && $obj1->number=='*') || isset($obj1->page) && $obj1->page == 'xskt.com.vn') {
            $html = $this->get_data($this->domainData.'kq-mb.raw');
            $datas = explode('CF-RAY: ',$html);
            if(isset($datas[1]) && $datas[1]!=''){
                $datas = preg_split('/\r\n|\r|\n/', $datas[1]);
                $data = $datas[count($datas)-1];
                if($data!=''){
                    $data= str_replace('.','',$data);
                    $datas = explode(';',$data);
                    $code = $datas[0];
                    $obj2 = Number::where('code',$code)->where('cat_id',$cat_id)->where('giai',0)->count();
                    if($obj2 == 0) foreach($datas as $k=>$row){
                        $row = trim(strip_tags($row));
                        if($k==1 && $row!='' && $row!='*'){
                            preg_match('/charset=UTF-8/',$row, $test);
                            if(count($test)==0){
                                $objKyhieu = Keys::where('date',$date)->first();
                                if(isset($objKyhieu->name) && $objKyhieu->name==$row && isset($obj1->page) && $obj1->page != 'xskt.com.vn' && isset($obj1->number) && $obj1->number!='*') {
                                    return false;
                                }
                                if($row != '' && $row != '&nbsp;' && (!isset($objKyhieu->name) || (isset($objKyhieu->name) && $objKyhieu->name!=$row))) {
                                    if(!isset($objKyhieu->id)){
                                        $objKyhieu = new Keys();
                                    }
                                    $objKyhieu->name = $row;
                                    $objKyhieu->cat_id = 13;
                                    $objKyhieu->date = $date;
                                    $objKyhieu->status = 1;
                                    $objKyhieu->save();
                                    $this->save_kyhieu_firebase($objKyhieu);
                                }
                            }
                        }elseif($k>1 && $row!='' && $row!='*'){
                            $numbers = explode('-',$row);
                            foreach($numbers as $k1=>$row1){
                                $row1 = trim(strip_tags($row1));
                                if($row1!='' && $row1!='*'){
                                    $giai = ($k>7)? (9-$k) : ((9-$k).'.'.($k1+1));
                                    $data = array(
                                        'number' => trim($row1),
                                        'date' => $date,
                                        'code' => $code,
                                        'giai' => floatval($giai),
                                        'cat_id' => $cat_id,
                                    );
                                    $this->save_number($data);
                                }
                            }
                        }
                    }
                }
            }
        }else{
            return true;
        }
        return false;
    }

    public function randomchar()
    {
        $anpal = array('A','B','C','D','E','F','G','H','I','J','K','R','M','N','Y','T','P','Q','W','Z');$star = '';$end = '';
        for($i=0;$i<5;$i++){$star.=$anpal[rand(0,19)];}
        for($i=0;$i<10;$i++){$end.=$anpal[rand(0,19)];}
        return array($star,$end);
    }

    public function save_number($data=array()){
        $check_save = 0;
        if($data['number']!='' && $data['number']!='*' && $data['number']!='-' && is_numeric($data['number'])){
            $objVocabulary = new Number();
            $objVocabulary = $objVocabulary->where('date',$data['date'])->where('cat_id',$data['cat_id'])->where('giai',$data['giai'])->first();
            $this->chuanhoa( $data['cat_id'], $data['date']);
            if(!isset($objVocabulary->id)) $objVocabulary = new Number();
            $objVocabulary->date = (isset($data['date'])) ? $data['date'] : '';
            $objVocabulary->giai = (isset($data['giai'])) ? floatval($data['giai']) : '';
            $objVocabulary->dau = (isset($data['number'])) ? substr($data['number'], 0, 2) : '';
            $objVocabulary->duoi = (isset($data['number'])) ? substr($data['number'], -2) : '';
            $objVocabulary->dauso = (isset($data['number'])) ? substr($data['number'], -2, 1) : '';
            $objVocabulary->duoiso = (isset($data['number'])) ? substr($data['number'], -1) : '';
            $objVocabulary->cat_id = (isset($data['cat_id'])) ? $data['cat_id'] : '';
            $objVocabulary->code = (isset($data['code'])) ? $data['code'] : '';
            if (!(isset($objVocabulary->number) && $objVocabulary->number == $data['number']) || (isset($objVocabulary->page) && $objVocabulary->page == 'xskt.com.vn')) {
                $objVocabulary->page = $this->domain;
                $objVocabulary->number = (isset($data['number'])) ? $data['number'] : '';
                $objVocabulary->save();
                $check_save=1;
            }
        }
        return $check_save;
    }

    public function dientoan($cat_id = 1){
        $today = date('Y-m-d');
        $obj = Dientoans::where('cat_id',$cat_id)->where('date',$today)->first();
        if(empty($obj)){
            if($cat_id==1){
                $link =$this->domainData.'kq-tt4.raw';
            }elseif($cat_id==2){
                $link =$this->domainData.'kq-123.raw';
            }else{
                $link =$this->domainData.'kq-636.raw';
            }
            $html = $this->get_data($link);
            $datas = explode('CF-RAY: ',$html);
            if(isset($datas[1]) && $datas[1]!=''){
                $datas = preg_split('/\r\n|\r|\n/', $datas[1]);
                $data = explode(';', $datas[count($datas)-1]);
                $dientoan = new Dientoans();
                $numbers = $data[count($data)-1];
                $code = $data[0];
                if(strpos($code, '404 Not Found') != false || strpos($numbers, '404 Not Found') != false) return;
                $obj = Dientoans::where('code',$code)->first();
                if(empty($obj)) {
                    $dientoan->cat_id = $cat_id;
                    if ($cat_id == 1) {
                        $number = $numbers[0];
                        for ($i = 1; $i < strlen($numbers); $i++) {
                            $number .= "," . $numbers[$i];
                        }
                    }else{
                        $number = str_replace('-',',',$numbers);
                    }
                    $dientoan->number = $number;
                    $dientoan->date = $today;
                    $dientoan->status = 1;
                    $dientoan->code = $code;
                    $dientoan->save();
                }
            }
        }
        echo 'xong';die;
    }
    public function chuanhoa($cat_id='',$date=''){
        $obj = Number::where('cat_id',intval($cat_id))->where('date',$date)->orderBy('giai','asc')->get();
        $mang=array();
        foreach ($obj as $row){
            if(!in_array($row->giai,$mang)) $mang[]=$row->giai;
            else $row->delete();
        }
    }

}
