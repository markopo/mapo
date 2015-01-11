<?php

include(__DIR__.'/config.php');


$mapo['title'] = "Me";


$mapo['header'] =  Template::Header();


$imageSlider = "";

for($i=1;$i<16;$i++){
  $imageSlider .= "<li><img src='img/ibiza{$i}.jpg' alt='ibiza' ></li>";
}

$host = "http://".$_SERVER['HTTP_HOST'];
$url = pathinfo($_SERVER["PHP_SELF"])["dirname"];
$sqlPath = "$host$url/files/sql-script.sql";
$sqlCodeContents = file_get_contents($sqlPath, true);

$sqlImagePath = "$host$url/img/mysql-cli.jpg";

$mapo['main'] = <<< TEMPLATE
<div class="banner">
    <ul>
        $imageSlider
    </ul>
</div>

<div>
<h2>KMOM06 - Bildhantering & galleri</h2>
<p>Jag har en del programmeringserfarenhet av att jobba med bilder sedan tidigare. Mest med kanske .NET:s GDI+ med C# och sedan har jag jobbat lite med bildmanipulation med Actionscript 3 i Flash också. Det är väl
de språken som jag mest har manipulerat bilder med. Fast iofs kände jag tidigare till ImageMagick, har läst lite om det men inte gjort något direkt med det, kanske skulle prova det. Verkar som ImageMagick
har aningen lite mer features än GD, iaf om man läser om den här <a href="http://www.sitepoint.com/imagick-vs-gd/">artikeln</a>, men båda är bra och GD täcker väl de flesta behov man kan tänkas ha. Annars hittade
jag en trevlig jämförelse mellan GD, ImageMagick och Photoshop <a href="https://foliovision.com/2010/03/imagemagick-vs-gd">här</a>. Då kan man ju få en bild av vilket verktyg man behöver vid vilket behov.
</p>
<p>Det kändes väl ganska bra att jobba i GD och det är väl en bra samling av funktioner som finns där och PHP dokumentationen är ju behjälplig om man vill läsa mer om funktionerna. Det svåraste var väl alla
parametrarna intill img.php och hålla rätt på dem, för det blev ju ganska många av dem. Det var väl det svåraste med uppgiften. Ett stycke i taget var det ju ganska lätt, men att få alla fungera ihop var lite
svettigare. Det är ändå en rätt kraftfull bildhanterings-service man gjort. Kanske man skulle göra en variant med Imagemagick istället, och ha fler features till på det? Kanske även bygga ut det med databashantering
och liknande. Då skulle man ju ha något rätt bra. Annars tycker jag img.php är en bra funktion och jag lärde mig ju mer om cache-headers också, vilket var ju najs.
</p>
<p>Jag tycker Anax (Mapo) - min webbtemplaten är rätt bra, skulle vilja ha routing i systemet rätt av iofs, utan att mecka med .htaccess-filer och annat mök. Sen att klasserna i src ligger i en egen folder
för varje klass är väl inte så snyggt. I egentligen skulle man vilja använda namespaces som är organiserade utefter mappstrukturen i projektet. Det tycker jag är bäst. Sen tycker jag sidkontrollerna är kanske
en aningen bara, fortfarande en aning för mycket procedurell programmering över det. Det jag i egentligen vill ha är ett riktigt MVC-mönster i projektet, men det här har varit en bra kurs för att lära sig strukturera
en webbapplikation från grunden, istället för att förlita sig på "magiska" ramverk, som man kanske inte förstår så mycket av som händer under huven. Det som jag tycker kanske känns bäst är väl CDatabase klassen, tycker
den är ett fullgott dataaccess pattern för att bygga applikationer med, och den använder ju PDO och transaktioner vid skrivoperationer och namngivna parametrar vilket jag tycker är alldeles förträffligt. Så där
har man ju rätt bra grejer där, rätt av. Annars är jag ganska nöjd med min design på websajten och har lyckats rätt bra med den.
</p>
<p>Sen hade jag svårt med tid till studier under julhelgen i och med att man var bortrest en vecka och sedan skulle man flytta vid nyårsskiftet. Det var svårt att hinna med att studera och sätta sig till ro. Nu
är det fullt ös för att få slutprojektet i hamn innan januari slut så man kan börja med MVC-kursen.
</p>
<br style="clear:both;" >

