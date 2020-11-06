<?php

namespace App\Widgets;

use App\Admin\Order;
use App\User;
use Arrilot\Widgets\AbstractWidget;
use Carbon\Carbon;

class RecentOrder extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];
    public $reloadTimeout = 10;

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $orders = Order::where('user_id',auth()->guard('admin')->user()->id)->where('status',1)->whereDate('created_at', Carbon::today()->toDateString())->get();

        return view('widgets.recent_order', [
            'config' => $this->config,
            'orders' => $orders,
        ]);
    }
}
