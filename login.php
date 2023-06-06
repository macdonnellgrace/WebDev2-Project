<?php 
session_start();
require_once "database.php";
unset($_SESSION["account"]);

# Checks when user has entered account info
if ( isset($_POST["account"]) && isset($_POST["pw"]) )

    {
        # separate queries to database

        $u = $conn -> real_escape_string($_POST['account']);
        $sql = "SELECT username FROM user WHERE username ='$u'";
        $result1 = $conn->query($sql);

        $p = $conn -> real_escape_string($_POST['pw']);
        $sql = "SELECT username FROM user WHERE password ='$p'";
        $result2 = $conn->query($sql);

        if ((mysqli_num_rows($result1) === 1)) #if username is correct
        {
            if  (mysqli_num_rows($result2) === 1) #if pw is correct
            {   $_SESSION["account"] = $_POST["account"];
                $_SESSION["success"] = "Logged in.";
                header( "Location: index.php") ;
                return;
            } 
        }
    else 
        {
            $_SESSION["error"] = "Incorrect username or password.";
            header( 'Location: login.php' ) ;
            return;
        } 
    } 
else if ( count($_POST) > 0 )
    { 
        $_SESSION["error"] = "Missing Required Information";
        header( 'Location: login.php' ) ;
        return;
    }
?>

<html>
<head>
<meta charset="utf-8" />

<title>TU Library</title>
<link rel="stylesheet" type="text/css" href="Assets/CSS/style.css">
</head>
<body style="font-family: sans-serif;">
<main>
<h1>Please Log In</h1>

<!-- Error messages displayed if user logs in correctly/ incorrectly -->
<?php
if ( isset($_SESSION["error"]) ) {
    echo('<p style="color:red">Error:'.$_SESSION["error"]."</p>\n");
    unset($_SESSION["error"]);
}
if ( isset($_SESSION["success"]) ) {
    echo('<p style="color:green">'.$_SESSION["success"]."</p>\n");
    unset($_SESSION["success"]);
}

?>

<!-- Form for login -->

<form method="post">
<p>Account: <input type="text" name="account" value=""></p>
<p>Password: <input type="password" name="pw" value=""></p>

<p><input type="submit" value="Log In"></p>
<P> Not a member? <a href="register.php">Sign up</a></p>
</form>
</main>
</body>
<footer> 
    TU Dublin Library Services 2022
</footer>
</html>