<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/pagination', function () {
    $filter = request('filter');
    $totalPage = request('paginate', 10);
    $users = User::where('name', 'LIKE', "%{$filter}%")->paginate($totalPage);
    
    return $users;
});

Route::get('/where', function (User $user) {
    $filter = 'a';

    // $user = $user->where('email', '=', 'ikunde@example.com')->first();
    // $user = $user->where('email', 'ikunde@example.com')->first();
    // // $users = $user->where('name', 'LIKE', "%{$filter}%")->get();
    // $users = $user->where('name', 'LIKE', "%{$filter}%")
    //                 ->whereIn('email', [])
    //                 ->get();
    $users = $user->where('name', 'LIKE', "%{$filter}%")
                    ->orWhere(function ($query) use ($filter) {
                        $query->where('name', '<>', 'Carlos');
                        $query->where('name', '=', $filter);
                    })
                    ->toSql();

    dd($users);
});

Route::get('/select', function () {
    // $users = User::all();
    // $users = User::where('id', 1)->get();
    // $user = User::where('id', 10)->first();
    // $user = User::first();
    // $user = User::find(101);
    // $user = User::findOrFail(request('id'));
    // $user = User::where('name', request('name'))->firstOrFail();
    // $user = User::firstWhere('name', request('name'));

    // dd($user);
});

Route::get('/', function () {
    return view('welcome');
});
