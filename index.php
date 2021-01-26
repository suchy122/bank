<?php
    include_once("head.php");
?>

<style>
body {
    background-image: url('image/bank.jpg');
}
</style>

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
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login/login.php">Logowanie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login/register.php">Rejestracja</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="wrapper">
            <div class="jumbotron">
                <center>
                    <h1>Witaj w naszym banku!</h1>
                    <p>
                    <h3>Dołącz do nas już dzisiaj, jesteśmy najlepsi na rynku!</h3>
                    </p>
                    <form action="login/register.php">
                        <!-- <button type="button" class="btn btn-primary btn-lg">ZAREJESTRUJ SIĘ!</button> -->
                        <input type="submit" class="btn btn-primary btn-lg" value="ZAREJESTRUJ SIĘ!">
                    </form>
                </center>
            </div>
        </div>
    </div>
</body>

</html>