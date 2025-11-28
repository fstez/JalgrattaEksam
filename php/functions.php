<?php

function filterByExaminer($exams, $name) {
    return array_filter($exams, function($e) use ($name) {
        return stripos($e["examiner"], $name) !== false;
    });
}

function filterByPlace($exams, $place) {
    return array_filter($exams, function($e) use ($place) {
        return stripos($e["place"], $place) !== false;
    });
}

function filterByCategory($exams, $category) {
    return array_filter($exams, function($e) use ($category) {
        return stripos($e["category"], $category) !== false;
    });
}

function filterByDate($exams, $date) {
    return array_filter($exams, function($e) use ($date) {
        return $e["date"] === $date;
    });
}

function sortByTime($exams) {
    usort($exams, function($a, $b) {
        return strcmp($a["time"], $b["time"]);
    });
    return $exams;
}

function sortByPlace($exams) {
    usort($exams, function($a, $b) {
        return strcmp($a["place"], $b["place"]);
    });
    return $exams;
}
