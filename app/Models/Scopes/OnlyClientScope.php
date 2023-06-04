<?php
/*
 * Made With ♥ By Mohamed Said
 * GitHub: https://github.com/EGYWEB-Mohamed
 * Email: me@msaied.com
 * Website: https://msaied.com/
 */

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class OnlyClientScope implements Scope
{
    public function apply(Builder $builder,Model $model)
    {
        if (auth()->check() and auth()->user()->hasRole('client')){
            $builder->where('user_id',auth()->id());
        }
    }
}
