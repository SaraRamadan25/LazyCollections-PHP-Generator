<?php

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\LazyCollection;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('lazy', function () {
 $collection = Collection::times(100000)
     ->map(function ($number){
         return pow(2, $number);
     })
     ->all();

    $collection = LazyCollection::times(1000000)
        ->map(function ($number){
            return pow(2, $number);
        })
        ->all();
    User::cursor();
    return 'done ';
});


Route::get('generator',function () {

    function notHappyFunction($number): array
    {

        $return = [];

        for ($i=1;$i< $number; $i++) {

        $return[] = $i;
    }
    return $return;
}


function happyFunction($number): Generator
{
    for ($i = 1; $i < $number; $i++) {
    yield $i;
}
}
foreach (happyFunction(10000000) as $number){
    if ($number % 1000 == 0) {
        dump('hello');
    }
}
});
