<?php
    $document = new DOMDocument();
    $document->load('catalog.xml');

    $style = new DOMDocument();
    $style->load('catalog.xsl');

    $proc = new XSLTProcessor;
    $proc->importStylesheet($style);
    echo $proc->transformToXml($document);

    