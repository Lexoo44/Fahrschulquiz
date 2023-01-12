<?php
$server = "localhost";
$user = "root";
$password = "masterkey";
$database = "quiz";

$conn = new mysqli("localhost", "root", "masterkey");
$sql = "CREATE DATABASE IF NOT EXISTS quiz";
if ($conn->query($sql) === false) {
    echo "Database creation error\n";
  }

$conn = mysqli_connect("localhost", "root", "masterkey", "quiz");
$sql = "CREATE TABLE IF NOT EXISTS`antworten` (
    `antwortnummer` int(11) NOT NULL auto_increment,
    `antworttext` varchar(200) collate latin1_german1_ci NOT NULL,
    `richtig` tinyint(1) NOT NULL default '0',
    `fragenummer` int(11) NOT NULL,
    PRIMARY KEY  (`antwortnummer`),
    KEY `fragenummer` (`fragenummer`)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci AUTO_INCREMENT=6922";

if ($conn->query($sql) === false) {
  echo "Error creating table: ";
  }

$sql = "LOAD DATA LOCAL INFILE 'scripts/DatenbankdefinitionQuiz.txt' INTO TABLE antworten FIELDS TERMINATED BY ';' ";
if ($conn->query($sql) === false) {
  echo "Error importing data: ";
  }

if ($conn->query($sql) === false) {
  echo "Error loading file: ";
  }

$conn->close();
?>