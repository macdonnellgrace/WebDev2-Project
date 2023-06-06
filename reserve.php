<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Reserve a book</title>
    <link rel="stylesheet" type="text/css" href="Assets/CSS/style.css">
</head>

<body>
    <header>
        <div id="navbar">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="search.php">Search for book</a></li>
                <li><a href="view.php">View reserved books</a></li>
                <a href="logout.php">Log out</a>
            </ul>
        </div>
        <h1>Reserve a book</h1>
    </header>

    <main>
        <?php
        session_start();
        require_once "database.php";
    
        if ( !isset($_SESSION["account"]) ) 
            { ?>
            Please <a href="login.php">Log In</a> to start.
            <?php 
            }
            else { ?>
        <!-- CONTENT START -->

        <section>
        <?php
        # section for updating the book table and inserting a reservation into the table
    if (isset($_POST['id'])) {
        $id = $conn -> real_escape_string($_GET['ibsn']);
        $sql = "UPDATE books SET reserved= '1' WHERE IBSN= '$id'";
        $conn->query($sql);

        $n = $_SESSION["account"];
        $d = date("Y/m/d");

        $sql2 = "INSERT INTO reservations (IBSN, username, reservedDate) VALUES ('$id', '$n', '$d')";
        $conn->query($sql2);
        echo '<h2> Successfully reserved! </h2><br>
        <a href="view.php">Make another reservation </a><br><br>
        <a href="index.php">Back to home...</a>
         ';

        return;
    }

    $id = $conn -> real_escape_string($_GET['ibsn']);
    $sql = "SELECT bookTitle, author, IBSN FROM books WHERE IBSN='$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $n = htmlentities($row["bookTitle"]);
    $a = htmlentities($row["author"]);
    $id = htmlentities($row["IBSN"]);

    echo <<< _END
        <h3>Confirm reservation</h3>
        <form method="post">
            <p>Are you sure you want to reserve "$n" by $a ?
            </p>
            <input type="hidden" name="id" value="$id">
            <p><input type="submit" value="Yes, I'm sure"/>
                <a href="index.php">Cancel</a></p>
        </form>
    _END
?>
        </section>
        <!-- CONTENT END -->
        <?php } ?>
    </main>

</body>
<footer> 
        TU Dublin Library Services 2022
</footer>