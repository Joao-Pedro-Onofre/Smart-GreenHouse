<?php
$request = $_SERVER['REQUEST_METHOD'];

$nome = $_GET["nome"];

$sql2 = "SELECT * FROM dispositivos WHERE nome = '$nome'";
$resultado2 = $conn->query($sql2);

$sql3 = "SELECT * FROM log_sensor_temperatura WHERE nome = '$nome'";
$resultado3 = $conn->query($sql3);


?>

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title"><?php echo ucfirst(preg_replace('/_/', ' ', $nome))  ?></h2>
                    </div>
                </div>
            </div>

            <div class="row" id="rowValores">

                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="row rowInfoCard">
                        <?php
                        if ($resultado2->num_rows > 0) {
                            while ($row = $resultado2->fetch_assoc()) {
                        ?>

                                <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="card">
                                        <div class="card-body">

                                            <h5 class="text-muted"> Temperatura Atual </h5>
                                            <div class="metric-value d-inline-block">
                                                <h1 class="mb-1"><?php echo $row["valor"] ?>ºC</h1>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 col-12 infoCard">
                                    <div class="card">
                                        <div class="card-body">

                                            <h5 class="text-muted">Temperatura Média Mensal</h5>
                                            <div class="metric-value d-inline-block">
                                                <h1 class="mb-1">15ºC</h1>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                        <?php
                            }
                        }
                        ?>


                        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="text-muted">Temperatura Média Anual</h5>
                                    <div class="metric-value d-inline-block">
                                        <h1 class="mb-1">15ºC</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-xl-9 col-lg-6 col-md-6 col-sm-12 col-12" id="cardGrafico">
                    <div class="card">
                        <h5 class="card-header">Temperatura Semanal</h5>
                        <div class="card-body colunaGrafico">
                            <div class="ct-chart-line ct-golden-section" id="chart1"></div>
                        </div>
                    </div>
                </div>

            </div>



            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <h5 class="card-header">Basic Table</h5>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered first">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">Valor</th>
                                            <th scope="col">Hora</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($resultado3->num_rows > 0) {
                                            while ($row = $resultado3->fetch_assoc()) {
                                        ?>
                                                <tr>
                                                    <th scope="row"><?php echo $row["id"] ?></th>
                                                    <td><?php echo $row["nome"] ?></td>
                                                    <?php
                                                    if ($row["estado"] == 1) {
                                                        $estado = "Ativado";
                                                    ?><td><span class="badge badge-success"><?php echo $estado; ?></span></td>
                                                    <?php
                                                    } else {
                                                        $estado = "Desativado";
                                                    ?><td><span class="badge badge-danger"><?php echo $estado; ?></span></td>
                                                    <?php
                                                    }
                                                    ?>
                                                    <td><?php echo $row["valor"] ?>ºC</td>
                                                    <td><?php echo $row["hora"] ?></td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>





        </div>
    </div>
</div>