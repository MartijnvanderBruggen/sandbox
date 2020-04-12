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
    
    $users = [];
    $branches = Branch::with('companies.users')->where('name','LIKE', '%'.$request->name.'%')->get();
    foreach($branches as $branch){
        foreach($branch->companies as $company){
            foreach($company->users as $user) {
                $users[] = $user->name;
            }
        }
    }
    
    
//$users = User::whereHas('company.branch', function($q) use($search){ $q->where('name','=','%'.$search.'%');})->pluck('name');
    return response()->json($users);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