<h2>KMOM05 - Lagring i DB</h2>
<p>Objektorienteringen rullar på, och det känns bra. Är väl i egentligen inga större problem med att koda objektorienterat. Lite underligt är det trots allt i PHP i jämförelse
med C# - lite mer skriptspråk över det, antagligen ja för att det är ett skriptspråk. Nu blir det en del kataloger med varsin klass. Det kan väl iofs vara bra, men när projektet
växer - då kan vi säga att vi skapat <a href="http://c2.com/cgi/wiki?RavioliCode">ravioli-kod</a>. På ett sätt är det väl bra, men i längden kanske det är bättre att klumpa ihop det
i större enheter.
</p>
<p>Jag har väl inga problem att tänka objektorienterat när jag programmerar - har ju gjort det rätt länge. Men vad är optimal design? Det är där de svåra frågorna kommer fram.
</p>
Det blev en del moduler som CContent, CPage, CBlog, CTextFilter. De större modulerna blev välsignade med en egen instans. Det tycker jag de var värda. Mindre moduler eller sk hjälpfunktioner
fick förbli vara public static. Det är ju ändå rätt behändigt med det, trots en del motstånd mot public static inom den renläriga objektorienteringsskolan. Men jag är pragmatiker, och gillar att följa iaf
två regler - <a href="http://en.wikipedia.org/wiki/KISS_principle">KISS</a> och <a href="http://en.wikipedia.org/wiki/Don%27t_repeat_yourself">DRY</a>.
<p>Den funktion som jag kände var mest nyttig var väl CTextFilter - speciellt kanske markdown funktionen. Med den kan skapa mycket skojigt. Annars känns det väl bra också att jag implementerar arv i dataaccess-logiken,
tycker det skapar bra struktur i applikationerna, och ger mindre repetitivt skrivande. Det är också bra. Sedan börjar man bli mer bekväm med PhpStorm editorn. Tycker den är toppen alltså, bara en sak som sparar oändligt mycket tid
i ett stort projekt är med F12 på ett metodnamn kan navigera till definitionen på den. Annars är jag också nöjd att jag implementerat transaktioner i PDO när man skriver till databasen. Känns som det är nödvändigt för vilka
applikationer som helst i egentligen, inte bara affärskritiska. Allt är väl kritiskt eller viktigt för den som använder applikationen. Då vill man ju inte förlora data som man skapat?
</p>
<p>Det går ju att pula med sådant hur länge som helst, speciellt om man vill få gränssnittet snyggt och rent och skapa mer behändiga funktioner kring huvudfunktionaliteten i det oändliga. Men överlag är jag nöjd.
CContent tog ju mest tid att implementera. Annars har julen varit bra, mycket mat och dryck har det blivit och en och annan julklapp fick man av tomten också.
</p>
<p>Hyvää joulua!</p>
<br>
<h2>KMOM04 - PDO och MySql</h2>
<p>Jag har inte gjort efter övningen rakt av, utan gjort efter eget huvud vad jag tyckte verkade vara bra. För övrigt tycker jag paginering och sortering i dagens läge borde
skötas av klienten, genom javascript företrädesvis för det är trots allt Webb det här handlar om. Tycker väl att det nästan blir bökigare att bygga så här mycket funktionalitet genom
en helt serverbaserad lösning som tämligen klumpig och saknar en hel del i UX. Men men, sånt är livet. Lite javascript har jag skrivit trots allt, bara för att höja användarupplevelsen till
en slags minsta gräns.
</p>
<p>Själva sökfrågan ligger i en klass <i>CDatabase</i> i en metod <i>GetMovies</i>. Jag har använt mig StdClass som är ett anonymt objekt i PHP istället för en array. Det är väl inte så stor
skillnad, utan mer ett tycke om man tycker mer om objekt eller arrayer. Metoden bygger upp en dynamisk sql-sträng på vyn movies baserat på parametrarna in i metoden, men jag använder <a href="http://php.net/manual/en/pdostatement.bindparam.php">bindParam</a>
från PDO som jag tycker är bra.
Det är en vanlig klass som man måste instansiera upp med publika metoder för att få tag i olika data som man behöver. Andra klasser som <i>Helpers</i> klassen och <i>HtmlMovies</i> har jag lämnat
dess metoder som <b>public static</b> för att slippa skapa en instans av dem och för att de mer agerar som utility funktioner.
</p>
<p>Det är bra att känna till olika sätt att definiera en vy <i>(view)</i> - <strong> MERGE vs TEMPTABLE ALGORITHM </strong> - Om man skall definiera en vy skall man försöka använda sig av MERGE algoritmen istället för TEMPTABLE som isf
gör en table-scan av tabellen. Med MERGE kommer den optimera vyn att fungera som en vanlig sql-fråga istället. Annars kan man lämna den UNDEFINED vilket den är per default och försöker
då växla till den som är mest optimal för just den servern som databasen befinner sig på.
Annars är det ju en generell regel inom SQL att minimera antalet kolumner som vyn hämtar, hämta bara de som behövs. Exkludera de som inte behövs - allt för prestandan. Men vyer är ändå kraftfullt
och en av fördelarna är att de kapslar in komplicerad sql i ett lättåtkomligt anrop, vilket leder till mindre sqlsträngar i webbapplikationen, vilket är ett vanligt fel i sql-baserade webbapplikationer.
</p>
<h5><a href="javascript:toggleMySqlViews();" >Lite länkar om vyer i mysql</a></h5>
<ul id="mysql-list" style="display:none;" >
<li>http://stackoverflow.com/questions/10302615/mysql-views-performance </li>
<li>http://stackoverflow.com/questions/4426919/mysql-views-vs-php-query</li>
<li>http://stackoverflow.com/questions/4886874/are-mysql-views-dynamic-and-efficient</li>
<li>http://stackoverflow.com/questions/439056/is-a-view-faster-than-a-simple-query</li>
<li>http://www.hackvalue.nl/en/article/116/next_step_mysql_using_views_to_improve_performance</li>
<li>http://www.ovaistariq.net/667/mysql-using-views-as-performance-improvement-tools/#.VIYY-cnLJJQ</li>
<li>http://dba.stackexchange.com/questions/16372/when-to-use-views-in-mysql</li>
<li>http://www.percona.com/blog/2007/08/12/mysql-view-as-performance-troublemaker/</li>
</ul>
<p><strong>Kodnings standard</strong>
Jag har försökt ha en slags kodstandard i min kod, för att hålla kodbasen tydlig och förutsägbar. Ganska enkla regler, men som gör säkert stor skillnad i längden.
</p>
<ul>
<li>Max 3 input parametrar in i en funktion, annars gör man en klass eller en array av det.</li>
<li>Gruppera public och private properties och metoder var för sig för överskådlighet.</li>
<li>Separera klasser och metoder från dataaccess och rendering av html.</li>
</ul>
<h4>Reflektioner</h4>
<p>Söksidan tog längre tid än jag räknade med och var bökigare än jag trodde, men det gick ju bra till slut. Det gick överlag bra att jobba med <i>PHP PDO</i> men några småproblem stötte man
väl på vägen. Nu när man jobbar objekt-orienterat känns det som det är kodning på riktigt i egentligen. Något annat skulle man inte vilja skriva. Min tanke är i alla fall att separera databasklasser
mot rendering av html. Det är iaf en no-no. Databasfunktioner skall finnas i egna klasser. Rendering av html skall finnas i andra klasser. Sen tycker jag är det är behändigt att kapsla in olika hjälpfunktioner
i egna klasser och funktioner, t.ex har jag en helpers klass som gör många av dessa repetitiva och tråkiga uppgifter, som kapslar in dem. Det minimerar ju en del redundans. Överlag känns det bra, och jag är redo
för mer!
</p>
<p><b>Kippis ja kulaus!</b></p>


