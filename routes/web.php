<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
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

Route::get('/', function (Request $request) {
    if ($request->wantsJson()) {
        return response()->json([
            'title' => env('APP_NAME'),
            'description' => env('APP_DESCRIPTION'),
            'language' => 'PHP ' . PHP_VERSION,
            'framework' => 'Laravel v' . Illuminate\Foundation\Application::VERSION
        ]);
    } else {
        return view('welcome');
    }
});
