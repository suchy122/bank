<?php
    
session_start();

if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == "admin")){
    header('Location: ../admin/index.php');
    exit();
} elseif((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == "user")){
    header('Location: ../user/index.php');
    exit();
} 

if((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
{
    header('Location: ../index.php');
    exit();
}

require_once "../database/connect.php";

$conn = @new mysqli($host,$db_user,$db_password,$db_name);

if($conn->connect_errno!=0)
{
    echo "Error".$conn->connect_errno;
}
else
{
    $login = $_POST['login'];
    $haslo = $_POST['haslo'];
    
    $login = htmlentities($login,ENT_QUOTES, "UTF-8");
    
    if($result = @$conn->query(sprintf("SELECT * FROM users WHERE login='%s'",mysqli_real_escape_string($conn,$login))))
    {
        if($result->num_rows==1)
        {
            $tab=$result->fetch_assoc();
            
            if(password_verify($haslo,$tab['password']))
            {
                $_SESSION['zalogowany']="user";
                $_SESSION['id'] = $tab['id'];
                $_SESSION['login'] = $tab['login'];
                $_SESSION['imie'] = $tab['imie'];
                $_SESSION['nazwisko'] = $tab['nazwisko'];
                $_SESSION['email'] = $tab['email'];
                $_SESSION['PESEL'] = $tab['PESEL'];
                $_SESSION['Nr_konta'] = $tab['Nr_konta'];
                $_SESSION['Stan_konta'] = $tab['Stan_konta'];
                unset($_SESSION['blad']);
                $result->free_result();
                header('Location: ../user/index.php');
            }else {
                $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
                header('Location: login.php');
            }
        } elseif($result = @$conn->query(sprintf("SELECT * FROM admin WHERE login='%s'",mysqli_real_escape_string($conn,$login)))){
            if($result->num_rows==1){
                $tab=$result->fetch_assoc();

                if(password_verify($haslo,$tab['haslo']))
                {
                $_SESSION['zalogowany']="admin";
                $_SESSION['id'] = $tab['id'];
                $_SESSION['login'] = $tab['login'];
                unset($_SESSION['blad']);
                $result->free_result();
                if($login=='admin')
                header('Location: ../admin/index.php');
                }else {
                    $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
                    header('Location: login.php');
                }
            }else {
                $_SESSION['zalogowany'] = false;
                $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
                header('Location: login.php');
                }
            }
        }
    
    $conn->close();
}
?>