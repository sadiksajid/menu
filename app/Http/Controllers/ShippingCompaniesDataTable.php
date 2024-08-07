<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ShippingCompany;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ShippingCompaniesDataTable extends Controller
{
    public function ShippingCompaniesList(Request $request)
    {
     

        if ($request->ajax()) {
            $company = ShippingCompany::where('id','>=',1);
            

             $tb = Datatables::of($company)
      
             ->editColumn('id', function ($item) {
                return  $item->id ;             
             })

             ->editColumn('logo', function ($item) {
                return '<img width="100px" src="'.get_image($item->logo).'" alt="">';
            })
            ->editColumn('name', function ($item)  {
                return $item->name;
            })
            ->editColumn('tag', function ($item)  {
                return $item->tag;
            })

 
            ->editColumn('url', function ($item) {
                return '  
                <a href="'.$item->site.'" target="_blank">
                    <button type="button" class="btn btn-dark btn-sm">
                        <i class="fa fa-external-link"></i>
                    </button>
                </a>
                ';
            })
            ->editColumn('date', function ($item) {
                return $item->created_at->format('d/m/Y');
            })
            ->editColumn('actions', function ($item) {
                return '  
                <a href="/staf/shipping_companies/edit/'.$item->id.'" target="_blank">
                <button type="button" class="btn btn-orange btn-sm">
                    <i class="fa fa-pencil-square-o"></i>
                </button>
                </a>
                ';
            })
    
            ->rawColumns(['id', 'logo', 'name', 'tag','url','date','actions'])
            ->only(['id', 'logo', 'name', 'tag','url','date','actions'])
            ->make(true);
            return $tb ; 
        } else return abort(404);
    }



    public function ShippingCompaniesListAdmin(Request $request)
    {
     

        if ($request->ajax()) {
            $company = ShippingCompany::where('shipping_companies.status', 1)
            ->leftJoin('shipping_company_to_stores', function($join) {
                $join->on('shipping_company_to_stores.shipping_company_id', '=', 'shipping_companies.id')
                     ->where('shipping_company_to_stores.store_id', Auth::user()->store->id);
            })
            ->select('shipping_companies.id','shipping_companies.status as company_status', 'shipping_companies.site', 'shipping_companies.logo', 'shipping_companies.name','shipping_companies.tag', 'shipping_company_to_stores.*');

             $tb = Datatables::of($company)
      
             ->editColumn('logo', function ($item) {
                return '<img width="100px" src="'.get_image($item->logo).'" alt="">';
            })
            ->editColumn('name', function ($item)  {
                return $item->name;
            })
            ->editColumn('status', function ($item)  {
                switch ($item->status) {
                    case 'pending':
                        return '<h6><span class="badge badge-warning">Pending</span></h6>';
                        break;
                    case 'active':
                        return '<h6><span class="badge badge-dark">Active</span></h6>';
                        break;
                    case 'inactive':
                        return '<h6><span class="badge badge-secondary">Inactive</span></h6>';
                        break;
                    case 'refused':
                        return '<h6><span class="badge badge-danger">Refused</span></h6>';
                        break;
                    case null:
                        return '<h6><span class="badge badge-secondary">Inactive</span></h6>';
                        break;
                    default:
                        return '<h6><span class="badge badge-secondary">Inactive</span></h6>';
                    break;
                }
            })

 
            ->editColumn('url', function ($item) {
                return '  
                <a href="'.$item->site.'" target="_blank">
                    <button type="button" class="btn btn-dark btn-sm">
                        <i class="fa fa-external-link"></i>
                    </button>
                </a>
                ';
            })
            ->editColumn('actions', function ($item) {
                if($item->api_id == null){
                    return '  
                    <a href="/admin/shipping_companies/integration/'.$item->tag.'" >
                    <button type="button" class="btn btn-orange btn-sm">
                        Start Inegration <i class="fa fa-exchange"></i>
                    </button>
                    </a>
                    ';
                }else{
                    return '   
                    <button type="button" class="btn btn-orange btn-sm rounded-circle">
                        <i class="fa fa-check-circle"></i>
                    </button>
                    ';
                }
            
            })
    
            ->rawColumns(['logo', 'name', 'status','url','actions'])
            ->only(['logo', 'name', 'status','url','actions'])
            ->make(true);

            return $tb ; 
        } else return abort(404);
    }






}