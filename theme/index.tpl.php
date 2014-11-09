<!doctype html>
<html lang='<?=$lang?>'>
<head>
    <meta charset='utf-8'/>
    <title><?=get_title($title)?></title>
    <?php if(isset($favicon)): ?><link rel='shortcut icon' href='<?=$favicon?>'/><?php endif; ?>
    <?php foreach($stylesheets as $val): ?>
        <link rel='stylesheet' type='text/css' href='<?=$val?>'/>
    <?php endforeach; ?>
    <script src='<?= $modernizr ?>'></script>
</head>
<body>
<div id='wrapper'>
    <header>
        <div id="header-wrap">
        <?=$header?>
        </div>
        <div id="menu-wrap">
            <?= CNavigation::GenerateMenu($navmenu); ?>
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

<?php if(isset($jquery)): ?>
    <script src='<?= $jquery ?>'></script>
<?php endif; ?>

<?php if(isset($javascript_include)): foreach($javascript_include as $val): ?>
    <script src='<?=$val?>'></script>
<?php endforeach; endif; ?>

<?php if(isset($pagescript)): ?>
    <script>
        <?= $pagescript ?>
    </script>
<?php endif; ?>

<?php if(isset($google_analytics)): ?>
    <script>
        var _gaq=[['_setAccount','<?=$google_analytics?>'],['_trackPageview']];
        (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
    </script>
<?php endif; ?>

</body>
</html>