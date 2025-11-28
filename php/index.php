<?php
include __DIR__ . "/components/header.php";
require_once __DIR__ . "/data_loader.php";
require_once __DIR__ . "/functions.php";


$exams = loadData();

if (!empty($_GET["examiner"])) {
    $exams = filterByExaminer($exams, $_GET["examiner"]);
}
if (!empty($_GET["place"])) {
    $exams = filterByPlace($exams, $_GET["place"]);
}
if (!empty($_GET["category"])) {
    $exams = filterByCategory($exams, $_GET["category"]);
}
if (!empty($_GET["date"])) {
    $exams = filterByDate($exams, $_GET["date"]);
}
if (!empty($_GET["sort"]) && $_GET["sort"] == "time") {
    $exams = sortByTime($exams);
}
if (!empty($_GET["sort"]) && $_GET["sort"] == "place") {
    $exams = sortByPlace($exams);
}

$sort = $_GET["sort"] ?? null;
$dir = $_GET["dir"] ?? "asc";

if ($sort === "time") {
    usort($exams, fn($a,$b) => $dir === "asc" ? $a["time"] <=> $b["time"] : $b["time"] <=> $a["time"]);
}
if ($sort === "place") {
    usort($exams, fn($a,$b) => $dir === "asc" ? strcmp($a["place"], $b["place"]) : strcmp($b["place"], $a["place"]));
}
if ($sort === "id") {
    usort($exams, fn($a,$b) => $dir === "asc" ? $a["id"] <=> $b["id"] : $b["id"] <=> $a["id"]);
}
if ($sort === "date") {
    usort($exams, fn($a,$b) => $dir === "asc" ? strcmp($a["date"], $b["date"]) : strcmp($b["date"], $a["date"]));
}
function arrow($column) {
    if (!isset($_GET["sort"]) || $_GET["sort"] !== $column) return "";
    return ($_GET["dir"] ?? "asc") === "asc" ? " ▲" : " ▼";
}


?>

<h2>Otsing ja filtrid (ilma lehe uuendamiseta)</h2>

<div class="filters">

    <div class="input-group">
        <label>Eksamineerija nimi</label>
        <input type="text" id="filter-examiner" placeholder="nt. Kristjan Saar">
    </div>

    <div class="input-group">
        <label>Asukoht</label>
        <input type="text" id="filter-place" placeholder="nt. Pirita Velorada">
    </div>

    <div class="input-group">
        <label>Kategooria</label>
        <input type="text" id="filter-category" placeholder="nt. Mountain Bike">
    </div>

    <div class="input-group">
        <label>Kuupäev</label>
        <input type="date" id="filter-date">
    </div>

    <button class="btn" id="filter-reset">Nulli filtrid</button>
</div>

<h2>Eksaminimekiri</h2>

<table class="table" id="exam-table">
    <thead>
    <tr>
        <th class="sortable" data-column="id">ID</th>
        <th class="sortable" data-column="date">Kuupäev</th>
        <th class="sortable" data-column="place">Asukoht</th>
        <th class="sortable" data-column="time">Aeg</th>
        <th>Eksamineerija</th>
        <th>Kategooria</th>
        <th>Tegevused</th>
    </tr>
    </thead>

    <tbody id="exam-body">
        <!-- Динамичная таблица -->
    </tbody>
</table>

<script src="table.js"></script>

<?php include "components/footer.php"; ?>
