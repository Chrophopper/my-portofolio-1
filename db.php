<?php
$servername = "localhost";
$username = "username";
$password = "";
$dbname = "my_contact";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<?php
include 'db_connection.php'; // Include the database connection file

$sql = "SELECT Contacts.name, Contacts.email, Contacts.phone, Contacts.telegram, Contact_Methods.method_type, Contact_Methods.method_value, Contact_Methods.link 
        FROM Contacts 
        JOIN Contact_Methods ON Contacts.id = Contact_Methods.contact_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<div class='contact__card'>";
        echo "<h3 class='contact__card-title'>" . $row["method_type"] . "</h3>";
        echo "<span class='contact__card-data'>" . $row["method_value"] . "</span>";
        echo "<a href='" . $row["link"] . "' target='_blank' class='contact__button'> Write me <i class='bx bx-right-arrow-alt contact__button-icon'></i> </a>";
        echo "</div>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
