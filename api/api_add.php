<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $xml = simplexml_load_file('../exams.xml');

    $exam = $xml->addChild('exam');
    $exam -> addAttribute('id', $_POST['id']);
    $exam -> addAttribute('datetime', $_POST['datetime']);
    $exam -> addAttribute('location', $_POST['location']);

    $studentsNode = $exam -> addChild('students');
    foreach($_POST['students'] as $value) {
        $studentsNode ->addChild('student', $value);
    }

    $exam -> addChild('examiner', $_POST['examiner']);
    $exam -> addChild('duration', $_POST['duration']);

    $xml->asXML('../exams.xml');
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status'=> '']);
}