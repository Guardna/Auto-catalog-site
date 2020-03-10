<?php
session_start();
if(($_SESSION['korisnik']->naziv)!="admin"):
header("Location:index.php");
endif;
include "php/konekcija.php";
include "views/head.php";
include "views/login.php";
include "views/nav.php";
include "views/slider.php";
include "views/admin.php";
include "views/footer.php";