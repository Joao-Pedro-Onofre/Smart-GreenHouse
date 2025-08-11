<?php
include "../connect.php";

header('Content-Type: text/html; charset=utf-8');
$request = $_SERVER['REQUEST_METHOD'];


if ($request == "POST") {
    if (isset($_POST["valor"]) && isset($_POST["estado"]) && isset($_POST["nome"])) {

        if ($_POST["tipo_disp"] == 1) {

            $nome = $_POST["nome"];
            $valor = $_POST["valor"];
            $estado = $_POST["estado"];
            $hora = $_POST["hora"];
            $tipo_disp = $_POST["tipo_disp"];

            if (strpos($_POST["nome"], "temperatura")) {
                $tabelaQuery = "temperatura";
            } elseif (strpos($_POST["nome"], "dioxido")) {
                $tabelaQuery = "dioxido";
            } elseif (strpos($_POST["nome"], "humidade")) {
                $tabelaQuery = "humidade";
            } elseif (strpos($_POST["nome"], "luz")) {
                $tabelaQuery = "luz";
            } elseif (strpos($_POST["nome"], "vento")) {
                $tabelaQuery = "vento";
            }

            $sql = "UPDATE dispositivos SET valor = '$valor', estado = '$estado' WHERE nome = '$nome'";
            $resultado = $conn->query($sql);

            $sql2 = "INSERT INTO log_sensor_$tabelaQuery (nome, valor, estado) VALUES ('$nome', $valor, '$estado')";
            $resultado2 = $conn->query($sql2);

            if ($resultado == false || $resultado2 == false) {
                echo ("ERRO!:" . "<br>" . $conn->error);
            } else {
                header("Location:" . $_SERVER["HTTP_REFERER"]);
            }
        } elseif ($_POST["tipo_disp"] == 2) {

            $nome = $_POST["nome"];
            $valor = $_POST["valor"];
            $estado = $_POST["estado"];
            $tipo_disp = $_POST["tipo_disp"];


            $sql = "UPDATE dispositivos SET valor = '$valor', estado = '$estado' WHERE nome = '$nome'";
            $resultado = $conn->query($sql);

            $sql2 = "INSERT INTO log_atuadores_bool (nome, valor, estado) VALUES ('$nome', $valor, '$estado')";
            $resultado2 = $conn->query($sql2);

            if ($resultado == false || $resultado2 == false) {
                echo ("ERRO!:" . "<br>" . $conn->error);
            } else {
                header("Location:" . $_SERVER["HTTP_REFERER"]);
            }
        }
    }
} elseif ($request == "GET") {
    if (isset($_GET["nome"])) {

        $nome = $_GET["nome"];

        $sql = "SELECT valor FROM dispositivos WHERE nome = '$nome'";
        $resultado = $conn->query($sql);
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                echo $row["valor"];
            }
        } else {
            http_response_code(422);
        }
    } else {
        http_response_code(400);
    }
} else {
    http_response_code(403);
}
