<?php
$connect = mysqli_connect('localhost', 'root','', 'socialnet');
mysqli_set_charset($connect, "utf8");
if ($connect == false) {
    echo "Could not connect to database.";
    die("Error: " . mysqli_connect_error());
}
