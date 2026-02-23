<?php
$servername = "localhost";
$username = "root"; 
$password = "root"; 
$dbname = "backend_formular"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <main>
        <div class="center">
        <h2>Storing Form Data in Database</h2>
        <form action="insert.php" method="POST">
            <!-- First Name input -->
            First Name:
            <input name="first_name" required type="text"/>
            <br/><br/>

            <!-- Last Name input -->
            Last Name:
            <input name="last_name" required type="text"/>
            <br/><br/>

            <!-- Address input -->
            Address:
            <textarea name="address" required></textarea>
            <br/><br/>

            <!-- Submit button -->
            <input type="submit" value="Submit"/>
        </form>
        </div>
    </main>
</body>
</html>