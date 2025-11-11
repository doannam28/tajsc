<?php

namespace App\Admin\Controllers;

use App\Models\Keys;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class KeysController extends BaseAdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Ký hiệu';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Keys());
        $grid->model()->orderBy('date', 'desc');
        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('date', __('Date'));
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
        $show = new Show(Keys::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Name'));
        $show->field('date', __('Date'));
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
        $form = new Form(new Keys());

        $form->text('title', __('Name'));
        $form->date('date', 'Ngày')
            ->default(date('Y-m-d'))
            ->rules('required');
        $form->switch('status', __('Status'))->default(1);
        return $form;
    }
}
