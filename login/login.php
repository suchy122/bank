<?php
    include_once("head.php");
    session_start();
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
                        <a class="nav-link" href="login.php">Logowanie
                        <span class="sr-only">(current)</span>       
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Rejestracja</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="wrapper">
            <div class="jumbotron">
                <h1>Logowanie</h1>
                <form method="POST" action="logging.php" role="form">
                    <input type="text" name="login" placeholder="Login" class="form-control" /><br>
                    <input type="password" name="password" placeholder="Hasło" class="form-control" /><br>
                    <input type="submit" class="btn btn-primary" value="Zaloguj" name="loginn" />
                </form>

                <?php
                    if(isset($_SESSION['blad'])){
                        echo $_SESSION['blad'];
                    }
                ?>

            </div>
        </div>
    </div>
</body>

</html>