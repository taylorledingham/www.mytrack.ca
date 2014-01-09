<?php
session_start();
$meet_id= $_GET['meet_name'];

$_SESSION["meet_id"]=$meet_id;


?>