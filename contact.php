<?php

// Functions

// include_once "includes/functions.php";

// end functions

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

// Instructor Note -- with variable names (above beginning with $), I usually used mixed case to distinguish them from the all lower case HTML input field names (the POST fields above). Variable names can be called anything, but cannot use spaces. For example, if you are pulling data from a name field in an HTML form, you may want to call the PHP variable $Name and if you are pulling data from a comments field, you may want to call the variable $Comments. 

// This section below validates the $EmailFrom (data from the Email From field) and $Phone (data from the Telephone field).

// Instructor Note -- you should always validate at least one field you use from your form so your form doesn't get "Submit Spam" (in other words, people continuous clicking submit and spamming your email without sending data). Even if you are using Javascript or Spry validation, it's still a very good idea to do this. Javascript and Spry (which is also Javascript) can easily be bypassed if the user doesn't allow Javascript to be active through their browser -- and it can easily be turned off through most browser preferences. 

// The fields being validated here, from the form example above, are the email and telephone fields. Those must contain some form of data for the PHP to accept them, otherwise the error.html page is generated to the form user.

$validationOK=true;
if ($fullName=="") $validationOK=false;
if ($email=="") $validationOK=false;
if ($comments=="") $validationOK=false;
if (!$validationOK) {
  print "<meta http-equiv=\"refresh\" content=\"0;URL=error.html\">";
  exit;
}

// This section below creates a file called form-data.csv (if one doesn't already exist) in the contacts/ folder (you should have created). The purpose of this is to collect all your form contacts in one .csv file for use later.

// If a file with the name form-data.csv does exist in that folder already, then the submitted form info is submitted to it. (The a+ means to append to a file if it already exists.)

// A .csv file is a comma-delimited file that can be pulled into a spreadsheet program like Excel. 

// Be sure to edit the $form_data variable to include all the correct variables you created above.

// The str_replace function is used to remove any commas from the username data so it doesn't create extraneous fields in the .csv file.

// $myFilePath = "contacts/";
// $myFileName = "form-data.csv";
// $myPointer = fopen ($myFilePath.$myFileName, "a+");
// $form_data = $current_date . "," . $EmailFrom . "," . str_replace(",", "", $User) . "," . $Phone . "\n";
// fputs ($myPointer, $form_data);
// fclose ($myPointer);


// This section of PHP prepares the email body text. This is the fourth and final required element to compose and send an email message from a server-side script. 

// $Body = "";
// $Body .= "The user's name: ";
// $Body .= $User;
// $Body .= "\n";
// $Body .= "The user's telephone number: ";
// $Body .= $Phone;
// $Body .= "\n";

// Instructor Note -- The ".=" means to append to (added to) the previous variable. So there is only one $Body variable, and all the other parts are appended to that one. The "\n" means to place a hard return between these lines in the email message. If the "\n" weren't included, all the items would be run together on one long line.

// This is the sendmail function which send an email message from the server to the email address listed in the $EmailTo variable above.

// $success = mail($EmailTo, $Subject, $Body, "From: <$EmailFrom>");

// If the page validates and there are no errors in the PHP, this line redirect to ok.html page, which is the "success page" for the form submission.

if ($success){
  print "<meta http-equiv=\"refresh\" content=\"0;URL=ok.html\">";
}
else{
  print "<meta http-equiv=\"refresh\" content=\"0;URL=error.html\">";
}

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