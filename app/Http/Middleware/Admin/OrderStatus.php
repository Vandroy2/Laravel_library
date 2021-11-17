<?php

namespace App\Http\Middleware\Admin;

use App\Models\Order;
use Closure;
use Illuminate\Http\Request;

class OrderStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     *
     */

    public function handle(Request $request, Closure $next)
    {

        $order = $request->route('order');

        if ($order->status->status == 'allowed'){
            return redirect()->back()->with('errors', 'Заказ уже отправлен. Вы не можете его отредактировать');
        }

        if ($order->status->status == 'canceled'){
            return redirect()->back()->with('errors', 'Заказ был отменен. Вы не можете его отредактировать');
        }

        return $next($request);

    }
}
