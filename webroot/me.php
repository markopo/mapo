<?php

include(__DIR__.'/config.php');


$mapo['title'] = "Me";


$mapo['header'] =  Template::Header();

$mapo['main'] = <<< TEMPLATE
<div class="banner">
    <ul>
        <li><img src="img/ibiza1.jpg" alt="ibiza" ></li>
        <li><img src="img/ibiza2.jpg" alt="ibiza" ></li>
        <li><img src="img/ibiza3.jpg" alt="ibiza" ></li>
        <li><img src="img/ibiza4.jpg" alt="ibiza" ></li>
        <li><img src="img/ibiza5.jpg" alt="ibiza" ></li>
        <li><img src="img/ibiza6.jpg" alt="ibiza" ></li>
    </ul>
</div>
<div>
<h2>Hej allihopa!</h2>
<p><b>Jag</b> heter Marko Poikkimäki och är 38 år gammal och bor i Göteborg. Jag har fru och två barn. På fritiden gillar jag att motionera lite blandat med styrke- och konditionsträning i allmänhet
och så tränar jag karate regelbundet. På dagarna jobbar jag som .NET utvecklare. Detta har jag gjort sedan jag gick klart en ky-utbildning till Systemutvecklare .NET år 2008. Men efter att ha jobbat ett antal år med Windows-plattformen vill jag bredda min kompetens till open-source världen. Därför läser jag det här PHP-kurspaketet för att lära mig
PHP ordentligt.</p>
<p><b>Bildspelet</b> är från min familjs semester i <a href="http://en.wikipedia.org/wiki/Es_Figueral">Ibiza, Figueral</a> i somras. Det var en väldigt trevlig semester.</p>
<p><b>Reflektioner:</b>
 Det känns som nivån har höjsts sedan föregående kurs, lite mer att göra på varje moment. Det har varit lärorikt och jag tycker mig ha lärt en hel del nytt för mig om PHP. Men det har varit kul, webbprogrammering
 är verkligen roligt.
</p>
<p><b>Utvecklingsmiljön</b> som jag använder är <a href="https://www.jetbrains.com/phpstorm/"> PHPStorm </a> som nog är den bästa och mest avancerade editorn för PHP. Efter en omröstning
gjord av <a href="http://www.sitepoint.com/best-php-ide-2014-survey-results/">Sitepoint blev editorn</a> utsedd som bäst. Jag rekommenderar editorn, tycker den är bra, vilket andra verkar också tycka.
Sedan använder jag Notepad++ flitigt som texteditor också.
Bla annat använde jag <a href="http://bower.io/">Bower</a> för att installera javascript-bibliotek i mitt projekt.
Annars sitter jag på Windows 8.1 med XAMPP installerat. Filezilla använder jag som ftp-klient. Använder även <a href="https://code.google.com/p/tortoisegit/">TortoiseGit</a> vilket jag tycker underlättar i Git:andet.
</p>
<p><b>Webbmallen</b> fick namnet <a href='https://github.com/markopo/mapo' >MAPO</a> - efter mina initialer, lite ego kanske, men kan inte programmering vara en form av sjävbekräftelse? <br>
Jag gjorde en egen design, för att jag ville ha en egen  och dumpade Anax projektets stil. Jag tog lite delar från mitt förra projekt BMO från HTMLPHP-kursen. Ägnade ju en bra stund med att fixa designen där så jag ville
gärna återanvända saker därifrån.
</p>
<p><b>Source</b>-filen gick bra att implementera och jag gjorde enligt instruktionerna.
</p>
<p><b>Github</b> använde jag och den hittar du <a href="https://github.com/markopo/mapo">här</a>. Använder en kombination av cmd-line och tortoisegit.
</p>
</div>
TEMPLATE;

$mapo["pagescript"] = <<< TEMPLATE
    $(function() {
        $('.banner').unslider({ speed: 500, delay: 3000 });
    });
TEMPLATE;



$mapo['footer'] = Template::Footer();


include(MAPO_THEME_PATH);