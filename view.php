<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />

    <title>Reserved books</title>
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
        <h1>View reserved books</h1>
    </header>
    <main>
        <!-- CONTENT START -->
        <?php
    session_start();
    require_once "database.php";

    # checks for login
    if ( !isset($_SESSION["account"]) ) 
        { ?>
        Please <a href="login.php">Log In</a> to start.
        <?php 
        }
        else { ?>

        <section>
            <h1>Here are your reserved books ...</h1>

            <?php
            require_once "database.php";   
        
            $u = $conn -> real_escape_string($_SESSION['account']);

            # gets books where username is logged in user
            $sql = "SELECT books.IBSN, bookTitle, author, reserved, reservedDate 
            FROM books
            JOIN reservations 
            ON books.IBSN  = reservations.IBSN 
            WHERE reservations.username = '$u'";

            $result = $conn->query($sql);
        
            if ($result->num_rows > 0) 
            {
                echo "<table border='1'>";
                echo "<tr><td><h2> Book Title </h2></td><td><h2>Author</h2></td><td><h2>Reserve date</h2></td><td><p> End this reservation </hp></td></tr> ";

                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>";
                    echo (htmlentities($row["bookTitle"]));
                    echo ("    </td><td>");
                    echo (htmlentities($row["author"]));
                    echo ("    </td><td>");
                    echo (htmlentities($row["reservedDate"]));
                    echo ("    </td><td>");
                    echo ('<a href="remove.php?ibsn='.htmlentities($row["IBSN"]).'"> End </a>');
                    echo ("    </td></tr>");
                    
                }
            }
            else {
                    echo "0 results";  
                }
        ?>
        </section>
        <!-- CONTENT END -->
        <?php } ?>
        </main>
</body> 
