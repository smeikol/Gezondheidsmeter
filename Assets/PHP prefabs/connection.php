<?php 
session_start();

$conn =  mysqli_connect("localhost", "root", "", "gezondheidsmeter");

if (!$conn) {
    die("Could not connect to server. Error: " . mysqli_connect_error());
}





?>