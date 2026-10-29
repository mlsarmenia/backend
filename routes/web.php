<?php

use App\Http\Controllers\PublicEstateController;
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

Route::get('/', function () {
    return redirect('/admin');
});

require __DIR__.'/auth.php';
