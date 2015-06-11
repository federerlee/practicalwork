<?php
function getDB() {
    $dbhost="mydb.tamk.fi";
    $dbuser="e4lguoli"; // Your own username
    $dbpass="jaber6ekaF"; // Your own password
    $dbname="dbe4lguoli1";  // Your own database name

    $dbConnection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass); 
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $dbConnection;

}