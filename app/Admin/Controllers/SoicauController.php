<?php

namespace App\Admin\Controllers;

use App\Models\Soicau;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SoicauController extends BaseAdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Soi cầu';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Soicau());

        $grid->column('id', __('Id'));
        $grid->column('content', __('Nội dung 1'))->display(function ($content) {
            return $content; // render nguyên HTML
        });
        $grid->column('content1', __('Nội dung 2'))->display(function ($content) {
            return $content; // render nguyên HTML
        });
        $grid->column('status', __('Status'))->switch();
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Soicau::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('content', __('Nội dung 1'));
        $show->field('content1', __('Nội dung 2'));
        $show->field('status', __('Status'));
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
        $form = new Form(new Soicau());
        $form->tinyEditor('content', __('Nôi dung 1'));
        $form->tinyEditor('content1', __('Nôi dung 2'));
        $form->switch('status', __('Status'))->default(1);
        return $form;
    }
}
