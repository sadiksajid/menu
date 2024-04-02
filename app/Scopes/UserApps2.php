<?php
namespace App\Scopes;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class UserApps2 implements Scope
{

    public function apply(Builder $builder, Model $model)
    {
        if(Auth::check()){
        $s_user = Auth::user();
        if($s_user->is_admin==0){
            $u_cats = $s_user->ApkAdmins->toArray();
            $builder->whereIn('id', array_column($u_cats, 'apk_id'));
        }
    }
}
}