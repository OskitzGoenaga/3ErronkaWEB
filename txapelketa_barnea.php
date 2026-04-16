<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Txapelketa barnea</title>
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="orokorra.css">
    <link rel="stylesheet" href="txapelketa_barnea.css">
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" href="txapelketa_kaxa.css">
    <link rel="icon" type="image/x-icon" href="Argazkiak/icono.ico" sizes="any">
</head>

<body>

<?php
include_once "navbar.php";
include_once "konexioa.php";

// Txapelketa datuak lortu
$stmt = $pdo->prepare("SELECT * FROM txapelketak WHERE id = ?");
$stmt->execute([$_GET['id']]);
$txapelketa = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$txapelketa) {
    header("Location: txapelketak.php");
    exit;
}

$txapelketa_id = (int) $_GET['id'];
$mezua = "";
$mezua_mota = "";

// ====================== INSKRIPZIO LOGIKA ======================

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $emaila      = trim($_POST['emaila']);
    $bikotekidea = trim($_POST['bikotekidea']);
    $ezizena     = trim($_POST['ezizena']);
    $bikote_kant = $txapelketa['bikote_kant'];

    // 1) Egiaztatu biak existitzen direla jokalariak taulan
    $stmt = $pdo->prepare("SELECT id, izena FROM jokalariak WHERE emaila = ?");
    $stmt->execute([$emaila]);
    $jokalari1 = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt2 = $pdo->prepare("SELECT id, izena FROM jokalariak WHERE emaila = ?");
    $stmt2->execute([$bikotekidea]);
    $jokalari2 = $stmt2->fetch(PDO::FETCH_ASSOC);

    $stmt3 = $pdo->prepare("SELECT b.id FROM bikoteak as b INNER JOIN txapelketa_bikoteak as t ON b.id = t.bikotea_id WHERE t.txapelketa_id = ? AND b.ezizena = ?");
    $stmt3->execute([$_GET['id'], $ezizena]);
    $bikotea = $stmt3->fetch(PDO::FETCH_ASSOC);

    if (!$jokalari1) {
        $mezua = "Zure emaila ez dago erregistratuta sisteman.";
        $mezua_mota = "errorea";

    } elseif (!$jokalari2) {
        $mezua = "Bikotekidearen emaila ez dago erregistratuta sisteman.";
        $mezua_mota = "errorea";

    } elseif ($bikotea) {
        $mezua = "Talde izena jada erregistratuta dago txapelketan.";
        $mezua_mota = "errorea";

    } elseif ($emaila === $bikotekidea) {
        $mezua = "Zure emaila eta bikotekidearen emaila ezin dira berdinak izan.";
        $mezua_mota = "errorea";

    } elseif ($bikote_kant >= 32) {
        $mezua = "Txapelketa honetan ezin zara izena eman, bikote kopurua gehienezkoa da.";
        $mezua_mota = "errorea";

    } else {
        
        $stmt3 = $pdo->prepare("INSERT INTO bikoteak (jokalaria1_id, jokalaria2_id, ezizena) VALUES (?, ?, ?)");
        $stmt3->execute([$jokalari1['id'], $jokalari2['id'], $ezizena]);
        $bikote_id = $pdo->lastInsertId();

        $stmt = $pdo->prepare("INSERT INTO txapelketa_bikoteak (txapelketa_id, bikotea_id) VALUES (?, ?)");
        $stmt->execute([$_GET['id'], $bikote_id]);

        $stmt = $pdo->prepare("UPDATE txapelketak SET bikote_kant = bikote_kant + 1 WHERE id = ?");
        $stmt->execute([$_GET['id']]);

        $mezua = "Inskripzioa ongi bidali da! Eskerrik asko.";
        $mezua_mota = "arrakasta";
    }
}

// Egoera kolorea
if ($txapelketa["egoera"] == "Izen Ematen") {
    $estiloa = "IzenEmaten";
} elseif ($txapelketa["egoera"] == "Amaituta") {
    $estiloa = "Amaituta";
} else {
    $estiloa = "Jolasten";
}

