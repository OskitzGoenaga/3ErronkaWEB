<?php
// Saioa hasi (session-ak erabiltzeko)
session_start();

// Sesio guztiko aldagaiak ezabatu
$_SESSION = array();

// Sesioa guztiz suntsitu
session_destroy();

// Hasierako orrira birbideratu
header("Location: index.php");
exit();
?>
