<? php

$servername = "localhost";
$username = "XXXX";
$password = "XXXXX";
$dbname = "kpandowe_cas222";
$users_name = $_POST['fullName'];
$users_email = $_POST['email'];
$users_role = $_POST['role'];
$users_comments= $_POST['comments'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error)   {
    die("Connection failed: " . $conn->connect_error);
}

$sql="
    INSERT INTO 'kpandowe_cas222'.'contact' ('id', 'fullName', 'email', ' comments', 'time_stamp') VALUES (NULL, '$users_name', '$users_email', '$users_role', '$users_comments', CURRENT_TIMESTAMP);";

if ($conn.>query($sql) === TRUE) {
    echo "New record created successfully";
}
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

?>