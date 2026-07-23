<?php

namespace App\Traits\Controllers;

use App\Models\CLocationCity;
use App\Models\CLocationCommunity;
use App\Models\CLocationStreet;
use App\Models\Contact;
use App\Models\RealtorUser;
use Illuminate\Database\Eloquent\Builder;

trait AddEstateFetchMethods
{
    public function fetchAgent()
    {
        return $this->fetch([
            'model' => RealtorUser::class,
            'searchable_attributes' => [],
            'paginate' => 1500, // items to show per page
            'query' => function ($model) {
                $search = request()->input('q') ?? false;
                if ($search) {
                    return $model->whereHas('contact', function ($query) use($search) {
                        $query->where('contact_type_id', 3)
                            ->whereNotNull('name_arm')
                            ->whereRaw('CONCAT_WS(" ", `name_eng`, `last_name_eng`, `name_arm`, `last_name_arm`, `id`) LIKE ?', ['%' . $search . '%']);
                    })
                        ->whereHas('roles', function ($query) {
                            $query->whereIn('role_id', [3,4, 6, 7, 8]);
                        })
                        ->select('realtor_user.*')->orderBy('contact_id');
                } else {
                    return $model->whereHas('contact', function ($query) {
                        $query->where('contact_type_id', 3)
                            ->whereNotNull('name_arm');
                    })
                        ->whereHas('roles', function ($query) {
                            $query->whereIn('role_id', [3,4, 6, 7, 8]);
                        })
                        ->select('realtor_user.*')->where('is_active', 1)
                        ->orderBy('contact_id');
                }
            }
        ]);
    }

    public function fetchSeller()
    {
        return $this->fetch([
            'model' => Contact::class,
            'searchable_attributes' => [],
            'paginate' => 100,
            'query' => function ($model) {
                $search = request()->input('q') ?? false;
                if ($search) {
                    return $model->where('contact_type_id', 1)->where(function ($query) use ($search) {
                        $searchWithSpaces = str_replace(' ', '', $search);
                        $query
                            ->whereRaw('CONCAT_WS(" ", `name_eng`, `last_name_eng`, `name_arm`, `last_name_arm`, `id`) LIKE ?', ['%' . $search . '%'])
                            ->orWhereRaw('REPLACE(`phone_mobile_1`, " ", "") LIKE ?', ['%' . $searchWithSpaces . '%']);
                    });
                } else {
                    return $model->where('contact_type_id', 1);
                }
            }
        ]);
    }

    public function fetchBuyer()
    {
        return $this->fetch([
            'model' => Contact::class,
            'searchable_attributes' => [],
            'paginate' => 100,
            'query' => function ($model) {
                $search = request()->input('q') ?? false;
                if ($search) {
                    return $model->where('contact_type_id', 4)->where(function ($query) use ($search) {
                        $searchWithSpaces = str_replace(' ', '', $search);
                        $query
                            ->whereRaw('CONCAT_WS(" ", `name_eng`, `last_name_eng`, `name_arm`, `last_name_arm`, `id`) LIKE ?', ['%' . $search . '%'])
                            ->orWhereRaw('REPLACE(`phone_mobile_1`, " ", "") LIKE ?', ['%' . $searchWithSpaces . '%']);
                    });
                } else {
                    return $model->where('contact_type_id', 4);
                }
            }
        ]);
    }


    public function fetchOwner()
    {
        return $this->fetch([
            'model' => Contact::class,
            'searchable_attributes' => [],
            'paginate' => 100,
            'query' => function ($model) {
                $search = request()->input('q') ?? false;
                if ($search) {
                    return $model->where('contact_type_id', 2)->where(function ($query) use ($search) {
                        $searchWithSpaces = str_replace(' ', '', $search);
                        $query
                            ->whereRaw('CONCAT_WS(" ", `name_eng`, `last_name_eng`, `name_arm`, `last_name_arm`, `id`) LIKE ?', ['%' . $search . '%'])
                            ->orWhereRaw('REPLACE(`phone_mobile_1`, " ", "") LIKE ?', ['%' . $searchWithSpaces . '%']);
                    });
                } else {
                    return $model->where('contact_type_id', 2);
                }
            }
        ]);
    }

