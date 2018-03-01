<?php

/*
File Name: functions.php
Date: 2/27/2018
Programmer: Kelli Pando
*/

// Functions

include_once "includes/functions.php";

// end functions

// CODE FOR THIS PAGE

// -- CHECK EACH FIELD FOR MISSING DATA AND SANITIZE

// Check if data submitted (remove comment tags on 3 lines below to see the array)
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

foreach ($form_fields as $key => $value) { // Loop through form fields. Key is the name of the field, value is type of field

     check_submitted($key, $value, $missing_count);

     sanitize($key, $value, $_POST[$key]);
     
}

// exit if missing data in any but checkboxes

if($missing_count > 0) {

     echo "<br />Please <a href='registration_add_action.php'>Go Back</a> and fill in the missing data.<br /><br /></body></html>";
     exit;

}

// ASSIGN DATA TO VARIABLES FOR EASIER HANDLING
$name=$_POST["name"];
$email=$_POST["email"];
$phone=$_POST["phone"];
$events=$_POST["events"];
$participation_type=$_POST["participation_type"];
$tshirt=$_POST["tshirt"];
$gender=$_POST["gender"];

// CONNECT TO DATABASE (Step 1)

include_once "includes/connection.php";

// SQL STATEMENT

$sql="INSERT INTO registration(name, email, phone, events, participation-type, t-shirt, gender)"
. " VALUES('$name', '$email', '$phone', '$events', '$participation_type', '$tshirt', '$gender);"; 

     
// Display SQL for learning and trouble-shooting
     
echo "<br>2. SQL: " . $sql . "<br>";

// RUN QUERY
     
// Run a query
try {
     $result = $connection->query($sql);
     echo "3. Thank you! Your registration has been submitted!<br>";
} 
catch (PDOException $e) {
     die("3. Query failed! " . $e->getMessage());
}

?>