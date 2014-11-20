<?php

include(__DIR__.'/config.php');


$mapo['title'] = "Me";


$mapo['header'] =  Template::Header();


$imageSlider = "";

for($i=1;$i<16;$i++){
  $imageSlider .= "<li><img src='img/ibiza{$i}.jpg' alt='ibiza' ></li>";
}

$mapo['main'] = <<< TEMPLATE
<div class="banner">
    <ul>
        $imageSlider
    </ul>
</div>
<div>
<h2>KMOM02 - Objektorienterad programmering i PHP</h2>
<p>Jag har väl rätt goda kunskaper i objektorienterad programmering, jag jobbar ju dagligen med objektorienterad programmering i C# mestadels med ASP.NET MVC. Tycker väl att jag kan det rätt
bra, men allt kan jag nog inte ändå. Det finns nog en del saker som man inte har koll på. Men det är klart det är en liten omställning att skriva objektorienterat i PHP. Iofs har jag gjort det innan
på fritiden med lite småprojekt. Men framförallt känns det väldigt uppfriskande att koda i ett annat språk. Ändå känns väl objektorienterade lösningar som något som aldrig tar slut. Det går ju
abstrahera ut i all oändlighet. Tycker ändå det kan vara viktigt att sätta ner foten, nu är det nog; nu är det tillräckligt mycket abstraktion. Min filosofi är att få saker gjort med tillräckligt
mycket med klasser och tjafs.</p>
<p>Jag valde <i>Månadens babe</i> för att den uppgiften tilltalade mig mer än tärningsspelet. Jag började uppgiften med att göra en testsida för att testa olika tids- och datumfunktioner så att jag
hade det klart när jag började med uppgiften. Så resultatet blev en array of arrays av en månadskalender. Det var rätt skönt att ha koll på det innan jag började med att göra klasstrukturen. Så basen i projektet
är väl objektet CalenderDay som håller all information om en kalenderdag. Hela kalendern är en array av Kalenderdagar. Inte svårare än så. Men för att pumpa ut html:n på sidan har jag gjort en HtmlCalendar som
ärver Calendar och gör html-renderingen från basobjektet. En tanke skulle kunna extenda Calender som t.ex. en JSONCalendar eller en XmlCalendar som outputtar kalenderdatat i respektive data.
Sen själva arbetet var väl inte helt lätt, men gick bra till slut. De största problemen hade jag väl att få rätt med föregående månad och nästa månad blev rätt. Det uppkom en liten bugg under arbetets gång
som jag fixade under utvecklingen. Annnars tog ju stylingen av html/css en del tid, och är väl inte alltid så lätt som man tror, speciellt om man försöker få det någorlunda tjusigt. Hoppas det blev rätt bra,
design kan ju vara rätt subjektivt; men relativt nöjd av resultate är jag nog trots allt. Sen tog det en stund att fixa bilder till månadens babe och redigera dessa i Photoshop. Själv tycker jag att jag valde
rätt tjusiga damer. Iaf enligt personlig preferens. Sen hade jag lite problem med uppladdningen med Filezilla, fick ladda om det några gånger till, en katalog i taget och då funkade det bra. Sen fick jag också
 fixa till url:en på bilderna som inte syntes, men det fixade jag med. Alltsammmans blev en ny <a href="https://github.com/markopo/mapo/commits/manadens-babe">branch på mitt github-konto</a>. Sedan mergade jag ihop
den med master-branchen. Annars känner jag mig nöjd över resultatet.
</p>

<h2>KMOM01 - Kom igång med PHP</h2>
<h4>Hej allihopa!</h4>
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