<?php

$path = str_replace("img", "webroot", __DIR__);
include($path. DIRECTORY_SEPARATOR .'config.php');

echo "<!doctype html>
<html>
<head>
<meta charset='utf-8'/>
</head>
<body>
<h2>Images</h2>
</body>
</html>";