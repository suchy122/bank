<?php
    include_once("head.php");
    session_start();
    if(!isset($_SESSION['zalogowany'])){
        header('Location: ../index.php');
        exit();
    } elseif(($_SESSION['zalogowany'] == "user")){
        header('Location: ../user/index.php');
        exit();
    }
?>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">Bank</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" style="color:white;"><b><?php echo "Witaj: ".$_SESSION['login'];?></b></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Wyloguj</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="wrapper">
            <div class="jumbotron">
                <center>
                    <h1>Panel admina</h1>
                    <a button type="button" class="btn btn-secondary btn-lg btn-block"
                        href="admin_users.php">Klienci</a><br>
                    <a button type="button" class="btn btn-secondary btn-lg btn-block"
                        href="admin_contact.php">Kontakt</a><br>
                </center>
            </div>
        </div>
    </div>
</body>

</html>