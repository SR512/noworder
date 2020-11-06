<?php

namespace App\Widgets;

use App\Admin\Admin;
use App\User;
use Arrilot\Widgets\AbstractWidget;
use Carbon\Carbon;

class AdminStore extends AbstractWidget
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
        $stores = Admin::whereHas('roles', function ($q) {
            $q->where('name', 'store');
            $q->whereDate('created_at', Carbon::today()->toDateString());
        })->latest()->get();


        return view('widgets.admin_store', [
            'config' => $this->config,
            'stores' => $stores,
        ]);
    }
}
