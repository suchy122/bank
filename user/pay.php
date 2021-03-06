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

                    <h1>Przelew bankowy</h2>
                        <form method="POST" action="pay2.php" id="from"><br>
                            <input type="text" name="konto_z" id="konto_z" value="<?php echo $_SESSION['Nr_konta']; ?>"
                                class="form-control" disabled /><br>
                            <input type="text" name="nazwa_odbiorcy" id="nazwa_odbiorcy" placeholder="Nazwa odbiorcy"
                                class="form-control" /><br>
                            <input type="text" name="konto_do" id="konto_do" placeholder="Rachunek odbiorcy"
                                maxlength="26" minlength="26" class="form-control" /><br>
                            <input type="text" name="kwota" id="kwota" placeholder="Kwota" class="form-control" /><br>
                            <input type="text" name="tytul" id="tytul" placeholder="Tytuł przelewu"
                                class="form-control" /><br>
                            <input type="date" name="data" id="data" placeholder="Data przelewu"
                                class="form-control" /><br>
                            <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Wyślij"
                                name="wyslij" />
                        </form>
                        <?php
                            if(isset($_SESSION['pay_error'])){ 
                                echo $_SESSION['pay_error'];
                            }
                ?>
                </center>
            </div>
        </div>
    </div>
</body>

</html>