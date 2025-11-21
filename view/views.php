<?php
    $examiner = isset($_GET['examiner']) ? $_GET['examiner'] : '';
    $xml = new DOMDocument;
    $xml->load('../exams.xml');

    $xsl = new DOMDocument;
    $xsl->load('../transform.xslt');

    $proc = new XSLTProcessor();
    $proc->importStylesheet($xsl);
    $proc->setParameter('', 'examiner', $examiner);

    echo $proc->transformToXML($xml);
