<?php
define("SHOST", "localhost"); // The host you want to connect to.
define("SUSER", "qdekos1q_cda"); // The database username.
define("SPASSWORD", "cda123"); // The database password. 
define("SDATABASE", "qdekos1q_cda_db"); // The database name.
 
$mysqli = new mysqli(SHOST, SUSER, SPASSWORD, SDATABASE);
// If you are connecting via TCP/IP rather than a UNIX socket remember to add the port number as a parameter.
?>