<?php

include "../classes/BookDB.php";

class BooksService extends BookDB {
    public function getBookById( $id ){
        try{
            $books = $this->select($id);
            return base64_encode(serialize($books));
        }
        catch( Exception $e ){
            throw new SoapFault(__METHOD__, $e->getMessage());
        }
    }
    public function getBooksCount(){
        try{
            $count = $this->count();
            if( !$count === 'false'){
                throw new Exception('Проблема с получением количества книг');
            }
            return  $count;
        }
        catch( Exception $e ){
            throw new SoapFault(__METHOD__, $e->getMessage());
        }
    }
}



// $service = new BooksService;
// print_r(unserialize(base64_decode($service->getBookById(1))));
// echo $service->getBooksCount();

// отключить кеширование

ini_set("soap.wsdl_cache_enabled", 0);

// создать soap сервер

$server = new SoapServer('http://third.site/soap/books.wsdl');
// указать функционал
// $server->setClass('BooksService');

// указание функционала в виду функций
function getBooksCount(){ return 123; }
function getBookById(){ return base64_encode(serialize([234=>456])); }
$server->addFunction(['getBooksCount','getBookById']);

// запустить сервер

$server->handle();