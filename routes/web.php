<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/messages', 'MessageController');

Route::get('/getmessages/{channel}', 'HomeController@getMessages');

Route::get('/init', 'HomeController@init');


Route::get('/user', function(){
	return App\User::with('messages')->get();
});

Route::get('/mail', function(){
	$data = array('name'=>"Htet Myat", "body" => "Testing Email");

	Mail::send('testmail', $data, function($message) {
    	$message->to('htetmyathlaing.htd@gmail.com', 'Htet Myat')
                ->subject('Web Testing Mail with app pw')
    	        ->from('htetmyathlaing.htd@gmail.com','Htet Myat Hlaing');
	});

});

Route::get('/test', function(){
	$message = new App\Message();
    $message->message = 'message';
    $message->user_id = Auth::id();
	broadcast(new App\Events\MessagePosted($message));
	// broadcast(new App\Events\TestEvent());
});



