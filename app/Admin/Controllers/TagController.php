<?php

declare(strict_types=1);

namespace App\Admin\Controllers;

use App\Models\Tag;
use Carbon\Carbon;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class TagController extends AdminController
{
    public function index(Content $content): Content
    {
        return $content
            ->title('Тэги')
            ->breadcrumb(
                [
                    'text' => 'Тэги',
                    'url' => route('admin.tags.index')
                ])->body($this->grid());
    }

    protected function grid(): Grid
    {
        $grid = new Grid(new Tag());
        $grid->column('name', 'Название');
        $grid->column('created_at', 'Дата создания')->display(function ($date) {
            return Carbon::parse($date)->format('d-m-Y');
        });
        $grid->disableCreateButton(false);
        return $grid;
    }

    protected function form(): Form
    {
        $form = new Form(new Tag());
        $form->text('name', 'Название')->required();
        return $form;
    }

    public function create(Content $content): Content
    {
        $content->breadcrumb(
            ['text' => 'Тэги', 'url' => route('admin.tags.index')],
            ['text' => 'Создание', 'url' => '/']
        );
        return $content->body($this->form());
    }

    public function edit($id, Content $content): Content
    {
        $tag = Tag::findOrFail($id);
        $content->breadcrumb(
            ['text' => 'Тэги', 'url' => route('admin.tags.index')],
            ['text' => $tag->name, 'url' => '/']
        );
        return $content->body($this->form()->edit($id));
    }
}
