<?php

use Lcobucci\JWT\ValidationData;
use Lcobucci\JWT\Parser;

include 'vendor/autoload.php';

$data = new ValidationData();
$data->setIssuer('http://third.site');
$data->setAudience('http://third.site');
$data->setId('1234567');
$data->setCurrentTime(time() + 62);


$str = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC90aGlyZC5zaXRlIiwiYXVkIjoiaHR0cDpcL1wvdGhpcmQuc2l0ZSIsImp0aSI6IjEyMzQ1NjciLCJuYmYiOjE2OTk3MDAyMDEsImV4cCI6MTY5OTcwMzc0MSwiaWF0IjoxNjk5NzAwMTQxLCJ1aWQiOjJ9.ZNW1dXz48HbbspKBgfZFrmopMkaU-nOeOCZMBw-AMK0';
$token = (new Parser()) -> parse($str);


var_dump($token->validate($data));