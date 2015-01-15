<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 06/08/14
 * Time: 18:42
 */

class UserAuthentication {

    public static function IsLoggedIn() {
        return Session::get('loggedin');
    }

    public static function CheckLoggedIn(){
        $loggedIn = UserAuthentication::IsLoggedIn();

   //     dd($loggedIn);

        if ($loggedIn === 'true'){
            return View::make('admin_index');
        }
        else if($loggedIn == null || $loggedIn === 'false') {
            return Redirect::to('/');
        }
        else {
            return Redirect::to('/');
        }
    }
} 