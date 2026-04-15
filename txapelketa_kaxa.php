<?php foreach ($stmt as $txapelketak): ?>
    <div class="txapelketa_bakoitza">
        <?php
        $estiloa = "";
        if ($txapelketak["egoera"] == "Izen ematen") {
            $estiloa = "IzenEmaten";
        }else if ($txapelketak["egoera"] == "Amaituta"){
            $estiloa = "Amaituta";
        }else{
            $estiloa = "Jolasten";
        }
         ?>

        <p class="egoera <?= $estiloa ?>"><?= $txapelketak["egoera"]; ?></p>
        <a class="titulu_txap" href="txapelketa_barnea.php?id=<?= $txapelketak['id']; ?>"><?= $txapelketak["izena"]; ?></a>
        <div class="kokalekua">
            <p>📍 Lekua:
                <span><?= $txapelketak["herria"]; ?> - <?= $txapelketak["tokia"] ?></span>
            </p>
            <p>📅 Data: <?= $txapelketak["data"]; ?></p>
        </div>
        <div class="linea"></div>
        <p>Bikote kantitatea: <?= $txapelketak["bikote_kant"]; ?></p>
    </div>
<?php endforeach; ?>