<h2>KMOM03 - SQL och databasen MySql</h2>
<p> Jag har väl en ganska bra kunskap om SQL och databaser sen innan och har jobbat en hel del med databaser och kan en hel del om dessa. Mest med SQL Server och T-SQL som
är microsofts implementation av SQL-språket. Jag har skrivit massor av lagrade procedurer, vyer, triggrar, osv i det. Tidigare i mitt liv pluggade jag en ky-utbildning - Systemutvecklare .NET
inriktning databasdesign, så där läste vi flera databaskurser om just SQL Server, sen hade vi en kurs om Oracle med psql och ett moment om MySql också. Men bäst kan jag väl Sql Server följt av
MySql. Annars är jag väl också någorlunda bekant med MS Access också, och nu gick vi igenom SQLite i förra kursen också, så den kan man ju en del om också.
</p>
<img src="$sqlImagePath" alt="mysql cli" >
<br style="clear:both;" >
<h4><a href="http://dbwebb.se/kunskap/bth-s-labbmiljo-for-databasen-mysql">Kom igång med databasen MySQL och dess klienter</a></h4>
<p>De här klienterna var jag bekant med sedan tidigare, hade ju de redan installerade på min dator. Så det var väl inget nytt för mig.
</p>
<h4><a href="http://dbwebb.se/kunskap/kom-igang-med-databasen-mysql-och-dess-klienter">BTH's labbmiljö för databasen MySQL</a></h4>
<p>
Jag kopplade upp mig emot bth:s server med MySql Workbench. Föredrar den framför PhpMyAdmin.
</p>
<h4><a href="http://dbwebb.se/uppgift/kom-igang-med-sql">Kom igång med SQL</a></h4>
<p>
Det var bra repetition med SQL-uppgiften. Det som kändes kanske lite obekant var att göra vyer i MySql. Annars var allt bekant sedan tidigare.
Annars känner jag mig obekväm med att anropa massor av vyer från andra vyer. Då får man massor av nästlade relationer till varandra och när en vy
ändras så kanske nästa kraschar. Och sen kanske prestandan inte blir det bästa heller. Överlag kan det bli en jäkla nästlad soppa av det tänker jag mig. Sådant beror väl på iofs,
om man kanske dokumenterar det.
</p>
<h4><a href="javascript:showSqlCode();" >Se sql koden för uppgiften</a></h4>
<div id="sql-code-container" style="display:none;" >
<pre><code>
$sqlCodeContents
</code></pre>
</div>

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

    function showSqlCode() {
        $('#sql-code-container').slideToggle();
    }

    function toggleMySqlViews(){
        $('#mysql-list').slideToggle();
    }

    $(function() {
        $('.banner').unslider({ speed: 500, delay: 3000 });
    });
TEMPLATE;



$mapo['footer'] = Template::Footer();


include(MAPO_THEME_PATH);