?>

    <div class="txapelketa-orria">

        <section class="hero-sekzioa">
            <div class="hero-edukia">
                <a href="txapelketak.php" class="atzera-botoia">← Atzera</a>
                <p class="egoera-badge <?= $estiloa ?>"><?= htmlspecialchars($txapelketa['egoera']) ?></p>
                <h1 class="txapelketa-izena"><?= htmlspecialchars($txapelketa['izena']) ?></h1>
            </div>
        </section>

        <div class="edukia-kontainerra">

            <!-- Ezkerreko zutabea -->
            <div class="info-zutabea">
                <h2 class="sekzio-titulua">Txapelketaren datuak</h2>
                <div class="info-kaxa">
                    <div class="info-lerroa">
                        <span class="info-ikurra">📍</span>
                        <div>
                            <p class="info-etiketa">Lekua</p>
                            <p class="info-balioa">
                                <?= htmlspecialchars($txapelketa['herria']) ?> —
                                <?= htmlspecialchars($txapelketa['tokia']) ?>
                            </p>
                        </div>
                    </div>
                    <div class="info-lerroa">
                        <span class="info-ikurra">📅</span>
                        <div>
                            <p class="info-etiketa">Data</p>
                            <p class="info-balioa"><?= htmlspecialchars($txapelketa['data']) ?></p>
                        </div>
                    </div>
                    <div class="info-lerroa">
                        <span class="info-ikurra">🃏</span>
                        <div>
                            <p class="info-etiketa">Bikote kopurua</p>
                            <p class="info-balioa"><?= $txapelketa['bikote_kant'] ?> bikote</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Eskumako zutabea -->
            <div class="inskripzio-zutabea">
                <div class="inskripzio-kaxa <?= $txapelketa["egoera"] !== 'Izen Ematen' ? 'itxita' : '' ?>">

                    <?php if ($txapelketa["egoera"] === 'Izen Ematen'): ?>

                        <h2 class="sekzio-titulua">Inskribatu</h2>
                        <p class="inskripzio-azalpena">Bete formularioa txapelketan parte hartzeko.</p>

                        <?php if ($mezua): ?>
                            <div class="mezua <?= $mezua_mota ?>"><?= htmlspecialchars($mezua) ?></div>
                        <?php endif; ?>

                        <form method="POST" class="inskripzio-formularioa">
                            <div class="eremu-taldea">
                                <label for="emaila">Zure emaila</label>
                                <input type="email" id="emaila" name="emaila" placeholder="Zure emaila" required>
                            </div>
                            <div class="eremu-taldea">
                                <label for="bikotekidea">Bikotekidearen emaila</label>
                                <input type="email" id="bikotekidea" name="bikotekidea" placeholder="Bikotekidearen emaila" required>
                            </div>

                            <div class="eremu-taldea">
                                <label for="ezizena">Taldearen izena</label>
                                <input type="text" id="ezizena" name="ezizena" placeholder="Taldearen izena" required>
                            </div>
                            <button type="submit" class="inskribatu-botoia">
                                Inskribatu orain
                            </button>
                        </form>

                    <?php elseif ($txapelketa["egoera"] === 'Amaituta'): ?>
                        <div class="inskripzio-itxita">
                            <span class="itxita-ikurra">🏁</span>
                            <h3>Txapelketa amaituta</h3>
                            <p>Txapelketa hau jada amaituta dago.</p>
                            <a href="txapelketak.php" class="beste-txapelketa-botoia">Txapelketa guztiak ikusi</a>
                        </div>

                    <?php else: ?>
                        <div class="inskripzio-itxita">
                            <span class="itxita-ikurra">⏳</span>
                            <h3>Jolasten ari da</h3>
                            <p>Txapelketa hasita dago eta inskripzioak itxita daude.</p>
                            <a href="txapelketak.php" class="beste-txapelketa-botoia">Txapelketa guztiak ikusi</a>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

        </div>
    </div>

<?php include_once "footer.php"; ?>