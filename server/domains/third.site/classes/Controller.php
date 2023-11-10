<?php

class Controller
{

  protected $mysqli;

  public function __construct($mysqli){
    $this->mysqli = $mysqli;
  }
  public function index(){
    $content = "<h1>Главная</h1>";

    return new View(['content' => $content]);
  }
  public function sqlite(){
    $content = "<h1>SQLite</h1>";

    $bookDB = new BookDB;
    $books = $bookDB ->select( );

    $result = "<table border=1>";
    foreach ($books as $book){
      list($idbook, $title, $author, $price) = $book;
      $i++;
      $result .= <<<BOOK
        <tr>
          <td> $i
          <td> $title
          <td> $author
          <td> $price
          <td>
          <a class='btn btn-primary' href="?title=$idbook ?>">Удалить</a>
          <a class='btn btn-primary' href="?title=$idbook ?>">Изменить</a>
BOOK;

      }
    
    $content .= $result . "</table>";
    return new View(['content' => $content] );
  }
  public function xml(){
    $content = "<h1>XML</h1>";

    return new View(['content' => $content]);
  }
  public function rest(){
    $content = "<h1>REST</h1>";

    return new View(['content' => $content]);
  }
  public function soap(){
    $content = "<h1>SOAP</h1>";

    return new View(['content' => $content]);
  }
  public function graphql(){
    $content = "<h1>GraphQL</h1>";

    return new View(['content' => $content]);
  }
  public function jwt(){
    $content = "<h1>jwt</h1>";

    return new View(['content' => $content]);
  }

  public function streams(){
    $content = "<h1>потоки</h1>";

    return new View(['content' => $content]);
  }
}