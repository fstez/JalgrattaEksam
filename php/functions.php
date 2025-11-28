<?php

$xml = simplexml_load_file(__DIR__ . "/../data/exam_data.xml");


/**
 * Поиск экзаменов по экзаменатору
 */

function findExamsByExaminer(string $name): array {
	global $xml;
	return $xml->xpath("//exam[examiner/@name='$name']");
}

// Поиск экзаменов по месту проведения

function findExamByPlace(string $place): array {
	global $xml;
	return $xml->xpath("//location[$place='$place']/exam");
}

// Поиск экзаменов по диапазону времени (строки вида "HH:MM")

function findExamsByTimeRange(string $start, string $end): array {
	global $xml;
	return $xml->xpath("//exam[time >= '$start' and time <= '$end']");
}


