<?php


$servername = "";
$database = "";
$username = "";
$password = "";

// Establecer una nueva conexion con una abse de datos mySQL
$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
