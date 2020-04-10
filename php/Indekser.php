<?php

require_once '../../../bin/php/php7.0.33/vendor/autoload.php';
require_once 'configuration.php';

class Indekser {
    

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
        $client = Elasticsearch\ClientBuilder::create() 
                ->setHosts($hosts)
                ->build();
        return $client;
    }

    public function kreirajIndeks() {
        $client = $this->otvoriKonekciju();

        $params = [
           'index' => INDEX
        ];
        $response = $client->indices()->create($params);
        print_r($response);
    }

    public function obrisiIndeks() {
        $client = $this->otvoriKonekciju();
        $params = [
            'index' => INDEX   // kod brisanja se zadaje samo naziv indeksa koji brišemo
        ];
        $response = $client->indices()->delete($params);
        print_r($response);
    }

    public function indeksirajFajlove($folderPutanja) {
        $client = $this->otvoriKonekciju();
        $fajlovi = glob($folderPutanja); // Vraća se niz svih fajlova sa zadate lokacije
        foreach ($fajlovi as $fajl) {
            // Za svaki fajl se kreira poseban Elasticsearch dokument. 
            $filename = basename($fajl); // Iz pune putanje fajla uzima se samo naziv fajla. 

            $params = [            // parametri za dodavanje dokumenta
                'index' => INDEX,  // naziv indeksa
                'type' => 'doc',   // tip mora da bude neki od dokumenata iz mapping-a, tamo smo 
                                   // zadali samo dokument koji se zove 'doc'
                'body' => [
                    'identifikator' => uniqid(),     // za polja koja smo definisali u mapping-u ovde dodajemo vrednosti
                    'datum_izmene' => date(DateTime::W3C, filemtime($fajl)),
                    'naziv_fajla' => $filename,
                    'sadrzaj' => file_get_contents($fajl)
                ]
            ];

            // Dokument će biti indeksiran u  INDEX/doc/my_id
            $response = $client->index($params);
            print_r($response);
        }
        $client->indices()->flush([
            'index' => INDEX
        ]);
    }

}
