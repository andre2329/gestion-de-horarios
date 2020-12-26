<?php
global $pdo;
$pdo = new PDO("mysql:host=127.0.0.1;port=3306;dbname=TFSOTR", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>