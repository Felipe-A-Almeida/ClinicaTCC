<?php
include "init.php";
session_start();
session_unset(); 
session_destroy();
header("LOCATION: ".URL_BASE);
?>