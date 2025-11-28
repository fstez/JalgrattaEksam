<?php

$jsonFile = __DIR__ . "/../api/exams.json";

$data = json_decode(file_get_contents($jsonFile), true);

$id = $_POST["id"];

foreach ($data as &$exam) {
    if ($exam["id"] == $id) {

        $exam["date"]     = $_POST["date"];
        $exam["place"]    = $_POST["place"];
        $exam["time"]     = $_POST["time"];
        $exam["duration"] = $_POST["duration"];
        $exam["examiner"] = $_POST["examiner"];
        $exam["category"] = $_POST["category"];

        break;
    }
}

file_put_contents($jsonFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

echo "OK";
