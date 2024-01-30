<?php

declare(strict_types=1);

namespace App\Admin\Controllers;

use App\Models\Article;
use App\Models\Tag;
use Carbon\Carbon;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class ArticleController extends AdminController
{
    public function index(Content $content): Content
    {
        return $content
            ->title('Статьи')
            ->breadcrumb(
                [
                    'text' => 'Статьи',
                    'url' => route('admin.articles.index')
                ])->body($this->grid());
    }

    protected function grid(): Grid
    {
        $grid = new Grid(new Article());
        $grid->column('title', 'Название');
        $grid->column('created_at', 'Дата создания')->display(function ($date) {
            return Carbon::parse($date)->format('d-m-Y');
        });
        $grid->disableCreateButton(false);
        return $grid;
    }

    protected function form(): Form
    {
        $form = new Form(new Article());
        $form->text('title', 'Название')->required();
        $form->textarea('text', 'Описание');
        $form->multipleSelect('tags', 'тэги')->options(Tag::all()->pluck('name', 'id'));
        return $form;
    }

    public function create(Content $content): Content
    {
        $content->breadcrumb(
            ['text' => 'Статьи', 'url' => route('admin.articles.index')],
            ['text' => 'Создание', 'url' => '/']
        );
        return $content->body($this->form());
    }

    public function edit($id, Content $content): Content
    {
        $article = Article::findOrFail($id);
        $content->breadcrumb(
            ['text' => 'Статьи', 'url' => route('admin.articles.index')],
            ['text' => $article->title, 'url' => '/']
        );
        return $content->body($this->form()->edit($id));
    }
}
