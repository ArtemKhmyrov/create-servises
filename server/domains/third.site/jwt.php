<?php 
// version 3.3.x-dev
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Validation\Constraint\PermittedFor;

include 'vendor/autoload.php';

$signer = new Sha256();


echo $token = (new Builder)
    ->issuedBy('http://third.site')
    ->permittedFor('http://third.site')
    ->identifiedBy('1234567')
    ->canOnlyBeUsedAfter(time() + 60)
    ->expiresAt(time() + 3600)
    ->issuedAt(time())
    ->withClaim('uid', 2)
    ->getToken($signer, new Key('qwerty'));
;

// echo "<pre>", print_r($token), "</pre><hr />";
echo "<pre>", print_r($token->getHeaders()), "</pre><hr />";
echo "<pre>", print_r($token->getClaims()), "</pre><hr />";


echo "<pre>";
print_r($token->getHeader('alg'));echo '<hr/>';
print_r($token->getClaim('aud'));
echo "</pre><hr/>";

$str = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJub25lIn0.eyJpc3MiOiJodHRwOlwvXC90aGlyZC5zaXRlIiwiYXVkIjoiaHR0cDpcL1wvdGhpcmQuc2l0ZSIsImp0aSI6IjEyMzQ1NjciLCJuYmYiOjE2OTk2OTk1ODEsImV4cCI6MTY5OTcwMzEyMSwiaWF0IjoxNjk5Njk5NTIxLCJ1aWQiOjJ9.';


$token2 = (new Parser()) -> parse($str);
echo "<pre><h2>Разбор (парсинг) токена</h2>";
print_r($token2->getHeader('alg'));echo '<hr/>';
print_r($token2->getClaim('aud'));
echo "</pre><hr/>";

echo "<h2>Проверка токена</h2>";
echo "<pre>", var_dump($token->verify($signer, 'qwerty')), "</pre><hr />";
echo "<pre>", var_dump($token->verify($signer, 'qwerty2')), "</pre><hr />";
