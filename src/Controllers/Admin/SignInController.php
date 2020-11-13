<?php

namespace Qihucms\SignIn\Controllers\Admin;

use App\Admin\Controllers\Controller;
use Qihucms\SignIn\Models\SignIn;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SignInController extends Controller
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '签到日志';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SignIn);

        $grid->disableCreateButton();

        $grid->model()->latest();

        $grid->filter(function ($filter) {

            // 去掉默认的id过滤器
            $filter->disableIdFilter();

            $filter->like('user.username', __('user.username'));
            $filter->between('count', __('sign_in::sign_in.count'));

        });

        $grid->column('user_id', __('sign_in::sign_in.user_id'));
        $grid->column('user.username', __('user.username'));
        $grid->column('count', __('sign_in::sign_in.count'))->sortable();
        $grid->column('created_at', __('sign_in::sign_in.created_at'));
        $grid->column('updated_at', __('sign_in::sign_in.updated_at'));

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
        $show = new Show(SignIn::findOrFail($id));

        $show->field('user_id', __('sign_in::sign_in.user_id'));
        $show->field('count', __('sign_in::sign_in.count'));
        $show->field('created_at', __('sign_in::sign_in.created_at'));
        $show->field('updated_at', __('sign_in::sign_in.updated_at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new SignIn);

        $form->number('count', __('sign_in::sign_in.count'))->min(0);

        return $form;
    }
}
