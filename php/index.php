<?php

$xml = new DOMDocument();
$xml->load(__DIR__ . "/../data/exam_data.xml");

$xsl = new DOMDocument();
$xsl->load(__DIR__ . "/../data/exam_to_html.xsl");

$processor = new XSLTProcessor();
$processor->importStylesheet($xsl);

echo $processor->transformToXML($xml);

