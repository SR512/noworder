<?php

namespace App\Http\Middleware;

use App\Admin\Admin;
use App\Admin\Visitor;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Env;
use Stevebauman\Location\Facades\Location;

class SiteSettingsMiddkeware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $name = "it-planet";
        $userdata = Admin::where('businessname', 'it-planet')->first();
        if ($userdata != null) {
            if (!session()->has('sitesettings')) {
                session()->put('sitesettings', true);
                session()->put('id', $userdata->id);
                session()->put('name', $userdata->name);
                session()->put('businessname', $userdata->businessname);
                session()->put('address', $userdata->address);
                session()->put('state', $userdata->state);
                session()->put('city', $userdata->city);
                session()->put('mobile ', $userdata->mobile);
                session()->put('razor_key', $userdata->razor_key);
                session()->put('razor_secret', $userdata->razor_secret);
                session()->put('iscod', $userdata->iscod);
                session()->put('ispayment', $userdata->ispayment);
                session()->put('fb', $userdata->fb);
                session()->put('insta', $userdata->insta);
                session()->put('youtube', $userdata->youtube);
                session()->put('whatsapp', $userdata->whatsapp);
            } else {
                session()->put('sitesettings', true);
                session()->put('id', $userdata->id);
                session()->put('name', $userdata->name);
                session()->put('businessname', $userdata->businessname);
                session()->put('address', $userdata->address);
                session()->put('state', $userdata->state);
                session()->put('city', $userdata->city);
                session()->put('mobile ', $userdata->mobile);
                session()->put('razor_key', $userdata->razor_key);
                session()->put('razor_secret', $userdata->razor_secret);
                session()->put('iscod', $userdata->iscod);
                session()->put('isopen', $userdata->isopen);
                session()->put('time', $userdata->time);
                session()->put('ispayment', $userdata->ispayment);
                session()->put('fb', $userdata->fb);
                session()->put('insta', $userdata->insta);
                session()->put('youtube', $userdata->youtube);
                session()->put('whatsapp', $userdata->whatsapp);
            }

            $visitor = Visitor::where('ip', $request->ip())->whereDate('created_at', Carbon::today()->toDateString())->get();
            if (count($visitor) == 0) {

                $ip = $request->ip();
                $data = Location::get($ip);
                if ($data) {
                    Visitor::create([
                        'user_id' => session()->get('id'),
                        'ip' => $data->ip,
                        'countryName' => $data->countryName,
                        'countryCode' => $data->countryCode,
                        'regionCode' => $data->regionCode,
                        'regionName' => $data->regionName,
                        'cityName' => $data->cityName,
                        'zipCode' => $data->zipCode,
                        'latitude' => $data->latitude,
                        'longitude' => $data->longitude,
                    ]);
                }
            }
            return $next($request);

        } else {
            abort(404);
        }
    }
}
