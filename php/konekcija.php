<?php

# 2 - Kreiranje konekcije sa bazom

// Ukljucivanje fajla u kome se nalaze parametri za konekciju sa bazom
require_once "config.php";

try {
	// Kreiranje konekcije sa bazom
    
	$konekcija = new PDO("mysql:host=".MYSQL_HOST.";dbname=".MYSQL_DBNAME.";charset=utf8", MYSQL_USERNAME, MYSQL_PASSWORD);
	
	// Ukljucivanje Error reporting
    $konekcija->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// Promena DEFAULT moda vracanja podataka iz baze - objekti
    $konekcija->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
	
}
catch(PDOException $e){
    echo $e->getMessage();
}

# 3 - Funkcija za izvrsanje bilo kog SELECT upita

function executeQuery($upit){
    global $konekcija;

    $rezultat = $konekcija->query($upit)->fetchAll();
    
    return $rezultat;
}
