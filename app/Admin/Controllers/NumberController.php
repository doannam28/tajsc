<?php

namespace App\Admin\Controllers;

use App\Models\Number;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Database\Eloquent\Model;
use function Symfony\Component\String\length;

class NumberController extends BaseAdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Number';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Number());

        // 1. Chỉ lấy bản ghi có giai = 0
        $grid->model()->where('giai', 0)->orderBy('date', 'DESC');

        // 2. Filter cho date và cat_id
        $grid->filter(function($filter){
            $filter->disableIdFilter();
            $filter->equal('date', 'Ngày')->date();
           });

        // 3. Các cột
        $grid->column('id', 'ID')->sortable();
        $grid->column('date', 'Ngày')->sortable();



        // Cột hiển thị Giải + các số liên quan
        $grid->column('','Giải')->display(function () {
            $catId = $this->cat_id;
            $date  = $this->date;

            $html = "G0: {$this->number} <br />";
            for ($i = 1; $i < 8; $i++) {
                $numbers = \App\Models\Number::where('giai', '>=',$i)->where('giai', '<',$i+1)
                    ->where('date', $date)
                    ->where('cat_id', $catId)
                    ->orderBy('giai','asc')
                    ->get();
                    $html .= "G{$i}: ";
                    foreach ($numbers as $k => $n) {
                        $html .= $n->number . ($k < count($numbers) - 1 ? ' - ' : '');
                    }
                    $html .= "<br />";
            }

            return $html;
        });

        $grid->column('created_at', 'Ngày tạo');
        $grid->column('updated_at', 'Ngày cập nhật');

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Number::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('slug', __('Slug'));
        //$show->field('status', __('Status'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Number());

        // Field thật
        $form->date('date', 'Ngày')
            ->default(date('Y-m-d'))
            ->rules('required');

        $form->hidden('cat_id')->default(13);
        $form->hidden('page')->default('admin');

        // Field ảo G0..G7
        $id = request()->route('number');
        for ($i = 0; $i < 8; $i++) {
            $default = $this->getDefaultValue($id, $i);
            $form->text("g{$i}", "G{$i}")->default($default);
        }

        // ❌ chỉ ignore field ảo
        $form->ignore(['g0','g1','g2','g3','g4','g5','g6','g7']);

        // Xử lý sau khi record gốc đã insert
        $form->saved(function (Form $form) {
            $input  = request()->all();
            $date   = $input['date'] ?? '';
            $cat_id = $input['cat_id'] ?? 13;
            $page = $input['page'] ?? 'admin';

            // Xoá toàn bộ numbers theo date + cat_id
            Number::where('date', $date)
                ->where('cat_id', $cat_id)
                ->delete();

            // Insert lại theo dữ liệu G0..G7
            for ($i = 0; $i < 8; $i++) {
                $mang = trim($input['g'.$i]) ?? '';
                if ($mang != '') {
                    $mang = $this->get_mang($mang);
                    foreach ($mang as $k => $row) {
                        $giai = ($i == 0 || $i == 1) ? $i : floatval($i.'.'.($k+1));
                        $data = [
                            'number' => $row,
                            'date'   => $date,
                            'giai'   => $giai,
                            'cat_id' => $cat_id,
                            'page' => $page,
                        ];
                        $this->save_number($data);
                    }
                }
            }

            // Thông báo
            admin_success('Lưu thành công!');
        });

        return $form;
    }

    /**
     * Hàm lấy giá trị mặc định để fill vào input khi edit
     */
    protected function getDefaultValue($id, $giai)
    {
        $record = Number::find($id);
        if (!$record) return '';

        return Number::where('date', $record->date)
            ->where('cat_id', $record->cat_id)
            ->where('giai','>=', $giai)
            ->where('giai','<', $giai+1)
            ->pluck('number')
            ->implode(' - ');
    }
// Hàm tách chuỗi
    protected function get_mang($mang = '')
    {
        $mang= trim($mang);
        $mang = str_replace(' ', '-', $mang);
        $mang = explode('-', $mang);
        $data = [];
        foreach ($mang as $row) {
            if ($row != '') $data[] = trim($row);
        }
        return $data;
    }

// Hàm save_number cũ (bạn có thể giữ nguyên)
    protected function save_number($data = [], $id = null)
    {
        $objVocabulary = new Number();
        if ($id != '') {
            $objVocabulary = $objVocabulary->where('id', $id)->first();
        } else {
            $objVocabulary = $objVocabulary
                ->where('cat_id', $data['cat_id'])
                ->where('date', $data['date'])
                ->where('giai', '=', floatval($data['giai']))
                ->first();
            if (!isset($objVocabulary->id)) $objVocabulary = new Number();
        }

        $objVocabulary->number  = $data['number'] ?? '';
        $objVocabulary->date    = $data['date'] ?? '';
        $objVocabulary->giai    = $data['giai'] ?? '';
        $objVocabulary->page    = $data['page'] ?? 'admin';
        $objVocabulary->dau     = isset($data['number']) ? substr($data['number'], 0, 2) : '';
        $objVocabulary->duoi    = isset($data['number']) ? substr($data['number'], -2) : '';
        $objVocabulary->dauso   = isset($data['number']) ? substr($data['number'], -2, 1) : '';
        $objVocabulary->duoiso  = isset($data['number']) ? substr($data['number'], -1) : '';
        $objVocabulary->cat_id  = $data['cat_id'] ?? '13';
        $objVocabulary->save();
       }
}
