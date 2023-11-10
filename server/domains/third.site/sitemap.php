<?php

$xmlWriter = new XMLWriter();

$xmlWriter->openMemory();

$xmlWriter->startDocument('1.0');

$xmlWriter->startElement('urlset');

$handle = opendir('.');

while( ($file = readdir($handle)) !== false) {
    
    if($file == '.' || $file == '..'){
        continue;
    }

    $infoInfo = new SplFileInfo($file);
    if($infoInfo->getExtension() !== 'php'){
        continue;
    };

    $xmlWriter->startElement('url');

        $xmlWriter->startElement('loc');
        $xmlWriter->text("http://third.site/$file");
        $xmlWriter->endElement();

    $xmlWriter->endElement();
}
closedir($handle);

$xmlWriter->endElement();

$xmlWriter->endDocument();

file_put_contents('sitemap.xml', $xmlWriter->outputMemory());