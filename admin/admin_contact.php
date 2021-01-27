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

    require_once "../database/connect.php";
    $con = new mysqli($host,$db_user,$db_password,$db_name);

    function getAll($con){
        $query = "SELECT * FROM contact ORDER BY id ASC";
        $result = mysqli_query($con,$query);
        if($result){
            return $result;
        } else {
            echo "Nie znaleziono danych ".mysqli_error($con);
            exit;
        }
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

                <table class="table" style="margin-top: 20px">
                    <tr>
                        <th>ID</th>
                        <th>Imie</th>
                        <th>Nazwisko</th>
                        <th>Email</th>
                        <th>Wiadomość</th>
                    </tr>
                    <?php while($row = mysqli_fetch_assoc($result)){ ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['imie']; ?></td>
                        <td><?php echo $row['nazwisko']; ?></td>
                        <td><?php echo $row['email']; ?></td>

                        <td><?php echo $row['message']; ?></td>
                    </tr>
                    <?php } ?>
                </table><br><br>
                <a href="index.php" class="btn btn-primary"><i class="fas fa-backward"></i> Powrót</a>
            </div>
        </div>
    </div>
</body>

</html>