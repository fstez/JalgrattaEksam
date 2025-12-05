<?php
include __DIR__ . "/components/header.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include "add_to_json.php";
    echo "<p class='success'>Eksam edukalt lisatud!</p>";
}
?>

<div class="form-card">     <!-- переместили сюда -->
<h2>Lisa uus eksam</h2>

<form method="post">

    <div class="input-group">
        <label>Eksam ID</label>
        <input name="id" required>
    </div>

    <div class="input-group">
        <label>Kuupäev</label>
        <input type="date" name="date" required>
    </div>

    <div class="input-group">
        <label>Asukoht</label>
        <input name="place" required>
    </div>

    <div class="input-group">
        <label>Aeg</label>
        <input type="time" name="time" required>
    </div>

    <div class="input-group">
        <label>Kestus (min)</label>
        <input type="number" name="duration" required>
    </div>

    <div class="input-group">
        <label>Eksamineerija</label>
        <input name="examiner" required>
    </div>

    <div class="input-group">
        <label>Kategooria</label>
        <input name="category" required>
    </div>

    <button>Lisa</button>
</form>
</div>

<?php include __DIR__ . "/components/footer.php"; ?>
