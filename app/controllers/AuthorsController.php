<?php


class AuthorsController extends BaseController {

    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |	Route::get('/authors', 'AuthorsController@Index');
    |
    */

    public function Index()
    {
        $date = date("Y-m-d");

        return View::make('authors_index')->with("date", $date);
    }

}
