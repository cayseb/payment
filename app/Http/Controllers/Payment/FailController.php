<?php

declare(strict_types=1);

namespace App\Http\Controllers\Payment;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class FailController
{
    public function __invoke(): View|\Illuminate\Foundation\Application|Factory|Application
    {
       return view('fail');
    }
}
