<?php

use App\Branch;
use App\City;
use App\Company;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request;

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
    $users = User::with('company','company.branch')->get();
    $companies = Company::with('users','branch')->get();
    
    return view('welcome',[
        'users' => $users,
        'companies' => $companies,
    ]);
});
Route::get('cities', function() {
    $cities = City::all()->pluck('name');
    return response()->json($cities);
});
Route::get('users', function() {
    $users = User::with('company','company.branch')->inRandomOrder()->paginate(24)->pluck('name');
    return response()->json($users);
});
Route::get('branches', function() {
    $branches = Branch::all()->pluck('name');
    return response()->json($branches);
});
Route::get('companies', function() {
    $companies = Company::all()->pluck('name');
    return response()->json($companies);
});
Route::get('usersBelongsToBranch', function(Request $request) {
    
    
    $cr = $request->companyName;
    $br = $request->branchName;
    $cn = $request->cityName;
    $data = [];
    $users = User::with(['company.branch','company'])
            ->whereHas('company', function($q) use($cr) {                
                $q->when($cr, function ($q, $cr) {
                    return $q->where('name', $cr);
                });
            })
            ->whereHas('company.branch',function($q) use($br){
                $q->when($br, function ($q, $br) {
                    return $q->where('name', $br);
                });
            })
            ->whereHas('company.cities',function($q) use($cn){
                $q->when($cn, function ($q, $cn) {
                    return $q->where('name', $cn);
                });
                
            })
            
            ->get();


    foreach($users as $user){
        $data[] = $user->name;        
    }
    
    
//$users = User::whereHas('company.branch', function($q) use($search){ $q->where('name','=','%'.$search.'%');})->pluck('name');
    return response()->json($data);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
