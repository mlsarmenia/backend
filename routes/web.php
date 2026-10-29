<?php

use App\Http\Controllers\PublicEstateController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/estates/{estate}', [PublicEstateController::class, 'show'])
    ->whereNumber('estate')
    ->name('estates.show');

Route::get('/_diagnostics/ashtarak-street-links-7f3c91a6', function () {
    $cities = DB::table('c_location_city')
        ->where('name_arm', 'like', '%Աշտարակ%')
        ->get(['id', 'parent_id', 'name_arm', 'name_eng', 'is_deleted']);
    $cityIds = $cities->pluck('id');

    return response()->json([
        'cities' => $cities,
        'pictured_streets' => DB::table('c_location_street')
            ->whereIn('id', [2219, 2167, 2114, 2004, 1416, 1415])
            ->get([
                'id',
                'parent_id',
                'city_id',
                'community_id',
                'parent_is_community',
                'is_deleted',
                'name_arm',
            ]),
        'streets_linked_to_candidate_cities' => DB::table('c_location_street')
            ->whereIn('parent_id', $cityIds)
            ->orWhereIn('city_id', $cityIds)
            ->get([
                'id',
                'parent_id',
                'city_id',
                'community_id',
                'parent_is_community',
                'is_deleted',
                'name_arm',
            ]),
    ]);
});

Route::get('/', function () {
    return redirect('/admin');
});

require __DIR__.'/auth.php';
