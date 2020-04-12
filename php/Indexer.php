<?php

require_once '../../../bin/php/php7.0.33/vendor/autoload.php';
require_once 'configuration.php';

class Indexer {
    

    private function openConnection() {
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

    public function createIndex() {
        $client = $this->openConnection();
        $params['index'] = INDEX;
        $response = $client->indices()->create($params);
        print_r($response); 
    }

    public function deleteIndex() {
        $client = $this->openConnection();
        $params = [
            'index' => INDEX
        ];
        $response = $client->indices()->delete($params);
        print_r($response);
    }

    public function indexFiles($folderPath) {
        $client = $this->openConnection();
        $files = glob($folderPath);
        foreach ($files as $file) {
            $filename = basename($file); 
            $params = [           
                'index' => INDEX, 
                'type' => 'doc',   
                'body' => [
                    'identifier' => uniqid(),
                    'date_modified' => date(DateTime::W3C, filemtime($file)),
                    'title' => $filename,
                    'content' => file_get_contents($file),
                    'date_uploaded' => date("Y-m-d h:i:sa")
                ]
            ];
            $params['timestamp'] = strtotime("-1d");
            $response = $client->index($params);
            print_r($response);
        }
        $client->indices()->flush([
            'index' => INDEX
        ]);
    }

}
