<?php

use App\Models\Post;
use App\Models\User;
use App\Scopes\YearScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::get('/events', function () {
    $post = Post::create([
        'user_id' => 4,
        'title' => 'New Title ' . Str::random(10),
        'body' => Str::random(100),
        'date' => now(),
    ]);

    return $post;
});

Route::get('/observer', function () {
    $post = Post::create([
        'user_id' => 4,
        'title' => 'New Title ' . Str::random(10),
        'body' => Str::random(100),
        'date' => now(),
    ]);

    return $post;
});

Route::get('/global-scopes', function () {
    // $posts = Post::get();
    $posts = Post::withoutGlobalScope(YearScope::class)->get();

    return $posts;
});

Route::get('/anonymous-global-scopes', function () {
    // $posts = Post::get();
    $posts = Post::withoutGlobalScope('year')->get();

    return $posts;
});

Route::get('/local-scope', function () {
    // $posts = Post::lastWeek()->get();
    // $posts = Post::today()->get();
    $posts = Post::between('2021-01-01', '2021-12-31')->get();

    return $posts;
});

Route::get('/mutators', function () {
    $user = User::first();
    $post = Post::create([
        'user_id' => $user->id,
        'title' => 'Um novo título ' . Str::random(10),
        'body' => Str::random(100),
        'date' => now(),
    ]);

    return $post;
});

Route::get('/accessor', function () {
    $post = Post::first();

    return $post;
});

Route::get('/delete2', function () {
    Post::destroy(4);

    $posts = Post::get();

    return $posts;
});

Route::get('/delete', function () {
    // Post::destroy(Post::get());

    $post = Post::where('id', 3)->first();

    if (!$post)
        return 'Post Not Found';

    dd($post->delete());
});

Route::get('/update', function (Request $request) {
    if (!$post = Post::find(1)) 
        return 'Post Not Found';

    // $post->title = 'Título Atualizado';
    // $post->save();
    $post->update($request->all());
    
    dd(Post::find(1));
});

Route::get('/insert2', function (Request $request) {
    $post = Post::create($request->all());

    dd($post);

    $posts = Post::get();

    return $posts;
});

Route::get('/insert', function (Post $post, Request $request) {
    $post->user_id = 1;
    $post->title = $request->name;
    $post->body = 'Conteúdo do post';
    $post->date = date('Y-m-d');
    $post->save();

    $posts = Post::get();

    return $posts;
});

Route::get('/orderby', function () {
    $users = User::orderBy('name', 'ASC')->get();
    
    return $users;
});

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
