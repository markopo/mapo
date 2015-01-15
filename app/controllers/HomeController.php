<?php

use data\Data;

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
       $appdata = new AppData();

       // dd($appdata);

       return View::make('hello')->with("name", $appdata->GetName())->with("message", $appdata->GetMessage());
	}

    // Route::get('/login', 'HomeController@loginView');
    public function loginView(){
        return View::make('home_login');
    }




}
