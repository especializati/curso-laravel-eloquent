<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

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
