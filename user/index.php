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

    require_once "../database/connect.php";

    $con = @new mysqli($host,$db_user,$db_password,$db_name);

    if($con->connect_errno!=0)
    {
        echo "Error".$con->connect_errno;
    }

    function getAll($con){
        $konto = $_SESSION['Nr_konta'];
        $query = "SELECT * FROM payments WHERE konto_z = $konto";
        $result = mysqli_query($con, $query);
        if(!$result) {
            echo "Nie znaleziono danych " .mysqli_error($con);
            exit;
        }
        return $result;
    }

    $result = getAll($con);
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
                    </form><br><br>

                    <h1>Historia tranzakcji</h1>
                    <table class="table" style="margin-top: 20px">
                        <tr>
                            <th>Nazwa odbiorcy</th>
                            <th>Numer konta odbiorcy</th>
                            <th>Kwota</th>
                            <th>Data przelewu</th>
                            <th>Status przelewu</th>
                        </tr>
                        <?php while($row = mysqli_fetch_assoc($result)){ ?>
                        <tr>
                            <td><?php echo $row['nazwa_odbiorcy']; ?></td>
                            <td><?php echo $row['konto_do']; ?></td>
                            <td><?php echo $row['kwota']; ?> zł</td>
                            <td><?php echo $row['tytul']; ?></td>
                            <td><?php echo $row['data']; ?></td>
                            <td><?php if($row['status'] == 1){ echo "Oczekujący";}
                            elseif ($row['status'] == 2){ echo "Zaakceptowany";}
                            elseif ($row['status'] == 3){ echo "Odrzucony";}?></td>
                        </tr>
                        <?php } ?>
                    </table>
                </center>
            </div>
        </div>
    </div>
</body>

</html>