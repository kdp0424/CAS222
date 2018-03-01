<?php

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

     echo "<br />Please <a href='contact.php'>Go Back</a> and fill in the missing data.<br /><br /></body></html>";
     exit;

}

// ASSIGN DATA TO VARIABLES FOR EASIER HANDLING
$fullName=$_POST["fullName"];
$email=$_POST["email"];
$role=$_POST["role"];
$comments=$_POST["comments"];

// SQL STATEMENT

$sql="INSERT INTO contact(fullName, email, role, comments,)"
. " VALUES('$fullName', '$email', '$role', '$comments');"; 

     
// Display SQL for learning and trouble-shooting
     
echo "<br>2. SQL: " . $sql . "<br>";

// RUN QUERY
     
// Run a query
try {
     $result = $connection->query($sql);
     echo "3. Thank you! Your form has been submitted!<br>";
} 
catch (PDOException $e) {
     die("3. Query failed! " . $e->getMessage());
}

// Everything below is from the Nifty Project contact file example, but modified for this assignment.

// Gets posted data from the HTML form fields and creates local variables. The items with the ' marks around them are the name values from the fields in the HTML form example above. Note, the first three variables are required for all email messages (as described above).

$fullName = trim(stripslashes($_POST['fullName']));
$email = trim(stripslashes($_POST['email']));
$role = trim(stripslashes($_POST['role']));
$comments = trim(stripslashes($_POST['comments']));
// $current_date = date("Y-m-d"); // This date is created when the form is submitted.

// This section below validates the $EmailFrom (data from the Email From field) and $Phone (data from the Telephone field).

$validationOK=true;
if ($fullName=="") $validationOK=false;
if ($email=="") $validationOK=false;
if ($comments=="") $validationOK=false;
if (!$validationOK) {
  print "<meta http-equiv=\"refresh\" content=\"0;URL=error.html\">";
  exit;
}

if ($success){
  print "<meta http-equiv=\"refresh\" content=\"0;URL=ok.html\">";
}
else{
  print "<meta http-equiv=\"refresh\" content=\"0;URL=error.html\">";
}

/* Define constants for database connections */

define("DB_DSN", "mysql:host=localhost;dbname=kpandowe_cas222;charset=utf8");
define("DB_USER", "kpandowe");
define("DB_PASS", "P3anut$7");

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