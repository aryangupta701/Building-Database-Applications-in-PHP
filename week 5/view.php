<?php
session_start();
require_once "pdo.php";
if ( ! isset($_SESSION['name']) )
{
    die('Not logged in');
}
$stmt = $pdo->query("SELECT make, year, mileage FROM autos");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html>
<head>
<title>Ambika Patidar's Login Page</title>

<?php require_once "bootstrap.php"; ?>

</head>
<<body>
<div class="container">

    <h1>Tracking Autos for <?php echo $_SESSION['name']; ?></h1>

    <?php
    if ( isset($_SESSION['success']) )
    {
    echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
    unset($_SESSION['success']);
    }
    ?>
    <h2>Automobiles</h2>
    <ul>

        <?php
        foreach ($rows as $row)
        {
            echo '<li>';
            echo htmlentities($row['make']) . ' ' . $row['year'] . ' / ' . $row['mileage'];
        };
        echo '</li><br/>';
        ?>
    </ul>
    <p>
        <a href="add.php">Add New</a> |
        <a href="logout.php">Logout</a>

For a password hint, view source and find an account and password hint
in the HTML comments.
<!-- Hint:
The account is csev@umich.edu
The password is the three character name of the
programming language used in this class (all lower case)
followed by 123. -->
</p>
</div>
</body>
</html>
