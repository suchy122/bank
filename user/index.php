<?php
    include_once("head.php");
    session_start();
    if(!isset($_SESSION['zalogowany'])){
        header('Location: ../index.php');
        exit();
    } elseif(($_SESSION['zalogowany'] == "admin")){
        header('Location: ../admin/index.php');
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
                        <a class="nav-link"
                            style="color:white;"><b><?php echo "Witaj: ".$_SESSION['imie']." ".$_SESSION['nazwisko'];?></b></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Kontakt</a>
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
                    <h1>Panel klienta</h1>
                    <table class="table" style="margin-top: 20px">
                        <tr>
                            <th>Imie</th>
                            <th>Nazwisko</th>
                            <th>Email</th>
                            <th>PESEL</th>
                            <th>Nr_konta</th>
                            <th>Stan_konta</th>
                        </tr>
                        <tr>
                            <td><?php echo $_SESSION['imie']; ?></td>
                            <td><?php echo $_SESSION['nazwisko']; ?></td>
                            <td><?php echo $_SESSION['email']; ?></td>
                            <td><?php echo $_SESSION['PESEL']; ?></td>
                            <td><?php echo $_SESSION['Nr_konta']; ?></td>
                            <td><?php echo $_SESSION['Stan_konta']; ?></td>
                        </tr>
                    </table>
                    <form action="pay.php">
                        <input type="submit" class="btn btn-primary" value="Przelew">
                    </form>
                </center>
            </div>
        </div>
    </div>
</body>

</html>