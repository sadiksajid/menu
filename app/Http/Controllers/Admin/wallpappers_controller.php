<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Apk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class wallpappers_controller extends Controller
{
    public function Wallpappers()
    {
        // dd(session('apk'));

        return view('admin.mains-admin.wallpappers.wallpappers-list');
    }

    public function WallpappersRequest()
    {
        // dd(session('apk'));

        return view('admin.mains-admin.wallpappers.wallpappers-request');
    }

    public function ShowWallpapper($pdf)
    {
        $filename = $pdf;
        $path = storage_path('app') . '/Public/wallpappers/' . $pdf;
        try {
            return response()->file($path);
        } catch (\Throwable$th) {
            return Redirect::to('/');
        }
    }

    public function apk_usersAjax(Request $request)
    {
        $week = Carbon::today()->subDays(7)->format('Y-m-d');
        $week2 = Carbon::today()->subDays(15)->format('Y-m-d');
        $month = Carbon::today()->subDays(30)->format('Y-m-d');
        $month2 = Carbon::today()->subDays(60)->format('Y-m-d');
        $year = Carbon::today()->subDays(360)->format('Y-m-d');
        $year2 = Carbon::today()->subDays(720)->format('Y-m-d');
        if ($request->date == 7) {
            $date = $week;
            $date2 = $week2;
            $format = '%Y-%m-%d';
        } elseif ($request->date == 30) {
            $date = $month;
            $date2 = $month2;
            $format = '%Y-%m-%d';

        } else {
            $date = $year;
            $date2 = $year2;
            $format = '%Y-%m';

        }
        $apk_id = session('apk');

        if ($apk_id == null) {
            $apks = Apk::all();
            if (count($apks) != 0) {
                session(['apk' => $apks[0]->id]);
                $apk_id = $apks[0]->id;
            }

        }

        $apk_users2 = WallpapperView::join('wallpappers', 'wallpappers.id', 'wallpapper_views.wallpapper_id')->where('wallpappers.apk_id', $apk_id)
            ->where('wallpapper_views.created_at', '>=', $date)
            ->selectRaw("COUNT(*) total, DATE_FORMAT(wallpapper_views.created_at,'$format') date")
            ->groupBy('date')
            ->pluck('total', 'date');
        $apk_users1 = array();
        if ($request->date == 7 or $request->date == 30) {
            for ($i = $request->date; $i >= 0; $i--) {
                $day = Carbon::today()->subDays($i)->format('Y-m-d');
                $apk_users1[Carbon::today()->subDays($i)->format('m-d')] = $apk_users2[$day] ?? 0;
            }
        } else {
            for ($i = 12; $i >= 0; $i--) {
                $day = Carbon::today()->subMonth($i)->format('Y-m');
                $apk_users1[Carbon::today()->subMonth($i)->format('Y-m')] = $apk_users2[$day] ?? 0;
            }
        }

        $apk_users = array_values($apk_users1);
        $apk_users_x2 = WallpapperView::join('wallpappers', 'wallpappers.id', 'wallpapper_views.wallpapper_id')->where('wallpappers.apk_id', $apk_id)
            ->where('wallpapper_views.created_at', '<', $date)->where('wallpapper_views.created_at', '>=', $date2)->count();
        $def_apk_users = array_sum($apk_users) - $apk_users_x2;

        if ($def_apk_users >= 0) {
            $apk_users_pregress = ($apk_users_x2 == 0) ? $def_apk_users * 100 : ($def_apk_users / $views60) * 100;
        } else {
            $apk_users_pregress = (array_sum($apk_users) == 0) ? 0 : ($def_apk_users / array_sum($apk_users)) * 100;
        }
        $arr = [
            'apk_users_key' => array_keys($apk_users1),
            'apk_users_value' => array_values($apk_users1),
            'apk_users_pregress' => $apk_users_pregress,
        ];
        return $arr;
    }

}
