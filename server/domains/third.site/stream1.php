<?php


$context = stream_context_create([
    'http' => ['method' => 'GET', 'header' => "Content-Type: text/html\r\nCookie: test=123"  
    ]
]);


$f = fopen("https://www.specialist.ru", "r", false, $context);

fpassthru($f);
fclose($f);