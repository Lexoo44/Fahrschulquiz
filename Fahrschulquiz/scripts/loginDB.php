<?php


    $conn = new mysqli("localhost", "root", "masterkey");
    $conn = mysqli_connect("localhost", "root", "masterkey", "quiz");

    $sql = "CREATE TABLE IF NOT EXISTS `login` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `username` varchar(255) NOT NULL,
        `password` varchar(255) NOT NULL,
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

    if ($conn->query($sql) === false) {
        echo "Error creating table: ";
    }
    $conn->close();

?>