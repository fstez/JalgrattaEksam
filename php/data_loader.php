<?php

function loadData() {
    $jsonFile = __DIR__ . "/../api/exams.json";

    if (!file_exists($jsonFile)) {
        return [];
    }

    $data = json_decode(file_get_contents($jsonFile), true);

    if (!is_array($data)) {
        return [];
    }

    return $data;
}
