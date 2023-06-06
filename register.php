<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />

    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="Assets/CSS/style.css">

</head>

<body>
    <header>
    <h1>Join TU Library</h1>
    </header>

    <main>
<?php
session_start();
    require_once "database.php";
    
    # submits all info into database 
    
    if ( isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['username'])
        && isset($_POST['addr1']) && isset($_POST['city']) && isset($_POST['telephone'])
        && isset($_POST['mobile']) && isset($_POST['password'])
        ) 
    {

        $f = $conn -> real_escape_string($_POST['fname']);
        $l = $conn -> real_escape_string($_POST['lname']);
        $u = $conn -> real_escape_string($_POST['username']);
        $a1 = $conn -> real_escape_string($_POST['addr1']);
        $a2 = $conn -> real_escape_string($_POST['addr2']);
        $c = $conn -> real_escape_string($_POST['city']);
        $t = $conn -> real_escape_string($_POST['telephone']);
        $m = $conn -> real_escape_string($_POST['mobile']);
        $p = $conn -> real_escape_string($_POST['password']);

        $sql = "INSERT INTO user (username, password, firstName, surname, addressLine1, city, telephone, mobile) VALUES ('$u', '$p', '$f', '$l','$a1', '$c', '$t', '$m')";

        echo "<pre>\n$sql\n</pre>\n";
        $conn->query($sql);
        echo 'Success -> <a href="index.php">continue...</a>';

        return;
    }
?>

<!-- Sign up form -->
<form method="post">
    <p>First name:
        <input type="text" name="fname"></p>
    <p>Last name:
        <input type="text" name="lname"></p>
    <p>Username:
        <input type="text" name="username"></p>
    <p>Address line 1:
        <input type="text" name="addr1"></p>
    <p>Address line 2:
        <input type="text" name="addr2"></p>
    <p>City:
        <input type="text" name="city"></p>
    <p>Telephone:
        <input type="number" name="telephone"></p>
    <p>Mobile:
        <input type="number" name="mobile"></p>
    <p>Password:
        <input type="password" name="password"></p>


    
    <p><input type="submit" value="Submit"/>
    <a href="index.php">Cancel</a></p>
</form>

</section>

<!-- CONTENT END -->


</main>
<footer> 
        TU Dublin Library Services 2022
</footer>

</body>
        