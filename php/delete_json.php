<?php

$jsonFile = __DIR__ . "/../api/exams.json";
$data = json_decode(file_get_contents($jsonFile), true);

$id = $_POST["id"];

$data = array_values(array_filter($data, fn($e) => $e["id"] != $id));

file_put_contents($jsonFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

echo "OK";
