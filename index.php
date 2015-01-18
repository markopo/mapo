<<<<<<< .mine
<?php

header("Location: webroot/me.php");
exit;










=======
<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 26/07/14
 * Time: 09:25
 */

$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'blog';
header("Location: http://$host$uri/$extra");
//print "Location: http://$host$uri/$extra";
exit;
>>>>>>> .theirs
