<?php

namespace App\Widgets;

use App\Admin\Admin;
use App\Admin\Visitor;
use Arrilot\Widgets\AbstractWidget;
use Carbon\Carbon;

class AdminVisitor extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $visitordata = null;

        $stores = Admin::whereHas('roles', function ($q) {
            $q->where('name', 'store');
        })->latest()->get();

        if (count($stores) != 0) {

            foreach ($stores as $list) {


                $visitor = Visitor::where('user_id',$list->id)->whereDate('created_at', Carbon::today()->toDateString())->get();
                $totalvisitors = Visitor::where('user_id',$list->id)->get();

                $data['id'] = $list->id;
                $data['business'] = $list->businessname;
                $data['visitor'] = count($visitor);
                $data['total'] = count($totalvisitors);

                $visitordata[] = $data;
            }
        }

        return view('widgets.admin_visitor', [
            'config' => $this->config,
            'visitordata' => $visitordata
        ]);
    }
}
