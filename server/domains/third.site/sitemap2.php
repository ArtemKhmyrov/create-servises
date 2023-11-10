<?php

$xmlWriter = new XMLWriter();

$xmlWriter->openMemory();

$xmlWriter->startDocument('1.0');

$xmlWriter->startElement('urlset');

foreach(new DirectoryIterator ('.') as $file){
    if($file->isDot() || $file->getExtension() !== 'php') {
        continue;
    }
    $xmlWriter->startElement('url');

        $xmlWriter->startElement('loc');
        $xmlWriter->text("http://third.site/" . $file->getFilename());
        $xmlWriter->endElement();

    $xmlWriter->endElement();

}
$xmlWriter->endElement();

$xmlWriter->endDocument();

file_put_contents('sitemap2.xml', $xmlWriter->outputMemory());