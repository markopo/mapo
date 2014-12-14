<?php

include(__DIR__.'/config.php');


$loginForm = "";
$loginMessage = "";
$loginSuccess = false;




if(isset($_POST["logInBtn"])){

    $username = Helpers::PostIsSetOrNull("username");
    $password = Helpers::PostIsSetOrNull("password");

    if($username != null && $password != null){


        $cUser = new CUser($mapo['database']);
        $cUser->Login($username, $password);

        if($cUser->IsAuthenticated()){
            $loginSuccess = true;
        }
        else {
            $loginMessage = "<p>Sorry! Kunde inte logga in dig!";
        }

    }
}

if($loginSuccess == false) {
    $loginForm = HtmlLogin::LoginForm();
}
else {
    $loginForm = HtmlLogin::LoginRedirect();
}


$mapo['title'] = "Login";


$mapo['header'] = Template::Header();

$mapo['main'] = <<< TEMPLATE
<h2>Login</h2>
<div class='login-wrapper' >
$loginForm
</div>
<br style='clear:both;' />
<div class='loginmessage-wrapper'>
$loginMessage
</div>
<br style='clear:both;' />
TEMPLATE;


$mapo['footer'] = Template::Footer();


include(MAPO_THEME_PATH);