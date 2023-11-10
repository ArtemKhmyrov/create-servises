<?php

class View
{

  public $param = [];
  public function __construct( $param ){
    $this->param = $param;
  }
  public function render(){

    return  
      '<nav>' .
      '<a href="/index/">главная</a> ' .
      '<a href="/sqlite/">SQLite</a> ' .
      '<a href="/xml/">XML</a> ' .
      '<a href="/soap/">SOAP</a> ' .
      '<a href="/rest/">REST</a> ' .
      '<a href="/graphql/">GraphQL </a> ' .
      '<a href="/jwt/">jwt </a> ' .
      '<a href="/streams/">потоки </a> ' .
      '</nav>' . $this->param['content'];
  }
}