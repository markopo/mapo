<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 14/12/2014
 * Time: 19:47
 */

class HtmlLogin {

    public static function LoginForm() {
        return "<div class='login-form'>
        <form action='login.php' method='post'>
            <ul>
                <li>
                    <label for='username'>Username:</label> <input type='text' id='username' name='username' value='' />
                </li>
                <li>
                    <label for='password'>Password:</label> <input type='password' id='password' name='password' value='' />
                </li>
                <li>
                   <input type='submit' name='logInBtn' id='logInBtn' value='Logga in' />
                </li>
            </ul>
        </form>
       </div>";
    }

    public static function LoginRedirect() {
        return "<script>
            (function() {
               window.location.href = window.location.href.replace('login.php', 'status.php');
            })();
        </script>";
    }

    public static function LogoutRedirect() {
        header("Location: status.php");
        exit;
    }




}