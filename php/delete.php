<?php
include "components/header.php";
include "data_loader.php";

$exams = loadData();
$id = $_GET["id"];
$exam = null;

foreach ($exams as $e) {
    if ($e["id"] == $id) {
        $exam = $e;
        break;
    }
}

if (!$exam) {
    echo "<p>Eksamit ei leitud.</p>";
    include "components/footer.php";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include "delete_json.php";
    echo "<p class='success'>Eksam on kustutatud!</p>";
    echo '<a class="btn" href="index.php">Tagasi avalehele</a>';
    include "components/footer.php";
    exit;
}
?>

<h2>Kustuta eksam</h2>

<p><b>Kas oled kindel, et soovid kustutada selle eksami?</b></p>

<p>
    <b>ID:</b> <?= $exam["id"] ?><br>
    <b>Kuupäev:</b> <?= $exam["date"] ?><br>
    <b>Asukoht:</b> <?= $exam["place"] ?><br>
    <b>Aeg:</b> <?= $exam["time"] ?><br>
    <b>Eksamineerija:</b> <?= $exam["examiner"] ?><br>
</p>

<form method="post">
    <input type="hidden" name="id" value="<?= $exam["id"] ?>">
    <button class="btn" style="background:red;">Kinnita kustutamine</button>
</form>

<a class="btn" href="index.php">Tühista</a>

<?php include "components/footer.php"; ?>
