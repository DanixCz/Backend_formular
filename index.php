<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "backend_formular";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['Name'] ?? '');
    $address = trim($_POST['address'] ?? '');

    if ($name === '' || $address === '') {
        header('Location: index.php?saved=0');
        exit;
    }

    $n = mysqli_real_escape_string($conn, $name);
    $a = mysqli_real_escape_string($conn, $address);
    $sql = "INSERT INTO submissions (name,address) VALUES ('$n','$a')";
    if (mysqli_query($conn, $sql)) {
        $id = mysqli_insert_id($conn);
        header('Location: index.php?saved=1&id=' . $id);
        exit;
    }

    header('Location: index.php?saved=0');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>

<!--
https://www.geeksforgeeks.org/php/how-to-insert-form-data-into-database-using-php/
https://www.w3schools.com/html/html_form_attributes.asp
https://www.w3schools.com/php/php_forms.asp
https://www.w3schools.com/php/php_form_validation.asp
https://www.w3schools.com/php/php_form_required.asp

-->
</head>
<body>
    <main>
        <div class="center">
        <form id="mainForm" action="" method="POST">
            <!-- First Name input -->
            První a Poslení Jméno:
            <input name="Name" required type="text"/>
            <br/><br/>

            <!-- Address input -->
            Komentář:
            <textarea name="address" required></textarea>
            <br/><br/>

            <!-- Submit button -->
            <input type="submit" value="Submit"/>
        </form>

        <div id="submissions" aria-live="polite">
        <?php
        $res = mysqli_query($conn, "SELECT id,name,address,created_at FROM submissions ORDER BY created_at DESC");
        if ($res && mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                echo '<div class="submitted">';
                echo '<form class="cloned-form">';
                echo '<label>První a Poslení Jméno:</label>';
                echo '<input type="text" value="' . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . '" disabled />';
                echo '<label>Komentář:</label>';
                echo '<textarea disabled>' . htmlspecialchars($row['address'], ENT_QUOTES, 'UTF-8') . '</textarea>';
                echo '</form>';
                echo '<div class="saved-meta">Saved at ' . htmlspecialchars($row['created_at'], ENT_QUOTES, 'UTF-8') . '</div>';
                echo '</div>';
            }
        } else {
            echo '<div class="submitted">Žádné záznamy k zobrazení.</div>';
        }
        ?>
        </div>
        </div>
    </main>
</body>
</html>