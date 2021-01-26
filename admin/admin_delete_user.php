<?php
	$id = $_GET['id'];

	include_once("../database/connect.php");
    $con = @new mysqli($host,$db_user,$db_password,$db_name);

    if($con->connect_errno!=0)
    {
        echo "Error: ".$con->connect_errno;
    }

	$query = "DELETE FROM users WHERE id = '$id'";
	$result = mysqli_query($con, $query);
	if(!$result){
		echo "Nie udało się usunąć danych! " . mysqli_error($con);
		exit;
	}
	header("Location: admin_users.php");
?>