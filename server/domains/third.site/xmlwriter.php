<?php 
header ('Content-Type: text/xml');

$xmlWriter = new XMLWriter();

$xmlWriter->openMemory();

$xmlWriter->startDocument('1.0');

$xmlWriter->startElement('catalog');

for($i = 0; $i < 10; $i++){
    $xmlWriter->startElement('book');
    $xmlWriter->startElement('book1');
    $xmlWriter->startElement('book2');

        $xmlWriter->startElement('idbook');
        $xmlWriter->text($i+1);
        $xmlWriter->endElement();

        $xmlWriter->startElement('title');
        $xmlWriter->text("книга $i");
        $xmlWriter->endElement();


        $xmlWriter->startElement('author');
        $xmlWriter->text("автор $i");
        $xmlWriter->endElement();

        $xmlWriter->startElement('price');
        $xmlWriter->text($i * 100);
        $xmlWriter->endElement();
    




    $xmlWriter->endElement();
    $xmlWriter->endElement();
    $xmlWriter->endElement();
}


$xmlWriter->endElement();

$xmlWriter->endDocument();

echo $xmlWriter->outputMemory();


