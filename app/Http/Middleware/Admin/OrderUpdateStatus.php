<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Http\Request;

class OrderUpdateStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $order = $request->route('order');

        if ($order->orderBooks->isEmpty()){

            return redirect()->route('admin.orders')->with('success', 'заказ был очищен');
        }

        if ($order->status->status == 'accepted'){

            return redirect()->route('admin.orders')
                ->with('success', 'Заказ принят. Для обработки перейдите на страницу редактирования');
        }


        return $response;
    }
}
