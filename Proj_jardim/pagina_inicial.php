<!-- =============================== CORPO ================================== -->
<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h1 class="pageheader-title">Sensores em Tempo Real</h1>
                    </div>
                </div>
            </div>

            <div class="ecommerce-widget">
                <hr>
                <h3>Sensores de Temperatura</h3>
                <!-- 1º LINHA DE SENSORES -->
                <div class="row">
                    <?php
                    $sql1 = "SELECT * FROM dispositivos WHERE nome LIKE '%sensor%' AND tipo_disp = '1'"; // IR ACRESCENTANDO O RESTO DOS SENSORES Á MEDIDA QUE VAMOS FAZENDO
                    $resultado = $conn->query($sql1);
                    if ($resultado->num_rows > 0) {
                        while ($row = $resultado->fetch_assoc()) {
                            if (strpos($row['nome'], "temperatura")) {
                                $valor = $row['valor'] . "ºC";
                            } else if (strpos($row['nome'], "humidade")) {
                                $valor = $row['valor'] . "%";
                            } else if (strpos($row['nome'], "agua")) {
                                $valor = $row['valor'] . "cm";
                            } else if (strpos($row['nome'], "luz")) {
                                ($row['valor'] == 1023) ? $valor = "Há luz" : $valor = "Não há luz";
                            } else if (strpos($row['nome'], "vento")) {
                                ($row['valor'] == 1023) ? $valor = "Há vento" : $valor = "Não há vento";
                            }
                    ?>
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card cardInicial">
                                    <div class="card-body">
                                        <h5 class="text-muted"><?php echo $row['nome'] ?></h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1"><?php echo $valor ?></h1>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <h5 class="text-muted"><?php echo $row['hora'] ?></h5>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
                <hr>

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-5">
                    <div class="page-header">
                        <h1 class="pageheader-title">Atuadores em Tempo Real</h1>
                    </div>
                </div>
                <hr class="mt-5">
                <h3>Atuadores de Controlo de Valores</h3>

                <div class="row">
                    <?php
                    $sql1 = "SELECT * FROM dispositivos WHERE tipo_disp = '2'"; // IR ACRESCENTANDO O RESTO DOS SENSORES Á MEDIDA QUE VAMOS FAZENDO
                    $resultado = $conn->query($sql1);
                    if ($resultado->num_rows > 0) {
                        while ($row = $resultado->fetch_assoc()) {
                    ?>
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card cardInicial">
                                    <div class="card-body">
                                        <h5 class="text-muted"><?php echo $row['nome'] ?></h5>
                                        <div class="metric-value d-inline-block">
                                            <?php
                                            if ($row["estado"] == 1) {
                                            ?><h1 class="mb-1">Ligado</h1>
                                            <?php
                                            } else {
                                            ?><h1 class="mb-1">Desligado</h1>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <!--            PARA O CASO DE QUERER-MOS UM VALOR AO LADO (VER TEMPLATE)
                                        <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                            <span><i class="fa fa-fw fa-arrow-up"></i></span><span>5.86%</span>
                                        </div>
                                        -->
                                    </div>
                                    <div class="card-footer">
                                        <h5 class="text-muted"><?php echo $row['hora'] ?></h5>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

</div>