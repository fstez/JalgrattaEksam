<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $xml = simplexml_load_file('exams.xml');

    foreach ($xml->exam as $exam) {
        if ((string)$exam['id'] === $id) {
            $dom = dom_import_simplexml($exam);
            $dom->parentNode->removeChild($dom);
            $xml->asXML('exams.xml');
            echo json_encode(['status' => 'success']);
            exit;
        }
    }

    echo json_encode(['status' => 'error', 'message' => 'Exam not found']);
}
