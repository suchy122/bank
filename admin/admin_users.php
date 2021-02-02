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

    if($con->connect_errno!=0)
    {
        echo "Error: ".$con->connect_errno;
    }

    function getAll($con){
		$query = "SELECT * from users ORDER BY id ASC";
		$result = mysqli_query($con, $query);
		if(!$result){
			echo "Nie znaleziono danych " . mysqli_error($con);
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
                <p class="lead"><br><a href="admin_add_user.php" class="btn btn-success"><i
                            class="fas fa-plus-circle"></i> Dodaj nowego klienta</a></p>

                <table class="table" style="margin-top: 20px">
                    <tr>
                        <th>ID</th>
                        <th>Imie</th>
                        <th>Nazwisko</th>
                        <th>Email</th>
                        <th>PESEL</th>
                        <th>Nr_konta</th>
                        <th>Stan_konta</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>
                    <?php while($row = mysqli_fetch_assoc($result)){ ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['imie']; ?></td>
                        <td><?php echo $row['nazwisko']; ?></td>
                        <td><?php echo $row['email']; ?></td>

                        <td><?php echo $row['PESEL']; ?></td>
                        <td><?php echo $row['Nr_konta']; ?></td>
                        <td><?php echo $row['Stan_konta']; ?></td>
                        <td><a href="admin_edit_user.php?id=<?php echo $row['id']; ?>">
                                <i class="fas fa-edit" style="color: orange" ;></i>
                            </a></td>
                        <td><a href="admin_delete_user.php?id=<?php echo $row['id']; ?>">
                                <i class="fas fa-trash-alt" style="color:black" ;> </i>
                            </a></td>
                    </tr>
                    <?php } ?>
                </table>

                <a href="index.php" class="btn btn-primary"><i class="fas fa-backward"></i>
                    Powrót</a><br><br><br>
            </div>
        </div>
        <?php
	        if(isset($conn)) {mysqli_close($conn);}
        ?>
</body>

</html>