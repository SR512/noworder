<?php

namespace App\Widgets;

use App\Admin\Visitor;
use App\User;
use Arrilot\Widgets\AbstractWidget;
use Carbon\Carbon;

class TodayVisitor extends AbstractWidget
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
        //
        $visitors = Visitor::where('user_id',auth()->guard('admin')->user()->id)->whereDate('created_at', Carbon::today()->toDateString())->latest()->get();

        return view('widgets.today_visitor', [
            'config' => $this->config,
            'visitors' => $visitors,
        ]);
    }
}
