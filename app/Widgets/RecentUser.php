<?php

namespace App\Widgets;

use App\User;
use Arrilot\Widgets\AbstractWidget;
use Carbon\Carbon;

class RecentUser extends AbstractWidget
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
        $users = User::where('user_id',auth()->guard('admin')->user()->id)->whereDate('created_at', Carbon::today()->toDateString())->get();
        return view('widgets.recent_user', [
            'config' => $this->config,
            'users' => $users
        ]);
    }
}
