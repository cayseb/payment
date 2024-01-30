<?php

declare(strict_types=1);

namespace App\Http\Controllers\Payment;

use App\Jobs\CheckSberOrderStatusJob;
use App\Models\Order;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SuccessController
{
    public function __invoke(Request $request): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $order = Order::where('external_id', $request->orderId)->firstOrFail();

        CheckSberOrderStatusJob::dispatch($order);

        return view('success');

    }
}
