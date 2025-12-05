<?php
$xml = new DOMDocument();
$xml->load(__DIR__ . "/../data/exam_data.xml");

$xsl = new DOMDocument();
$xsl->load(__DIR__ . "/../data/exam_to_html.xsl"); 

$proc = new XSLTProcessor();
$proc->importStylesheet($xsl);

header("Content-Type: text/html; charset=utf-8");
echo $proc->transformToXML($xml);
