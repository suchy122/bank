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

    include_once("../database/connect.php");
    $con = @new mysqli($host,$db_user,$db_password,$db_name);

    if(isset($_GET['id'])){
		$user_id = $_GET['id'];
	} else {
		echo "Empty query!";
		exit;
	}

	if(!isset($user_id)){
		echo "Empty id! check again!";
		exit;
	}

    $query = "SELECT * FROM users WHERE id = '$user_id'";
	$result = mysqli_query($con, $query);
	if(!$result){
		echo "Nie znaleziono danych " . mysqli_error($con);
		exit;
	}
	$row = mysqli_fetch_assoc($result);
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
                <form method="post" action="edit_users.php" enctype="multipart/form-data">
                    <table class="table">
                        <tr>
                            <th>ID</th>
                            <td><input type="text" name="id" value="<?php echo $row['id'];?>" readOnly="true"></td>
                        </tr>
                        <tr>
                            <th>Login</th>
                            <td><input type="text" name="login" value="<?php echo $row['login'];?>" required></td>
                        </tr>
                        <tr>
                            <th>Hasło</th>
                            <td><input type="password" name="password" placeholder="Podaj aktulano/nowe hasło" required></td>
                        </tr>
                        <tr>
                            <th>Imie</th>
                            <td><input type="text" name="imie" value="<?php echo $row['imie'];?>" required></td>
                        </tr>
                        <tr>
                            <th>Nazwisko</th>
                            <td><input type="text" name="nazwisko" value="<?php echo $row['nazwisko']; ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><input type="text" name="email" value="<?php echo $row['email'];?>" required></td>
                        </tr>
                        <tr>
                            <th>PESEL</th>
                            <td><input type="text" name="PESEL" value="<?php echo $row['PESEL'];?>" readOnly="true"></td>
                        </tr>
                        <tr>
                            <th>Nr konta</th>
                            <td><input type="text" name="Nr_konta" value="<?php echo $row['Nr_konta'];?>" readOnly="true"></td>
                        </tr>
                        <tr>
                            <th>Stan konta</th>
                            <td><input type="text" name="Stan_konta" value="<?php echo $row['Stan_konta'];?>" required>
                            </td>
                        </tr>
                    </table>
                    <input type="submit" name="save_change" value="Zapisz" class="btn btn-success">

                    <input type="reset" value="Cofnij zmiany" class="btn btn-danger">
                </form>
                <br />
                <a href="admin_users.php" class="btn btn-primary"><i class="fas fa-backward"></i> Powrót</a>
            </div>
        </div>
        <?php
	        if(isset($conn)) {mysqli_close($conn);}
        ?>
    </div>
</body>

</html>