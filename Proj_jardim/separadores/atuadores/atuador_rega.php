<?php
$nome = $_GET["nome"];

$sql4 = "SELECT * FROM dispositivos WHERE nome = '$nome'";
$resultado4 = $conn->query($sql4);
if ($resultado4->num_rows > 0) {
    while ($row = $resultado4->fetch_assoc()) {
?>

        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <h1>Rega</h1>
                    <hr>
                    <div class="row">
                        <div class="col"></div>

                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <div class="card-body corpoEstadoAtuadores text-center">
                                    <div class="icon text-center">
                                        <h1><?php echo ucfirst(preg_replace('/_/', ' ', $nome))  ?></h1>
                                        <?php if ($row["estado"] == 1) { ?>
                                            <h2>Ligado</h2>
                                        <?php } else { ?>
                                            <h2>Desligado</h2>
                                        <?php } ?>
                                    </div>
                                    <form action="../../api/api.php" method="POST" class="text-center">
                                        <input type="hidden" id="nomeEscondidoEstado" name="nome" value="<?php echo $row["nome"]; ?>">
                                        <input type="hidden" id="valorEscondido" name="valor" value="<?php echo $row["valor"]; ?>">
                                        <input type="hidden" id="tipoEscondido" name="tipo_disp" value="<?php echo $row["tipo_disp"]; ?>">
                                        <?php if ($row["estado"] == 1) { ?>
                                            <button type="submit" class="btn btn-danger btnEstado mt-3" name="estado" id="btnEstado" value="0">Desativar</button>
                                        <?php } else { ?>
                                            <button type="submit" class="btn btn-success btnEstado mt-3" name="estado" id="btnEstado" value="1">Ativar</button>
                                        <?php } ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                <?php
            }
        }
                ?>

                <div class="col"></div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Histórico</h5>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered first">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Nome</th>
                                                    <th scope="col">Valor</th>
                                                    <th scope="col">Estado</th>
                                                    <th scope="col">Hora</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql4 = "SELECT * FROM log_atuadores_bool WHERE nome = '$nome'";
                                                $resultado4 = $conn->query($sql4);
                                                if ($resultado4->num_rows > 0) {
                                                    while ($row = $resultado4->fetch_assoc()) {
                                                ?>
                                                        <tr>

                                                            <th scope="row"><?php echo $row["id"] ?></th>
                                                            <td><?php echo $row["nome"] ?></td>
                                                            <td>--</td>
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