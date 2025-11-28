<?php

$xml = simplexml_load_file(__DIR__ . "/../data/exam_data.xml");
$jsonFile = __DIR__ . "/../api/exams.json";

$entries = [];

foreach ($xml->session as $session) {
    foreach ($session->location as $location) {
        foreach ($location->exam as $exam) {
            $entries[] = [
                "id"       => (int) $exam["id"],
                "date"     => (string) $session["date"],
                "place"    => (string) $location["place"],
                "time"     => (string) $exam->time,
                "duration" => (int) $exam->duration,
                "examiner" => (string) $exam->examiner["name"],
                "category" => (string) $exam->category,
            ];
        }
    }
}

file_put_contents($jsonFile, json_encode($entries, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

echo "JSON file generated: {$jsonFile}\n";

