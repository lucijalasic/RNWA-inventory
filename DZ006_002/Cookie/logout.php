<?php
session_start();
if(isset($_SESSION['logiran'])){
    unset($_SESSION['logiran']);
}
if(isset($_SESSION['vrijeme'])){
    unset($_SESSION['vrijeme']);
}
if(isset($_SESSION['vrsta'])){
    unset($_SESSION['vrsta']);
}
session_destroy();
echo "Odjavljeni ste... slijedi preusmjeravanje.";
?>

<meta http-equiv="refresh" content="3;index.php" />  