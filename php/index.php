<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once '../../../bin/php/php7.0.33/vendor/autoload.php';
        require_once 'Indekser.php';
        require_once 'Pretrazivac.php';
        
        // Fajl "composer.json" služi za preuzimanje potrebnih PHP biblioteka. U tom fajlu 
        // se navodi samo elasticsearch, a composer aplikacija (koja prethodno treba da se 
        // instalira) automatski pronalazi sve biblioteke od kojih elasticsearch zavisi. 
        // Pored fajla "composer.json" u istom folderu potreban nam je i fajl "composer.phar" koji se preuzima 
        // sa https://getcomposer.org/download/ u sekciji Manual Download ili na jedan od 
        // direktnih linkova https://getcomposer.org/download/1.6.5/composer.phar
        // Pored ručnog preuzimanja moguće je i preuzimanje aplikacijom curl 
        // (ako je instalirana) sledećom komandom 
        //      curl -s http://getcomposer.org/installer | php
        // Da bi composer preuzeo sve potrebne biblioteke potrebno je pokrenuti Command Prompt 
        // i u folderu gde se nalaze fajlovi "composer.json" i "composer.phar" izvršiti
        //      php composer.phar install --no-dev
        // Posle ovoga moguće je pokrenuti projekat. 
        
        // Pozivi funkcija za kreiranje indeksa, brisanje indeksa, dodavanje dokumenta, pretraživanje indeksa. 
        $indekser = new Indekser();
        //$indekser->obrisiIndeks();
        //$indekser->kreirajIndeks();
        //$indekser->indeksirajFajlove('../books/*.txt');
        
        $pretrazivac = new Pretrazivac();
        $pretrazivac->pretraziTekst("sadrzaj", "anna");
        

        ?>
    </body>
</html>
