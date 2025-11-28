<?php
include "components/header.php";
include "data_loader.php";

$exams = loadData();
$id = $_GET["id"];

foreach ($exams as $e) {
    if ($e["id"] == $id) {
        $exam = $e;
        break;
    }
}
?>

<h2>Eksam — üksikasjad</h2>

<p><b>ID:</b> <?= $exam["id"] ?></p>
<p><b>Kuupäev:</b> <?= $exam["date"] ?></p>
<p><b>Asukoht:</b> <?= $exam["place"] ?></p>
<p><b>Aeg:</b> <?= $exam["time"] ?></p>
<p><b>Eksamineerija:</b> <?= $exam["examiner"] ?></p>
<p><b>Kategooria:</b> <?= $exam["category"] ?></p>
<p><b>Kestus:</b> <?= $exam["duration"] ?> minutit</p>

<a class="btn" href="edit.php?id=<?= $exam["id"] ?>">Muuda eksamit</a>

<?php include "components/footer.php"; ?>
