<?php
namespace App\Scopes;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class UserAppStatus implements Scope
{

    public function apply(Builder $builder, Model $model)
    {
        if(Auth::check()){
        $s_user = Auth::user();
        if($s_user->is_admin==0){
            $builder->where('status',1);
        }
    }
}
}