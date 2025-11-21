<?php
// Получение списка экзаменов с фильтром по экзаменатору
function getExams($examiner = '') {
    $xml = simplexml_load_file('../exams.xml');
    $exams = [];

    foreach ($xml->exam as $exam) {
        if ($examiner === '' || stripos($exam->examiner, $examiner) !== false) {
            $exams[] = [
                'id' => (string)$exam['id'],
                'datetime' => (string)$exam->datetime,
                'location' => (string)$exam->location,
                'examiner' => (string)$exam->examiner,
                'duration' => (string)$exam->duration,
                'students' => array_map('strval', iterator_to_array($exam->students->student))
            ];
        }
    }

    return $exams;
}

// Удаление экзамена
function deleteExam($id) {
    $xml = simplexml_load_file('../exams.xml');

    foreach ($xml->exam as $exam) {
        if ((string)$exam['id'] === $id) {
            $dom = dom_import_simplexml($exam);
            $dom->parentNode->removeChild($dom);
            $xml->asXML('../exams.xml');
            return true;
        }
    }

    return false;
}

// Добавление экзамена
function addExam($data) {
    $xml = simplexml_load_file('../exams.xml');

    $exam = $xml->addChild('exam');
    $exam->addAttribute('id', $data['id']);
    $exam->addChild('datetime', $data['datetime']);
    $exam->addChild('location', $data['location']);
    $studentsNode = $exam->addChild('students');
    foreach ($data['students'] as $student) {
        $studentsNode->addChild('student', $student);
    }
    $exam->addChild('examiner', $data['examiner']);
    $exam->addChild('duration', $data['duration']);

    $xml->asXML('../exams.xml');
}
