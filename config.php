<?php
$databaseHost = 'localhost';
$databaseName = 'users';
$databaseUsername = 'root';
$databasePassword = '';
//create database connection
$conn = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
mysqli_select_db($conn, 'users');

// define how many results you want per page

?>