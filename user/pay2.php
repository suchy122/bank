<?php
    session_start();

    if(!isset($_SESSION['zalogowany'])){
        header('Location: ../index.php');
        exit();
    } elseif(($_SESSION['zalogowany'] == "admin")){
        header('Location: ../admin/index.php');
        exit();
    }

    if((!isset($_POST['nazwa_odbiorcy'])) || (!isset($_POST['konto_do']))){
        header('Location: pay.php');
        $_SESSION['pay_error'] = '<span style="color:red">Błąd przelewu!</span>';
        exit();
    }

    require_once "../database/connect.php";

    $con = @new mysqli($host,$db_user,$db_password,$db_name);
    if($con->connect_errno!=0)
    {
        echo "Error".$conn->connect_errno;
    }else {
        $konto_z = $_SESSION['Nr_konta'];
        $nazwa_odbiorcy = $_POST['nazwa_odbiorcy'];
        $konto_do = $_POST['konto_do'];
        $kwota = $_POST['kwota'];
        $tytul = $_POST['tytul'];
        $data = $_POST['data'];
        $status = 1;

        if($kwota>$_SESSION['Stan_konta']){
            $_SESSION['pay_error'] = '<span style="color:red">Nie możesz przelać więcej niż masz!</span>';
            header('Location: pay.php');
        } else {
            unset($_SESSION['pay_error']);
            if($con->query("INSERT INTO payments VALUES ('','$konto_z','$nazwa_odbiorcy','$konto_do','$kwota','$tytul','$data','$status')")){
                $stan_konta = $_SESSION['Stan_konta'] - $kwota;
                unset($_SESSION['Stan_konta']);
                $_SESSION['Stan_konta'] = $stan_konta;
                if($con->query("UPDATE users SET Stan_konta = $stan_konta WHERE Nr_konta=$konto_z")){
                    $con->query("UPDATE users SET Stan_konta =Stan_konta + $kwota WHERE Nr_konta=$konto_do");
                    echo '<script>alert("Przelew udany, oczekuje na akceptacje")</script>';
                    header('Location: index.php');
                }
            }
        }
    }
?>