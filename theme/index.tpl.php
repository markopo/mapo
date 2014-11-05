<!doctype html>
<html lang='<?=$lang?>'>
<head>
    <meta charset='utf-8'/>
    <title><?=get_title($title)?></title>
    <?php if(isset($favicon)): ?><link rel='shortcut icon' href='<?=$favicon?>'/><?php endif; ?>
    <link rel='stylesheet' type='text/css' href='<?=$stylesheet?>'/>
</head>
<body>
<div id='wrapper'>
    <header>
        <div id="header-wrap">
        <?=$header?>
        </div>
    </header>
    <div id='main'>
        <div id="main-wrap">
            <?=$main?>
        </div>
    </div>
    <footer>
        <div id="footer-wrap">
        <?=$footer?>
        </div>
    </footer>
</div>
</body>
</html>