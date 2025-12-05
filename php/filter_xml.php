<?php
$examiner = $_GET['name'] ?? '';

$xml = new DOMDocument();
$xml->load(__DIR__ . "/../data/exam_data.xml");

$xsl = new DOMDocument();
$xsl->load(__DIR__ . "/../data/exam_filter_by_examier.xsl");

$proc = new XSLTProcessor();
$proc->importStylesheet($xsl);
$proc->setParameter('', 'examinerName', $examiner);

header("Content-Type: text/xml; charset=utf-8");
echo $proc->transformToXML($xml);
