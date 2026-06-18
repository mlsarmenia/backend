<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class EstateScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $user = backpack_user();

        if(!$user) {
//            $builder->where('main_image_file_path', 'IS NOT', NULL)->where('main_image_file_path_thumb', 'IS NOT', NULL);
            $builder->whereIn('estate_status_id', [2,3,4]);
        }
    }

}
