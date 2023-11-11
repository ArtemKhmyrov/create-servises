<?php

$phar = new Phar('my.phar');
$phar['text.txt'] = 'Test Info';
$phar['echo.php'] = '<?php phpinfo();?>';
echo file_get_contents('phar://my.phar/test.txt');