<?php
    include_once("head.php");
    session_start();
    unset($_SESSION['blad']);

    if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == "admin")){
        header('Location: ../admin/index.php');
        exit();
    } elseif((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == false)){
        header('Location: ../user/index.php');
        exit();
    } 


    if(isset($_POST['message'])){
        $wszystko_ok = true;

        $name = $_SESSION['imie'];
        $surname = $_SESSION['nazwisko'];
        $email = $_SESSION['email'];
        $message = $_POST['message'];
    
        require_once "../database/connect.php";
        mysqli_report(MYSQLI_REPORT_STRICT);
        $con = new mysqli($host,$db_user,$db_password,$db_name);
        try {
            
            if($con->connect_errno!=0){
                throw new Exception(mysqli_connect_errno());
            } else {
                if($con->query("INSERT INTO contact VALUES (NULL,'$name','$surname','$email','$message')")){
                    echo '<script>alert("Wiadomość została wysłana, czekaj na odpowiedź!")
                    location.href="index.php";</script>';
                }
            }
        } catch(Exception $ex){
            throw new Exception($con->error);
        }
        $con->close();
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


                <form id="contact-form" method="post" role="form">

                    <div class="messages"></div>

                    <div class="controls">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_name">Imię</label>
                                    <input id="form_name" type="text" name="name" class="form-control"
                                        value="<?php echo $_SESSION['imie']?>" disabled>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_lastname">Naziwsko *</label>
                                    <input id="form_lastname" type="text" name="surname" class="form-control"
                                        value="<?php echo $_SESSION['nazwisko']?>" disabled>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_email">Email *</label>
                                    <input id="form_email" type="email" name="email" class="form-control"
                                        value="<?php echo $_SESSION['email']?>" disabled>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="form_message">Wiadomość *</label>
                                    <textarea id="form_message" name="message" class="form-control"
                                        placeholder="Wiadomość *" rows="4" required="required"
                                        data-error="Please, leave us a message."></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-success btn-send" value="Wyślij">
                            </div>
                        </div>
                        <div class="row">

                        </div>
                    </div>

                </form>
                <?php 
                        if(isset($_SESSION['e_login']))
                        {
                            echo '<div style="color:red; margin-top:10px; margin-bottom:10px;">'.$_SESSION['e_login'].'</div>';
                            unset($_SESSION['e_login']);
                        }
                    ?><br>
            </div>
        </div>
    </div>
</body>