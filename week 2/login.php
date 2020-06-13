<?php
require_once "pdo.php";

if (isset($_POST['cancel']))
{
    // Redirect the browser to autos.php
    header("Location: index.php");
    return;
}

$salt = 'XyZzy12*_';
$stored_hash = hash('md5', 'XyZzy12*_php123');;  // Password is php123
$failure = false;  // If we have no POST data

// Check to see if we have some POST data, if we do process it
if (isset($_POST['who']) && isset($_POST['pass']))
{
    if (strlen($_POST['who']) < 1 || strlen($_POST['pass']) < 1)
    {
        $failure = "User name and password are required";
    }
    else if (strpos($_POST['who'], "@") === false)
    {
        $failure = "Email must have an at-sign (@)";
    }
    else
    {
        $check = hash('md5', $salt . $_POST['pass']);
        if ($check == $stored_hash)
        {
            error_log("Login success ".$_POST['who']);
            // Redirect the browser to Autos.php
            header("Location: autos.php?name=".urlencode($_POST['who']));
            return;
        }
        else
        {
            $failure = "Incorrect password";
            error_log("Login fail ".$_POST['who']." $check");
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <?php require_once "bootstrap.php"; ?>
    <title>Ambika Patidar (437aadef)'s Login Page</title>
</head>
<body>
<div class="container">
    <h1>Please Log In</h1>
    <?php
    if ($failure !== false)
    {
        echo('<p style="color: red;">' . htmlentities($failure) . "</p>\n");
    }
    ?>
    <form method="POST">
        <label for="nam">User Name</label>
        <input type="text" name="who" id="nam"><br/>
        <label for="id_1723">Password</label>
        <input type="text" name="pass" id="id_1723"><br/>
        <input type="submit" value="Log In">
        <input type="submit" name="cancel" value="Cancel">
    </form>
    <p>
        For a password hint, view source and find a password hint
        in the HTML comments.
        <!-- Hint: The password is the four character sound a cat
        makes (all lower case) followed by 123. -->
    </p>
</div>
</body>
