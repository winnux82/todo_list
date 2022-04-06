<?php

//on lance session
session_start();
//on initialise la position
$position = null;
//on importe la position avec $_GET
if (isset($_GET['position'])) {
    $position = $_GET['position'];
}

$data=$_POST;

print_r($data);
