<?php
    require_once '../../../bin/php/php7.0.33/vendor/autoload.php';
    require_once 'Indexer.php';
    require_once 'Searcher.php';

    $indexer = new Indexer();
    $searcher = new Searcher();
    //$indexer->deleteIndex();
    //$indexer->createIndex();
    //$indexer->indexFiles('../books/*.txt');
    //echo $searcher->searchText("content", "anna");
    if(isset($_POST["singleFiledSearch"]))
    {
        $books=$searcher->searchText($_POST["typeOfSearch"],$_POST["query"]);
        echo json_encode($books);
    }
    else if(isset($_POST["downloadFile"]))
    {
        $book=$searcher->searchDocumentsById($_POST["typeOfSearch"],$_POST["query"]);
        echo json_encode($book);
    }
?>
