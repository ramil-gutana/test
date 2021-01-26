<?php

use App\Random;
use App\Breakdown;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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

Route::get('/', function () {
    return view('main');

});
Route::get('/add', function () {
    $randomNumberRandom = rand(5,10);
    $randomNumberBreakdown = rand(5,10);
    for ($i = 1; $i <= $randomNumberRandom; $i++) {
        $random = new Random();
        $random->values = Str::random(3);
        $random->save();
        for ($v = 1; $v <= $randomNumberBreakdown; $v++) {
            $random->breakdowns()->create(['values' => STR::random(5)]);
        }
    }

    return 'save';
});
Route::get('/text', function () {
    $random=Random::with('breakdowns')->where('flags','=',0)->get();
    $strms='';
    foreach($random as $rnd){
        foreach($rnd->breakdowns as $breakdown){
            $strms.=' '.$breakdown->values;
        }

    }
    return response()->json($strms) ;
});

Route::get('/all-randoms',function(){
    $randoms=Random::all();
    return response()->json($randoms);
});

Route::get('/all-breakdowns',function(){
    $breakdowns=Breakdown::all();
    return response()->json($breakdowns);
});
