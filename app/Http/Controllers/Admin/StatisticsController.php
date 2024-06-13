<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use Carbon\Carbon;
use App\Models\Apk;
;
use App\Models\ApkView;
use App\Models\Activity;
use App\Models\ApkUser;

use App\Models\Wallpapper;
use Illuminate\Http\Request;
use App\Models\WallpapperView;
use App\Models\WallpapperClick;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class StatisticsController extends Controller
{
    public function Dashboard($apk_id=0){
      
        $week  = Carbon::today()->subDays(7)->format('Y-m-d');
        $month = Carbon::today()->subDays(30)->format('Y-m-d');
        $date_array = array();

        $cats  = Apk::withCount('Wallpapper')->withCount('apk_user')->get();

        if(count($cats)!=0){
         if($apk_id!=0){
             session(['apk' => $apk_id]);
         }else{
             $apk_id = session('apk');
         }
 
         if($apk_id == null or (count($cats) == 1 and $apk_id != $cats[0]->id)){
             $apk_id = $cats[0]->id ;
             session(['apk' => $apk_id]);     
         }
        }else{
         $apk_id = null;
         session(['apk' => null]);
 
        }


        ///////////////////////////////////////////////////////////


        $wallpapper_clicks= WallpapperClick::where('apk_id',$apk_id)->where('created_at','>=', $week)
        ->selectRaw("COUNT(*) total, DATE_FORMAT(created_at, '%m-%d') date")
        ->groupBy('date')
        ->pluck('total','date');

        $wallpapper_clicks_day = 0 ;

        if(isset($wallpapper_clicks[Carbon::today()->format('m-d')])){
            $wallpapper_clicks_day =+  $wallpapper_clicks[Carbon::today()->format('m-d')] ;
        }

        $total_clicks =  $wallpapper_clicks_day ;

        if($total_clicks != 0){
            $wallpapper_clicks_stat = round($wallpapper_clicks_day/$total_clicks, 2) ;
        }else{
            $wallpapper_clicks_stat = 0;
        }
       
       
/////////////////////////////////////////////////////

       
   
        $wallpappers = Wallpapper::where('apk_id',$apk_id)->withCount('wallpapper_view as r_nbr')->orderBy('r_nbr','DESC')->limit(20)->get();


  
        $total_users  =  ApkUser::where('apk_id',$apk_id)->count();
        $activities   =  Activity::limit(10)->orderBy('id','desc')->get();

        $user_day2 =  ApkUser::where('apk_id',$apk_id)
        ->where('created_at','>=', $month)
        ->selectRaw("COUNT(*) total, DATE_FORMAT(created_at, '%Y-%m-%d') date")
        ->groupBy('date')
        ->pluck('total','date');

        $total_views =  ApkView::where('apk_id',$apk_id)->count();

        $view_day2 =  ApkView::where('apk_id',$apk_id)
        ->where('created_at','>=', $month)
        ->selectRaw("COUNT(*) total, DATE_FORMAT(created_at, '%Y-%m-%d') date")
        ->groupBy('date')
        ->pluck('total','date');

        $total_apk_users=  WallpapperView::join('wallpappers','wallpappers.id','wallpapper_views.wallpapper_id')->where('wallpappers.apk_id',$apk_id)->count();

        $apk_users2 =  WallpapperView::join('wallpappers','wallpappers.id','wallpapper_views.wallpapper_id')->where('wallpappers.apk_id',$apk_id)
        ->where('wallpapper_views.created_at','>=', $week)
        ->selectRaw("COUNT(*) total, DATE_FORMAT(wallpapper_views.created_at, '%Y-%m-%d') date")
        ->groupBy('date')
        ->pluck('total','date');

        $user_day1=array();
        $view_day1=array();
        $apk_users1=array();
        $click_week = array();

        for ($i=29; $i >=0; $i--) { 
            $day = Carbon::today()->subDays($i)->format('Y-m-d');
            $user_day1[$day] =  $user_day2[$day] ?? 0;
            $view_day1[$day] =  $view_day2[$day] ?? 0;
        }
        for ($i=6; $i >=0; $i--) { 
            $day = Carbon::today()->subDays($i)->format('Y-m-d');
            $day2 = Carbon::today()->subDays($i)->format('m-d');

            $apk_users1[Carbon::today()->subDays($i)->format('m-d')] =  $apk_users2[$day] ?? 0;
            $click_week[$i]['d'] = $day;

            $click_week[$i]['store'] = $store_clicks[$day2] ?? 0;
            $click_week[$i]['post']  = $post_clicks[$day2] ?? 0;
            $click_week[$i]['course']= $wallpapper_clicks[$day2] ?? 0;

        }

        
        if($click_week[1]['store'] != 0){
            $store_click_improve  = (($click_week[0]['store'] - $click_week[1]['store'])/$click_week[1]['store'])*100 ;
        }elseif($click_week[1]['store'] == 0 and $click_week[0]['store'] == 0){
            $store_click_improve  = 0 ;
        }

        if($click_week[1]['post'] != 0){
            $post_click_improve  = (($click_week[0]['post'] - $click_week[1]['post'])/$click_week[1]['post'])*100 ;
        }elseif($click_week[1]['post'] == 0 and $click_week[0]['post'] == 0){
            $post_click_improve  = 0 ;
        }


        if($click_week[1]['course'] != 0){
            $course_click_improve  = (($click_week[0]['course'] - $click_week[1]['course'])/$click_week[1]['course'])*100 ;
        }elseif($click_week[1]['course'] == 0 and $click_week[0]['course'] == 0){
            $course_click_improve  = 0 ;
        }

        $user_day = array_values($user_day1);       
        $view_day = array_values($view_day1); 
        $apk_users  = array_values($apk_users1); 

        $users60 =  ApkUser::where('apk_id',$apk_id)->where('created_at','<', $month)->where('created_at','>=', Carbon::today()->subDays(60)->format('Y-m-d'))->count();
        $views60 =  ApkView::where('apk_id',$apk_id)->where('created_at','<', $month)->where('created_at','>=', Carbon::today()->subDays(60)->format('Y-m-d'))->count();
        $apk_users_x2 =  WallpapperView::join('wallpappers','wallpappers.id','wallpapper_views.wallpapper_id')->where('wallpappers.apk_id',$apk_id)
        ->where('wallpapper_views.created_at','<', $week)->where('wallpapper_views.created_at','>=', Carbon::today()->subDays(15)->format('Y-m-d'))->count();
       
        $def =  array_sum($user_day) - $users60 ;
        $def2 =  array_sum($view_day) - $views60 ;
        $def_apk_users =  array_sum($apk_users) - $apk_users_x2 ;


        if ($def >= 0) {
            $users_pregress = ($users60 == 0 ) ? $def*100  : ($def/$users60)*100 ;
        }else{
            $users_pregress = (array_sum($user_day) == 0 ) ? 0 :($def/array_sum($user_day))*100;
        }

        if ($def2 >= 0) {
            $views_pregress = ($views60 == 0 ) ? $def2*100  : ($def2/$views60)*100 ;
        }else{
            $views_pregress = (array_sum($view_day) == 0 ) ? 0 :($def2/array_sum($view_day))*100;
        }

        if ($def_apk_users >= 0) {
            if($views60 != 0){
                $apk_users_pregress = ($apk_users_x2 == 0 ) ? $def_apk_users*100  : ($def_apk_users/$views60)*100 ;
            }else{
                $apk_users_pregress = 0;
            }
        }else{
            $apk_users_pregress = (array_sum($apk_users) == 0 ) ? 0 :($def_apk_users/array_sum($apk_users))*100;
        }

        return view('admin.mains-admin.statistics.dashboard',[
              'total_users'     =>$total_users,
              'user_day'        =>$user_day,
              'users_pregress'  =>number_format($users_pregress, 1, '.', ','),

              'total_views'     =>$total_views,
              'view_day'        =>$view_day,
              'views_pregress'  =>number_format($views_pregress, 1, '.', ','),

              'total_apk_users'   =>$total_apk_users,
              'apk_users1'        =>$apk_users1,
              'apk_users_pregress'=>number_format($apk_users_pregress, 1, '.', ','),
              'apks'      =>$cats,
              'activities'      =>$activities,
              'wallpappers'           =>$wallpappers,

              'wallpapper_clicks_day'   =>$wallpapper_clicks_day,

              'wallpapper_clicks_stat'   =>$wallpapper_clicks_stat,
              'click_week'           =>$click_week,





        //    'total_employee'=>$total_employee,
        //    'total_company'=>$total_company,
        //    'total_product'=>$total_product,
        //    'total_vendor'=>$total_vendor,
        //    'best_sales'=>$best_sales,
        ]);
    }




    public function CatChange($apk_id){
        session(['apk' => $apk_id]);
        return back();
    }

    public function getOnlineCustomers()
    {
        $onlines=DB::table('oc_customer_online','co')
        ->leftjoin("oc_customer",'co.customer_id','oc_customer.customer_id')
        ->select('co.*',DB::raw('CONCAT(oc_customer.firstname," ",oc_customer.lastname) as fullname'))
        ->orderby('co.date_added')->get();

        //dd($onlines);
        return view('admin.mains-admin.statistics.online-customer',[
            'onlines'=>$onlines,
        ]);
    }

    public function TopSales(Request $request){

        if($request->ajax()) {
        switch ($request->time) {

            case 'today':

                $best_sales=DB::select("SELECT p.product_id,pd.name,p.quantity,image, SUM(op.quantity) AS sum_quantity,
                SUM(op.total) AS sum_total FROM oc_product p LEFT JOIN oc_product_description pd ON (p.product_id = pd.product_id),oc_order_product op,oc_order o
                WHERE p.product_id=op.product_id AND o.order_id=op.order_id  and o.date_added BETWEEN (NOW() - INTERVAL 1 DAY) AND NOW() AND  pd.language_id='1'
                GROUP BY `product_id` ,pd.name,p.quantity,image
                ORDER BY sum_quantity DESC LIMIT 7");

                return view('admin.mains-admin.statistics.top-sales',['best_sales'=>$best_sales]);
                break;

            case 'lastweek':

                $best_sales=DB::select("SELECT p.product_id,pd.name,p.quantity,image, SUM(op.quantity) AS sum_quantity,
                SUM(op.total) AS sum_total FROM oc_product p LEFT JOIN oc_product_description pd ON (p.product_id = pd.product_id),oc_order_product op,oc_order o
                WHERE p.product_id=op.product_id AND o.order_id=op.order_id  and o.date_added BETWEEN (NOW() - INTERVAL 7 DAY) AND NOW() AND  pd.language_id='1'
                GROUP BY `product_id` ,pd.name,p.quantity,image
                ORDER BY sum_quantity DESC LIMIT 7");

               return view('admin.mains-admin.statistics.top-sales',['best_sales'=>$best_sales]);
                break;

            case 'lastmonth':

                $best_sales=DB::select("SELECT p.product_id,pd.name,p.quantity,image, SUM(op.quantity) AS sum_quantity,
                SUM(op.total) AS sum_total FROM oc_product p LEFT JOIN oc_product_description pd ON (p.product_id = pd.product_id),oc_order_product op,oc_order o
                WHERE p.product_id=op.product_id AND o.order_id=op.order_id  and o.date_added BETWEEN (NOW() - INTERVAL 1 MONTH) AND NOW() AND  pd.language_id='1'
                GROUP BY `product_id` ,pd.name,p.quantity,image
                ORDER BY sum_quantity DESC LIMIT 7");

                return view('admin.mains-admin.statistics.top-sales',['best_sales'=>$best_sales]);
                break;

            case 'lastyear':

                $best_sales=DB::select("SELECT p.product_id,pd.name,p.quantity,image, SUM(op.quantity) AS sum_quantity,
                SUM(op.total) AS sum_total FROM oc_product p LEFT JOIN oc_product_description pd ON (p.product_id = pd.product_id),oc_order_product op,oc_order o
                WHERE p.product_id=op.product_id AND o.order_id=op.order_id  and o.date_added BETWEEN (NOW() - INTERVAL 1 Year) AND NOW() AND  pd.language_id='1'
                GROUP BY `product_id` ,pd.name,p.quantity,image
                ORDER BY sum_quantity DESC LIMIT 7");

                return view('admin.mains-admin.statistics.top-sales',['best_sales'=>$best_sales]);
                break;

        }
    }
}

}

