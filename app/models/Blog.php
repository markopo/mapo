<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 05/08/14
 * Time: 21:07
 */

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Blog extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'blog';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
//	protected $hidden = array('Created', 'remember_token');

}