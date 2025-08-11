<?php
include "connect.php";


session_start();


if (isset($_POST['submit'])) {
    $utilizador = $_POST['username'];
    $senha = $_POST['password'];


    $password = hash('sha512', $senha);

    $sql = "SELECT * FROM utilizadores WHERE nome = '$utilizador'";
    $resultado = $conn->query($sql);
    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            if ($row["password"] == $password) {
                $_SESSION['username'] = $utilizador;
                header("Location: index.php");
            } else {
                echo "Login inválido";
                header("Location: login.php");
            }
        }
    }
}




?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/utilizadores/cssLogin.css">
</head>

<body>

    <div class="container">
        <div class="row mt-5">
            <div class="col"></div>
            <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header text-center">
                        <a href="" class="titulo">Intelligarden</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col"></div>
                            <div class="col-xl-10 col-lg-12 col-md-12 col-sm-12 col-12">
                                <form class="formulario" action="login.php" method="POST">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Username:</label>
                                        <input name="username" type="text" class="form-control" id="exampleInputEmail1" placeholder="Escreva o username" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Password:</label>
                                        <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Escreva a password" required>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary" style="width: 100%;">Submeter</button>
                                </form>
                            </div>
                            <div class="col"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>