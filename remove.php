<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Delete reservation</title>
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
        <h1>Delete reservation</h1>
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
    if (isset($_POST['id'])) {
        # Updates information in the books table
        $id = $conn -> real_escape_string($_GET['ibsn']);
        $sql = "UPDATE books SET reserved= '0' WHERE IBSN= '$id'";
        $conn->query($sql);

        # deletes reservation from the table
        $sql2 = "DELETE FROM reservations WHERE IBSN = '$id'";
        $conn->query($sql2);
        echo '<h2> Reservation removed </h2> <br> <a href="index.php">Back to home...</a>';

        return;
    }

    $id = $conn -> real_escape_string($_GET['ibsn']);
    $sql = "SELECT bookTitle, author, IBSN FROM books WHERE IBSN='$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $n = htmlentities($row["bookTitle"]);
    $a = htmlentities($row["author"]);
    $id = htmlentities($row["IBSN"]);

    # displays confirmation message to user
    echo <<< _END
        <h3>Confirm reservation</h3>
        <form method="post">
            <p>Are you sure you want to remove your reservation for "$n" by $a ?
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