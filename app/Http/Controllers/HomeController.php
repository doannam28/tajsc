<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Category;
use App\Models\Email;
use App\Models\Keys;
use App\Models\Number;
use App\Models\Page;
use App\Models\Post;
use App\Models\Settings;
use App\Models\Soicau;
use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use PHPUnit\Framework\Exception;

class HomeController extends Controller
{
    protected function formatDateVietnamese($dateInput) {
        // Chuyển thành timestamp
        $timestamp = strtotime($dateInput);

        // Mảng ngày trong tuần tiếng Việt
        $days = [
            'Chủ nhật',
            'Thứ hai',
            'Thứ ba',
            'Thứ tư',
            'Thứ năm',
            'Thứ sáu',
            'Thứ bảy'
        ];

        // Lấy thứ trong tuần (0 = CN, 1 = Thứ 2, ...)
        $dayOfWeek = date('w', $timestamp);

        // Định dạng ngày theo dd/mm/YYYY
        $formattedDate = date('d/m/Y', $timestamp);

        return $days[$dayOfWeek] . ', Ngày ' . $formattedDate;
    }

    /**
     * @return Factory|View|Application
     */
    public function index()
    {
        $date = date('d/m/Y');
        $cat_id = 13;
        $obj1 = Number::where('cat_id',intval($cat_id))->where('date',$date)->orderBy('giai','asc')->get();
        $keys = Keys::where('status',1)->where('date',$date)->orderBy('id','DESC')->first();
        if(count($obj1) == 0){
            $keys = Keys::where('status',1)->orderBy('date','DESC')->first();
            $date = !empty($keys) ? $keys->date: date('d/m/Y');
            $obj1 = Number::where('cat_id',intval($cat_id))->where('date',$date)->orderBy('giai','asc')->get();
        }
        $mang=array();
        foreach ($obj1 as $row){
            $mang[intval($row->giai)][]=$row->number;
        }
        $mang_dau=array();
        $dau = Number::where('cat_id',intval($cat_id))->where('date',$date)->orderBy('duoi','asc')->get();
        foreach ($dau as $row){
            $mang_dau[intval(substr($row['duoi'],0,1))][]=$row->duoi;
        }
        $mang_duoi=array();
        foreach ($dau as $row){
            $mang_duoi[intval(substr($row['duoi'],1,1))][]=$row->duoi;
        }
        $title = $this->formatDateVietnamese($date);
        $cats = Category::where('status', 1)->where('menu', 1)
            ->orderBy('order', 'ASC')
            ->with(['posts' => function ($query) {
                $query->where('status',1)->orderBy('created_at', 'desc')->take(6);
            }])
            ->get();
        $soicau = Soicau::where('status',1)->orderBy('id','desc')->first();
        return view('homes.index', [
            'title_soicau' => 'Soi Cầu Miền Bắc '.$title,
            'title' => $title,
            'keys' => $keys,
            'mang' => $mang,
            'dau' => $mang_dau,
            'cats' => $cats,
            'duoi' => $mang_duoi,
            'soicau' => $soicau,
        ]);
    }
    public function category($slug='')
    {
        $cat = Category::where('slug', $slug)->firstOrFail();
        $posts = Post::where('parent_id',$cat->id)->where('status',1)->orderBy('position','ASC')->orderBy('updated_at','DESC')->paginate(10);
        return view('homes.category', [
            'cat' => $cat,
            'posts' => $posts,
        ]);
    }
    public function tag($slug='')
    {
        $cat = Tag::where('slug', $slug)->firstOrFail();

        $posts = $cat->posts()->where('status',1)->with('category')
            ->orderBy('position', 'ASC')
            ->orderBy('updated_at', 'DESC')
            ->paginate(10); // phân trang 10 bài / trang
        return view('homes.tag', [
            'cat' => $cat,
            'posts' => $posts,
        ]);
    }
    public function page($slug='')
    {
        $cat = Page::where('slug', $slug)->firstOrFail();
        return view('homes.page', [
            'cat' => $cat,
        ]);
    }
    public function noiquy()
    {
        $title = 'Nội quy và điều khoản';
        return view('homes.noiquy', [
            'title' => $title,
        ]);
    }
    public function detail($slug='',$slug1='')
    {
        $post = Post::where('slug', $slug1)->with('tags')->firstOrFail();
        if($slug=='bai-viet'){
            $cat = Category::where('id', $post->parent_id)->firstOrFail();
        }else{
            $cat = Category::where('slug', $slug)->firstOrFail();
        }
        $posts = Post::where('parent_id',$post->parent_id)->where('id','<>',$post->id)->where('status',1)->orderBy('position','ASC')->orderBy('updated_at','DESC')->limit(5)->get();
        return view('homes.detail', [
            'cat' => $cat,
            'post' => $post,
            'posts' => $posts,
        ]);
    }
    public function ketqua()
    {
        $request = Request::all();
        //KET QUA XO SO
        //Thong ke dau
        $mang_dau=array();
        $obj = new Number();
        $cat_id = 13;
        if(isset($request['date'])){
            $date = $request['date'];
        }else{
            $obj2 = $obj->where('cat_id',intval($cat_id))->orderBy('date','desc')->first();
            $date = isset($obj2->date) ? $obj2->date : date('Y-m-d');
        }
        $kyhieu =new Keys();
        $kyhieu = $kyhieu->where('cat_id',intval($cat_id))->where('date',$date)->first();
        $obj1 = $obj->where('cat_id',intval($cat_id))->where('date',$date)->orderBy('giai','asc')->get();
        $mang=array();
        foreach ($obj1 as $row){
            $mang[intval($row->giai)][]=$row->number;
        }
        $dau = $obj->where('cat_id',intval($cat_id))->where('date',$date)->orderBy('duoi','asc')->get();

        foreach ($dau as $row){
            $mang_dau[intval(substr($row['duoi'],0,1))][]=$row->duoi;
        }

        //Thong ke  duoi
        $mang_duoi=array();
        foreach ($dau as $row){
            $mang_duoi[intval(substr($row['duoi'],1,1))][]=$row->duoi;
        }
        $title = 'KẾT QUẢ XỔ SỐ Miền Bắc (Hà Nội) NGÀY '.date('d-m-Y',strtotime($date));
        $list_date = Number::where('cat_id',intval($cat_id))->where('giai',0)->orderBy('date','DESC')->get();
        return view('homes.ketqua', [
            'title' => $title,
            'mang' => $mang,
            'kyhieu' => $kyhieu,
            'dau' => $mang_dau,
            'duoi' => $mang_duoi,
            'list_date' => $list_date,
        ]);
    }
}