    public function fetchPropertyAgent()
    {
        return $this->fetch([
            'model' => Contact::class,
            'searchable_attributes' => [],
            'paginate' => 30, // items to show per page
            'searchOperator' => 'LIKE',
            'query' => function ($model) {
                $search = request()->input('q') ?? false;
                if ($search) {
                    return $model->where('contact_type_id', '=', 3)->whereRaw('CONCAT_WS(" ", `name_arm`, `last_name_arm`) LIKE ?', ['%' . $search . '%']);
                } else {
                    return $model->where('contact_type_id', '=', 3);
                }
            }
        ]);
    }


    public function fetchInfoSource()
    {
        return $this->fetch([
            'model' => RealtorUser::class,
            'searchable_attributes' => [],
            'paginate' => 30, // items to show per page
            'searchOperator' => 'LIKE',
            'query' => function ($model) {
                $search = request()->input('q') ?? false;
                if ($search) {
                    return $model->with('contact')
                        ->whereHas('contact', function (Builder $query) use ($search) {
                            $query->whereRaw('CONCAT_WS(" ", `name_arm`, `last_name_arm`) LIKE ?', ['%' . $search . '%']);
                        });
                } else {
                    return $model->with('contact')->whereHas('roles', function (Builder $query) {
                        $query->whereIn('c_role.id', [1, 4],);
                    });
                }
            }
        ]);
    }

    public function fetchLocationCity()
    {
        return $this->fetch([
            'model' => CLocationCity::class,
            'searchable_attributes' => [],
            'paginate' => 30, // items to show per page
            'searchOperator' => 'LIKE',
            'query' => function ($model) {
                $params = collect(request()->input('form'))->pluck('value', 'name');
                $provinceId = $params['location_province'];

                $search = request()->input('q') ?? false;
                if ($search) {
                    return $model->where('parent_id', '=', $provinceId)->whereRaw('CONCAT_WS(" ", `name_eng`, `name_arm`) LIKE ?', ['%' . $search . '%']);
                } else {
                    return $model->where('parent_id', '=', $provinceId);
                }
            }
        ]);
    }

    public function fetchLocationCommunity()
    {
        return $this->fetch([
            'model' => CLocationCommunity::class,
            'searchable_attributes' => [],
            'paginate' => 30, // items to show per page
            'searchOperator' => 'LIKE',
            'query' => function ($model) {
                $params = collect(request()->input('form'))->pluck('value', 'name');
                $provinceId = $params['location_province'];
                $search = request()->input('q') ?? false;
                if ($search) {
                    return $model->where('parent_id', '=', $provinceId)->whereRaw('CONCAT_WS(" ", `name_eng`, `name_arm`) LIKE ?', ['%' . $search . '%']);
                } else {
                    return $model->where('parent_id', '=', $provinceId);
                }
            }
        ]);
    }

    public function fetchRenter()
    {
        return $this->fetch([
            'model' => Contact::class,
            'searchable_attributes' => [],
            'paginate' => 100, // items to show per page
            'query' => function ($model) {
                $search = request()->input('q') ?? false;
                if ($search) {
                    return $model->whereIn('contact_type_id', [4,5])->whereRaw('CONCAT_WS(" ", `name_eng`, `last_name_eng`, `name_arm`, `last_name_arm`, `id`) LIKE ?', ['%' . $search . '%']);
                } else {
                    return $model->whereIn('contact_type_id', [4,5]);
                }
            }
        ]);
    }

    public function fetchLocationStreet()
    {
        return $this->fetch([
            'model' => CLocationStreet::class,
            'searchable_attributes' => [],
            'paginate' => 30, // items to show per page
            'searchOperator' => 'LIKE',
            'query' => function ($model) {
                $params = collect(request()->input('form'))->pluck('value', 'name');
                $cityId = $params['location_city'];
                $communityId = $params['location_community'];
                $search = request()->input('q') ?? false;
                if ($search && $communityId) {
                    return $model->where('parent_is_community', true)
                        ->where('community_id', '=', $communityId)
                        ->whereRaw('CONCAT_WS(" ", `name_eng`, `name_arm`) LIKE ?', ['%' . $search . '%']);
                } elseif ($search && $cityId) {
                    return $model->where('parent_is_community', false)
                        ->where('city_id', '=', $cityId)
                        ->whereRaw('CONCAT_WS(" ", `name_eng`, `name_arm`) LIKE ?', ['%' . $search . '%']);
                } elseif ($communityId) {
                    return $model->where('parent_is_community', true)->where('community_id', '=', $communityId);
                } elseif ($cityId) {
                    return $model->where('parent_is_community', false)->where('city_id', '=', $cityId);
                } else {
                    return $model->where('id', '<', 0);
                }
            }
        ]);
    }
}
