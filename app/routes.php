<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*
Route::get('/', function()
{
	return View::make('hello');
});
*/

// array('uses'=>'authors@index')


/*
Route::get('authors', function(){

    return View::make('authors.index');
});
*/

Route::get('/', 'HomeController@showWelcome');

Route::get('/about', function(){

   return View::Make('about');
});

Route::get('login', 'HomeController@loginView');

Route::post('logon', function(){
        $username = trim(Input::get('username'));
        $password =  trim(Input::get('password'));


        // debug only
        // return View::make('debug')->with('debug', $debug);

        $user = User::where("username", "=", $username)->find(1);

   //     dd($user);

        if(!$user->exists){
            return Redirect::to('/login');
        }

        if(md5($password) === $user->password){
             Session::put("loggedin", 'true');
             return Redirect::to('admin');
        }
        else {
             return Redirect::to('/login');
        }

});

Route::get('logout', function() {
    Session::forget('loggedin');
    return array("logged out");
});

/*
Route::get('debug', function() {
   $users = User::all();

   foreach ($users as $user) {
       $user->password = md5("paska");
       $user->save();
   }

    return $users;
});
*/

Route::get('admin', 'AdminController@Index');

Route::post('adminblogsave', function(){

    if(UserAuthentication::IsLoggedIn() === 'true'){
        $title = trim(Input::get('title'));
        $text =  trim(Input::get('text'));

        $blog = new Blog();
        $blog->Title = $title;
        $blog->Text = $text;

        $blog->save();

    }


   return UserAuthentication::CheckLoggedIn();
});

Route::get('blogdata', function(){
    return Blog::all();
});


Route::get('authors', 'AuthorsController@Index');

Route::get('users', function()
{
    $users = User::all();

    return View::make('users')->with('users', $users);
});

