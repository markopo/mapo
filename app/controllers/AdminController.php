<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 26/07/14
 * Time: 19:42
 *
 * Route::get('admin', 'AdminController@Index');
 */

class AdminController extends BaseController {


    public function Index() {

      return UserAuthentication::CheckLoggedIn();
    }


} 