<?php

require_once '../../../bin/php/php7.0.33/vendor/autoload.php';
require_once 'configuration.php';

class Pretrazivac {

    // Otvaranje konekcije se koristi više puta pa je dato kao posebna privatna 
    // funkcija. 
    private function otvoriKonekciju() {
        $hosts = [
            [
                'host' => HOST,
                'port' => PORT,
                'scheme' => SCHEME,
                'user' => USER,
                'pass' => USER
            ]
        ];
        $client = Elasticsearch\ClientBuilder::create()           // Instantiate a new ClientBuilder
                ->setHosts($hosts)      // Set the hosts
                ->build();
        return $client;
    }

    public function pretraziTekst($polje, $upit) {
        error_reporting(E_ALL & ~E_WARNING);
        
        $client = $this->otvoriKonekciju();

        $params = [
            'index' => INDEX,   // indeks koji se pretražuje
            'type' => 'doc',    // tip unutar indeksa koji se pretražuje, dobra praksa je da indeks ima 
                                // samo jedan tip, u narednim verzijama se ukida podrška za tipove
            'body' => [
                'from' => 0,    // 'from' i 'size' se koriste za paging
                'size' => 10,
                'query' => [
                    'match' => [
                        $polje => $upit  // u query nizu se zadaje par polje=>upit
                    ]
                ]
            ]
        ];

        
        $results = $client->search($params);
        foreach ($results[hits][hits] as $fajl )
        {
            print_r($fajl[_id]);
            print_r(" :: ");
            print_r($fajl[_source][naziv_fajla]);
            echo "<br>";
        }
    }

}
