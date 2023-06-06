<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>TU Library</title>
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
        <h1>TU Library</h1>
    </header>

    <main>
    <?php
    session_start();
    require_once "database.php";

    # Checks if user is logged in
    if ( !isset($_SESSION["account"]) ) 
        { ?>
        Please <a href="login.php">Log In</a> to start.
        <?php 
        }
        else { 
        $name = isset($_SESSION["account"]) ? $_SESSION["account"] : '';
        ?>

        <!-- CONTENT START -->

        <section class="textWithImage">
            <h1>Welcome back, <?php echo(htmlentities($name)); ?></h1>
            <img src="Assets/Images/table.jpg">
            <p>
            Family Time at your Library activities are provided to engage family members in the enjoyment of reading and sharing stories. The whole family are also introduced to collections of children’s books, e-books and e-audio books. <br><br>

            The Family Time at your Library events aim to support a family-focused approach to reading with children as part of the national Right to Read programme and to increase awareness of the benefits of reading and promote reading as a fun, recreational activity for children.
            Contact your local library service for details of family events and activities this December. 
            </p>
        </section>



        <section>
            <h2> Library News</h2>
            <p>
            dlr Libraries are delighted to announce an opportunity for authors, artists, musicians, climate action educators, STEAM practitioners, and other facilitators to submit proposals for our events programme for 2023-2025.<br>
                
            Events can encompass workshops, talks, courses, shows, productions, classes, exhibitions and any other creative enterprises envisioned as a possibility within a public library context. This includes programming in-person as well as virtual or hybrid events. Venues will be dlr Library spaces in the main, but will also include outreach locations, such as schools, community centres, day and long-term care settings and public outdoor spaces in the County.
            </p>

            <h3> Our new library </h3>
            <img src="Assets/Images/newlib.jpg">
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Voluptatibus nostrum laborum nemo iusto atque corrupti animi ipsum, quidem, quo similique, minus
                repellendus nulla reprehenderit dignissimos assumenda adipisci commodi esse officia. <br>
                
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam veniam eos eveniet voluptatem quo
                adipisci distinctio inventore temporibus omnis, animi sequi officiis est sapiente quas recusandae nihil
                aliquam error possimus!
            </p>

            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Voluptatibus nostrum laborum nemo iusto atque corrupti animi ipsum, quidem, quo similique, minus
                repellendus nulla reprehenderit dignissimos assumenda adipisci commodi esse officia. <br>
                
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam veniam eos eveniet voluptatem quo
                adipisci distinctio inventore temporibus omnis, animi sequi officiis est sapiente quas recusandae nihil
                aliquam error possimus!
            </p>

        </section>

        <!-- CONTENT END -->

        <?php } ?>
    </main>

</body>
<footer> 
TU Dublin Library Services 2022
</footer>
</html>