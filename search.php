<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Search</title>
    <link rel="stylesheet" type="text/css" href="Assets/CSS/style.css">

</head>
<!-- Navigation bar at top of the page -->
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
        <h1>Search for a book</h1>
    </header>
    <main>
        <!-- Checks if user is logged in before continuing-->
        <?php
        session_start();
        require_once "database.php";
    
        if ( !isset($_SESSION["account"]) ) 
            { ?>
            Please <a href="login.php">Log In</a> to start.
            <?php 
            }
            else { 
                
                # when user has submitted a search
                if (isset($_POST['name']) && isset($_POST['author']) && isset($_POST['cat'])){
                    
                # TITLE
                if ($_POST['name'] != "" ) 
                {
                    $n = $conn -> real_escape_string($_POST['name']);

                    # queries database
                    $sql1 = "SELECT IBSN, bookTitle, author, edition, year, reserved from books WHERE bookTitle LIKE '%$n%'";
                    $result1 = $conn->query($sql1);
                    
                    # displays table
                    if ($result1->num_rows > 0) 
                    {
                        echo "<table border='1'>";
                        echo "<tr><td><h2>Book Title </h2></td><td><h2>Author </h2></td><td><h2>Edition </h2></td><td><h2>Year </h2></td><td>Availability</td> </tr> ";
                  
                        while($row = $result1->fetch_assoc()) 
                        {
                            echo "<tr><td>";
                            echo (htmlentities($row["bookTitle"]));
                            echo ("    </td><td>");
                            echo (htmlentities($row["author"]));
                            echo ("    </td><td>");
                            echo (htmlentities($row["edition"]));
                            echo ("    </td><td>");
                            echo (htmlentities($row["year"]));
                            echo ("    </td><td>");

                            if (htmlentities($row["reserved"]) == 0)
                            {
                            echo ('<a href="reserve.php?ibsn='.htmlentities($row["IBSN"]).'"> Reserve </a>');
                            }
                            else {
                                echo("Already reserved");
                            }
                        } 
                        return;
                    }
                    else {
                        echo "0 results";
                    }
                    return;
                }

                # author 
                else if ($_POST['author'] != "" ) 
                {
                    $a = $conn -> real_escape_string($_POST['author']);
                    
                    $sql2 = "SELECT IBSN, bookTitle, author, edition, year, reserved from books WHERE author LIKE '%$a%'";
                    $result2 = $conn->query($sql2);
                    
                    if ($result2->num_rows > 0) 
                    {
                        echo "<table border='1'>";
                        echo "<tr><td><h2>Book Title </h2></td><td><h2>Author </h2></td><td><h2>Edition </h2></td><td><h2>Year </h2></td><td>Availability</td> </tr> ";
                  
                        while($row = $result2->fetch_assoc()) 
                        {
                            echo "<tr><td>";
                            echo (htmlentities($row["bookTitle"]));
                            echo ("    </td><td>");
                            echo (htmlentities($row["author"]));
                            echo ("    </td><td>");
                            echo (htmlentities($row["edition"]));
                            echo ("    </td><td>");
                            echo (htmlentities($row["year"]));
                            echo ("    </td><td>");

                            if (htmlentities($row["reserved"]) == 0)
                            {
                            echo ('<a href="reserve.php?ibsn='.htmlentities($row["IBSN"]).'"> Reserve </a>');
                            }
                            else {
                                echo("Already reserved");
                            }
                          
                        } 
                        return;
                    }
                    else {
                        echo "0 results";
                    }
                    return;
                }
                # repeats for each type of search submitted
                # CAT
                else if ( $_POST['cat'] != "")
                {
                    $c = $conn -> real_escape_string($_POST['cat']);
                    $sql3 = "SELECT IBSN, bookTitle, author, edition, year, reserved, category from books WHERE category = '$c'";
                    $result3 = $conn->query($sql3);
                    
                    if ($result3->num_rows > 0) 
                    {
                        echo "<table border='1'>";
                        echo "<tr><td><h2>Book Title </h2></td><td><h2>Author </h2></td><td><h2>Edition </h2></td><td><h2>Year </h2></td><td>Availability</td> </tr> ";
                  
                        while($row = $result3->fetch_assoc()) 
                        {
                            echo "<tr><td>";
                            echo (htmlentities($row["bookTitle"]));
                            echo ("    </td><td>");
                            echo (htmlentities($row["author"]));
                            echo ("    </td><td>");
                            echo (htmlentities($row["edition"]));
                            echo ("    </td><td>");
                            echo (htmlentities($row["year"]));
                            echo ("    </td><td>");

                            if (htmlentities($row["reserved"]) == 0)
                            {
                            echo ('<a href="reserve.php?ibsn='.htmlentities($row["IBSN"]).'"> Reserve </a>');
                            }
                            else {
                                echo("Already reserved");
                            } 
                        } 
                    }
                    else {
                        echo "0 results";
                    }
                    return;
                }
            }
            echo "</tr></td>";
            ?>
        <!-- CONTENT START -->

        <section>

            <!-- Form for searching -->
            <form method="post">

            <h2>Search by name:</h2>
            <input type="text" name="name">
            <h2>Search by author:</h2>
            <input type="text" name="author">
            
            <h2>Search by category:</h2>
            <select name="cat" id="form">
            <?php 

            $sqlSearch = "SELECT categoryID, categoryDescription from category";
            $resultSearch = $conn->query($sqlSearch);
            if ($resultSearch->num_rows > 0) 
                {
                    echo("<option value='-1'>--Select a Category--</option>");
                    while($row = $resultSearch->fetch_assoc())  
                    {
                        $cat = htmlentities($row["categoryDescription"]);
                        $caTID = htmlentities($row["categoryID"]);
                        echo ("<option value = '$caTID' >$cat</option>");
                    }
                }
            ?>
            </select>
            <input type="submit" value="Go!">
            </form>
        </section>
        <!-- CONTENT END -->
        <?php } ?>
    </main>
</body>
<footer> 
        TU Dublin Library Services 2022
    </footer>