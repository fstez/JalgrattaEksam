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
    include "update_json.php";
    echo "<p class='success'>Eksam edukalt uuendatud!</p>";
}
?>

<h2>Muuda eksamit</h2>

<form method="post">

    <input type="hidden" name="id" value="<?= $exam["id"] ?>">

    <div class="input-group">
        <label>Kuupäev</label>
        <input type="date" name="date" value="<?= $exam["date"] ?>" required>
    </div>

    <div class="input-group">
        <label>Asukoht</label>
        <input type="text" name="place" value="<?= $exam["place"] ?>" required>
    </div>

    <div class="input-group">
        <label>Aeg</label>
        <input type="time" name="time" value="<?= $exam["time"] ?>" required>
    </div>

    <div class="input-group">
        <label>Kestus (min)</label>
        <input type="number" name="duration" value="<?= $exam["duration"] ?>" required>
    </div>

    <div class="input-group">
        <label>Eksamineerija</label>
        <input type="text" name="examiner" value="<?= $exam["examiner"] ?>" required>
    </div>

    <div class="input-group">
        <label>Kategooria</label>
        <input type="text" name="category" value="<?= $exam["category"] ?>" required>
    </div>

    <button class="btn">Salvesta muudatused</button>
</form>

<?php include "components/footer.php"; ?>
