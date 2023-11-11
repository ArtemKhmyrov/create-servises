<?php

$f = fopen('compress.zlib://my.txt.gz', 'w');
fwrite($f,"Привет мир" .time() . "\n" );
fclose($f);