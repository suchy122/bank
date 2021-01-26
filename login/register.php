<?php
    include_once("head.php");
    session_start();
    if(isset($_POST['login'])){
        $wszystko_ok = true;

        $login = $_POST['login'];
        $haslo = $_POST['haslo'];
        $email = $_POST['email'];
        $imie = $_POST['imie'];
        $nazwisko = $_POST['nazwisko'];
        $pesel = $_POST['pesel'];
        $stan_konta = $_POST['stan_konta'];

        if(ctype_alnum($login)==false){
            $wszystko_ok = false;
            $_SESSION['e_login']="Login może składać się tylko z liter i cyfr (bez polskich znaków)!";
        }

        $haslo_hash = password_hash($haslo,PASSWORD_DEFAULT);
        
        require_once "../database/connect.php";
        mysqli_report(MYSQLI_REPORT_STRICT);

        try{
            $con = new mysqli($host,$db_user,$db_password,$db_name);
            if($conn->connect_errno!=0)
            {
                throw new Exception(mysqli_connect_errno());
            } else {
                $result = $con->query("SELECT id from users WHERE login='$login'");
                $result2 = $con->query("SELECT id from users WHERE email='$email'");

                if(!$result) throw new Exception($conn->error);
                
                if($result->num_rows>0 )
                {
                    $wszystko_ok=false;
                    $_SESSION['e_login']="Już jest taki użytkownik!";  
                }
                
                if($result2->num_rows>0)
                {
                    $wszystko_ok=false;
                    $_SESSION['e_email']="Taki email już jest w bazie!";   
                }

                if($wszystko_ok == true){
                    $NumerPoczatek = "95720693";
                    $NumerDalej = random_int(100000000000000000,999999999999999999);
                    $nr_konta = $NumerPoczatek . $NumerDalej;
                    if($con->query("INSERT INTO users VALUES (NULL,'$login','$haslo_hash','$imie','$nazwisko','$email','$pesel','$nr_konta','$stan_konta')")){
                        $_SESSION['rejestracja']=true;
                        header('Location: login.php');
                    } else {
                        throw new Exception($conn->error);
                    }
                }

                $con->close();
            }
        } catch(Exception $ex) {
            echo '<span style="color:red;">Błąd serwera!</span>';
        }

    }
?>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="../index.php">Bank</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Logowanie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Rejestracja
                        <span class="sr-only">(current)</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="wrapper">
            <div class="jumbotron">
                <h1>Rejestracja</h1>
                <form method="post" role="form">
                    <input type="text" name="login" placeholder="Login" class="form-control" required/>
                    <?php 
                        if(isset($_SESSION['e_login']))
                        {
                            echo '<div style="color:red; margin-top:10px; margin-bottom:10px;">'.$_SESSION['e_login'].'</div>';
                            unset($_SESSION['e_login']);
                        }
                    ?><br>
                    <input type="password" name="haslo" placeholder="Hasło" class="form-control" maxlength="20" minlength="4"required/><br>
                    <input type="email" name="email" placeholder="Email" class="form-control" required/>
                    <?php 
                        if(isset($_SESSION['e_email']))
                        {
                            echo '<div style="color:red; margin-top:10px; margin-bottom:10px;">'.$_SESSION['e_email'].'</div>';
                            unset($_SESSION['e_email']);
                        }
                    ?><br>
                    <input type="text" name="imie" placeholder="Imie" class="form-control" required/><br>
                    <input type="text" name="nazwisko" placeholder="Nazwisko" class="form-control" required/><br>
                    <input type="text" name="pesel" placeholder="PESEL" class="form-control" maxlength="11" minlength="11" required/><br>
                    <input type="text" name="stan_konta" placeholder="Stan konta" class="form-control" required/><br>
                    <input type="submit" class="btn btn-primary" value="Zarejestruj!" name="register"/>
                </form>

            </div>
        </div>
    </div>
</body>

</html>