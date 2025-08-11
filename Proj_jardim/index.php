<?php
include "connect.php";

session_start();

if (!isset($_SESSION['username'])) {
    header("refresh:1; url=login.php");
    die("Acesso restrito.");
}

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="assets/vendor/charts/chartist-bundle/chartist.css">
    <link rel="stylesheet" href="assets/vendor/charts/morris-bundle/morris.css">
    <link rel="stylesheet" href="assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendor/charts/c3charts/c3.css">
    <link rel="stylesheet" href="assets/vendor/fonts/flag-icon-css/flag-icon.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/vendor/datatables/css/dataTables.bootstrap4.css">


    <link rel="stylesheet" type="text/css" href="css/utilizadores/utilizador.css">


    <!-- ESTILOS JOAO -->
    <link rel="stylesheet" type="text/css" href="css/sensores/sensores_temperatura.css">
    <link rel="stylesheet" type="text/css" href="css/atuadores/atuador_AC.css">
    <link rel="stylesheet" type="text/css" href="css/pagina_inicial.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css">
    <title>Jardim Inteligente</title>
</head>

<body>


    <?php include_once('connect.php') ?>

    <?php
    # nav system
    if (isset($_GET["pagina"])) {
        $pag = $_GET["pagina"];
        # NAVBAR	
        include "includes/navbar.php";
        include($pag);
    } else {
        # NAVBAR
        include "includes/navbar.php";
        include "pagina_inicial.php";
        include "includes/footer.php";
    }
    ?>

    <!-- Optional JavaScript -->
    <!-- jquery 3.3.1 -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <!-- bootstap bundle js -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <!-- slimscroll js -->
    <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <!-- main js -->
    <script src="assets/libs/js/main-js.js"></script>
    <!-- chart chartist js -->
    <script src="assets/vendor/charts/chartist-bundle/chartist.min.js"></script>
    <!-- sparkline js -->
    <script src="assets/vendor/charts/sparkline/jquery.sparkline.js"></script>
    <!-- morris js -->
    <script src="assets/vendor/charts/morris-bundle/raphael.min.js"></script>
    <script src="assets/vendor/charts/morris-bundle/morris.js"></script>
    <!-- chart c3 js -->
    <script src="assets/vendor/charts/c3charts/c3.min.js"></script>
    <script src="assets/vendor/charts/c3charts/d3-5.4.0.min.js"></script>
    <script src="assets/vendor/charts/c3charts/C3chartjs.js"></script>
    <script src="assets/libs/js/dashboard-ecommerce.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/vendor/datatables/js/data-table.js"></script>



    <?php
    $array_temps = array();
    if (strpos($_SERVER['REQUEST_URI'], "sensor") == true) {
        if (strpos($nome, "temperatura")) {
            $nome_tabela = "temperatura";
        } else if (strpos($nome, "humidade")) {
            $nome_tabela = "humidade";
        } else if (strpos($nome, "agua")) {
            $nome_tabela = "agua";
        } else if (strpos($nome, "luz")) {
            $nome_tabela = "luz";
        } else if (strpos($nome, "vento")) {
            $nome_tabela = "vento";
        }

        // Corre todos os meses
        for ($i = 1; $i <= 12; $i++) {
            $sum = 0;
            $aux = $i + 1;
            $date = date("Y");

            # Query
            $query_temps = "SELECT * FROM log_sensor_$nome_tabela WHERE YEAR(hora) = YEAR(CURRENT_DATE()) AND MONTH(hora) = MONTH('$date-$i-01') AND nome = '$nome'";
            $resultado = $conn->query($query_temps);

            $total = 0;

            if ($resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
                    $total += $row['valor'];
                    $sum++;
                }
            }

            # Faz a media
            ($sum == 0) ? ($final = 0) : ($final = $total / $sum);
            # Mete os valores no array
            array_push($array_temps, $final);
        }
    }

    ?>

    <script>
        $(function() {
            if ($('#chart1').length) {
                new Chartist.Bar('#chart1', {
                    labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dec'],
                    series: [
                        [<?php
                            for ($i = 0; $i < 12; $i++) {
                                echo $array_temps[$i] . ",";
                            }
                            ?>]
                    ]
                }, {
                    stackBars: true,
                    axisY: {

                    }
                }).on('draw', function(data) {
                    if (data.type === 'bar') {
                        data.element.attr({
                            style: 'stroke-width: 30px'
                        });
                    }
                });
            }
        })
    </script>
</body>

</html>