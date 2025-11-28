<?php

$jsonFile = __DIR__ . "/../api/exams.json";
$data = json_decode(file_get_contents($jsonFile), true);

$newExam = [
    "id"       => (int) $_POST["id"],
    "date"     => $_POST["date"],
    "place"    => $_POST["place"],
    "time"     => $_POST["time"],
    "duration" => (int) $_POST["duration"],
    "examiner" => $_POST["examiner"],
    "category" => $_POST["category"],
];

$data[] = $newExam;

file_put_contents($jsonFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

echo "Exam added.";

