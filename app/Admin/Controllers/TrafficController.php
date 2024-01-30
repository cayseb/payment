<?php

declare(strict_types=1);

namespace App\Admin\Controllers;

use App\Models\Tariff;
use Carbon\Carbon;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class TrafficController extends AdminController
{
    public function index(Content $content): Content
    {
        return $content
            ->title('Трафик')
            ->breadcrumb(
                [
                    'text' => 'Трафик',
                    'url' => route('admin.traffic.index')
                ])->body($this->grid());
    }

    protected function grid(): Grid
    {
        $grid = new Grid(new Tariff());
        $grid->column('period', 'Период');
        $grid->column('price', 'Цена');
        $grid->column('created_at', 'Дата создания')->display(function ($date) {
            return Carbon::parse($date)->format('d-m-Y');
        });
        $grid->disableCreateButton(false);
        return $grid;
    }

    protected function form(): Form
    {
        $form = new Form(new Tariff());
        $form->select('period','Период')->options([1 => 'Месяц', 3 => 'Три месяца', 6 => 'Полгода',12 => 'Год']);
        $form->number('price', 'Цена в рублях')->required();
        return $form;
    }

    public function create(Content $content): Content
    {
        $content->breadcrumb(
            ['text' => 'Трафик', 'url' => route('admin.traffic.index')],
            ['text' => 'Создание', 'url' => '/']
        );
        return $content->body($this->form());
    }

    public function edit($id, Content $content): Content
    {
        $traffic = Tariff::findOrFail($id);
        $content->breadcrumb(
            ['text' => 'Трафик', 'url' => route('admin.traffic.index')],
            ['text' => $traffic->period, 'url' => '/']
        );
        return $content->body($this->form()->edit($id));
    }
}
