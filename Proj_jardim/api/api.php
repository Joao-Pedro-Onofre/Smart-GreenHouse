<?php
include "../connect.php";

header('Content-Type: text/html; charset=utf-8');
$request = $_SERVER['REQUEST_METHOD'];


if ($request == "POST") {
    if (isset($_POST["valor"]) && isset($_POST["estado"]) && isset($_POST["nome"])) {

        //guardar POST em variaveis
        $nome = $_POST["nome"];
        $valor = $_POST["valor"];
        $estado = $_POST["estado"];
        $tipo_disp = $_POST["tipo_disp"];


        //fazer UPDATE da informação mas recente do disposito
        $sql = "UPDATE dispositivos SET valor = '$valor', estado = '$estado' WHERE nome = '$nome'";
        $resultado = $conn->query($sql);
        echo $sql;

        //guardar so a palavra que identifica o tipo do dispositivo e criar uma variavel para definir a tabela para onde vai o log
        $tabelaQuery = explode('_', $_POST["nome"]);
        ($tipo_disp == 1) ? $tabela = "log_sensor_$tabelaQuery[1]" : $tabela = "log_atuadores_bool";


        //INSERT do log
        $sql = "INSERT INTO $tabela (nome, valor, estado) VALUES ('$nome', $valor, '$estado')";
        $resultado = $conn->query($sql);
        echo $sql;

        //valida se a query foi inserida com sucesso
        if ($resultado == false) {
            echo ("ERRO!:" . "<br>" . $conn->error);
        } else {
            if ($tipo_disp == 1) {
                header("Location: http://proj_jardim.test/index.php?pagina=separadores/sensores/sensor_$tabelaQuery[1].php&nome=$nome");
            } else {
                header("Location: http://proj_jardim.test/index.php?pagina=separadores/atuadores/atuador_$tabelaQuery[1].php&nome=$nome");
            }
        }
    }
} elseif ($request == "GET") {
    if (isset($_GET["nome"])) {

        $nome = $_GET["nome"];

        $sql = "SELECT * FROM dispositivos WHERE nome = '$nome'";
        $resultado = $conn->query($sql);
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $array_campos = array($row["nome"], " ",  $row["valor"], " ", $row["estado"]);
                echo implode($array_campos);
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
