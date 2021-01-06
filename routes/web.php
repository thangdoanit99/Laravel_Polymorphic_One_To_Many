<?php

use Illuminate\Support\Facades\Route;

use App\User;
use App\Image;
use App\Post;
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
    return view('welcome');
});

Route::get('/insert', function () {

    for ($i = 1; $i <= 3; $i++) {

        User::create([
            'name' => 'user' . $i,
            'email' => 'user' . $i . '@gmail.com',
            'password' => bcrypt('user' . $i . '@gmail.com')
        ]);


        Post::create([
            'name' => 'post' . $i,
        ]);
    }


    $user = User::findOrFail(1);



    for ($i = 1; $i <= 3; $i++) {

        $user->images()->create(['url' => 'url' . $i]);
    }


    $post = Post::findOrFail(1);

    for ($i = 4; $i <= 9; $i++) {

        $post->images()->create(['url' => 'url' . $i]);
    }

    echo "Insert Successful!";
});

Route::get('/read', function () {
    $user = User::findOrFail(1);

    $imgs = $user->images;

    foreach ($imgs as $img) {
        echo $img->url . '<br/>';
    }
});


Route::get('/update', function () {
    $user = User::findOrFail(1);

    $user->images()->where('id', 3)->update(['url' => 'url3 updated']);

    echo 'Updated Successful!';
});

Route::get('/delete', function () {
    $user = User::findOrFail(1);

    $user->images()->where('id', 3)->delete();

    echo 'Deleted Successful!';
});