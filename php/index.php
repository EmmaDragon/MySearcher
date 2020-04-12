<?php
    require_once '../../../bin/php/php7.0.33/vendor/autoload.php';
    require_once 'Indexer.php';
    require_once 'Searcher.php';

    $indexer = new Indexer();
    //$indexer->deleteIndex();
    //$indexer->createIndex();
    //$indexer->indexFiles('../books/*.txt');
    $searcher = new Searcher();
    echo $searcher->searchText("content", "anna");
?>
