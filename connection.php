<!-- connection.php Revision 4 11-16-15 6:30 pm -->

<?php

/*
File Name: connection.php
Date: 2/24/2018
Programmer: Kelli Pando
/*

/* Define constants for database connections */

define("DB_DSN", "mysql:host=localhost;dbname=kpandowe_cas222;charset=utf8");
define("DB_USER", "");
define("DB_PASS", "");

/* Create a database connection */

try {
     // 1. Create a database connection
     $connection = new PDO(DB_DSN,DB_USER,DB_PASS);
     // Turn on display of errors (exceptions) so we can see problems if they occur
     $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     // Display message on successful connection
     echo "1. Database connection succeeded!";
} 
catch (PDOException $e) {
     die("1. Database connection failed: " . $e->getMessage());
}

?>