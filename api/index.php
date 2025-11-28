<?php

header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(200);
    exit;
}

$method = $_SERVER["REQUEST_METHOD"];

// Ожидаем URL вида: /api/exams/... 
$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$segments = array_values(array_filter(explode("/", $path))); // убираем пустые

// Ищем 'exams' и всё, что после него
$examsIndex = array_search("exams", $segments);
if ($examsIndex === false) {
    http_response_code(404);
    echo json_encode(["error" => "Not found"]);
    exit;
}

$id = $segments[$examsIndex + 1] ?? null;
$subaction = $segments[$examsIndex + 2] ?? null;

$dataFile = __DIR__ . "/exams.json";
$exams = file_exists($dataFile)
    ? json_decode(file_get_contents($dataFile), true)
    : [];

function sendJson($payload, int $code = 200): void {
    http_response_code($code);
    echo json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit;
}

/* ==============================
   GET /api/exams
   ============================== */
if ($method === "GET" && $id === null) {
    sendJson($exams);
}

/* ==============================
   GET /api/exams/{id}
   ============================== */
if ($method === "GET" && $id !== null) {
    foreach ($exams as $exam) {
        if ((string)$exam["id"] === (string)$id) {
            sendJson($exam);
        }
    }
    sendJson(["error" => "Exam not found"], 404);
}

/* ==============================
   POST /api/exams
   ============================== */
if ($method === "POST" && $id === null) {
    $body = json_decode(file_get_contents("php://input"), true);

    if (!is_array($body)) {
        sendJson(["error" => "Invalid JSON body"], 400);
    }

    $exams[] = $body;
    file_put_contents($dataFile, json_encode($exams, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    sendJson(["status" => "created"], 201);
}

/* ==============================
   DELETE /api/exams/{id}
   ============================== */
if ($method === "DELETE" && $id !== null) {
    $new = array_values(array_filter($exams, fn($e) => (string)$e["id"] !== (string)$id));
    file_put_contents($dataFile, json_encode($new, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    sendJson(["status" => "deleted"]);
}

/* ==============================
   PUT /api/exams/{id}
   (полная замена записи)
   ============================== */
if ($method === "PUT" && $id !== null) {
    $body = json_decode(file_get_contents("php://input"), true);

    if (!is_array($body)) {
        sendJson(["error" => "Invalid JSON body"], 400);
    }

    $found = false;
    foreach ($exams as &$exam) {
        if ((string)$exam["id"] === (string)$id) {
            $exam = $body;
            $found = true;
            break;
        }
    }

    if (!$found) {
        sendJson(["error" => "Exam not found"], 404);
    }

    file_put_contents($dataFile, json_encode($exams, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    sendJson(["status" => "updated"]);
}

/* ==============================
   PATCH /api/exams/{id}/examiner
   (смена экзаменатора)
   ============================== */
if ($method === "PATCH" && $id !== null && $subaction === "examiner") {
    $body = json_decode(file_get_contents("php://input"), true);

    if (!isset($body["examiner"])) {
        sendJson(["error" => "Field 'examiner' required"], 400);
    }

    $found = false;
    foreach ($exams as &$exam) {
        if ((string)$exam["id"] === (string)$id) {
            $exam["examiner"] = $body["examiner"];
            $found = true;
            break;
        }
    }

    if (!$found) {
        sendJson(["error" => "Exam not found"], 404);
    }

    file_put_contents($dataFile, json_encode($exams, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    sendJson(["status" => "examiner updated"]);
}

sendJson(["error" => "Unsupported request"], 400);