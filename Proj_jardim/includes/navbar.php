<?php
$pasta = "imagens/";
$nome = $_SESSION['username'];
$extensao = ".png";
$caminhoImagem = $pasta . $nome . $extensao;
?>
<div class="dashboard-main-wrapper">
    <!-- =============================== INICIO MENU ================================== -->
    <div class="dashboard-header">
        <nav class="navbar navbar-expand-lg bg-white fixed-top">
            <a class="navbar-brand" href="index.php">InteliGarden</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto navbar-right-top">
                    <li class="nav-item dropdown nav-user">
                        <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo $caminhoImagem ?>" alt="imagem_utilizador" class="user-avatar-md rounded-circle"></a>
                        <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                            <div class="nav-user-info">

                                <a class="" href="?pagina=separadores/utilizadores/utilizadores.php">
                                    <h5 class="mb-0 text-white nav-user-name"><?php echo $_SESSION['username'] ?></h5>
                                </a>
                            </div>
                            <a class="dropdown-item" href="logout.php"><i class="fas fa-power-off mr-2"></i>Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="nav-left-sidebar sidebar-dark">
        <div class="menu-list">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav flex-column">


                        <!-- MENU DE UTILIZADORES       -->
                        <!-- apenas o admin tem acesso  -->
                        <?php if ($_SESSION['username'] == "admin") { ?>

                            <li class="nav-divider">
                                Utilizadores
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i class="fa fa-fw fa-user-circle"></i>Utilizadores <span class="badge badge-success">6</span></a>
                                <div id="submenu-1" class="collapse submenu">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="?pagina=separadores/utilizadores/utilizadores.php">Lista de Utilizadores</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        <?php } ?>
                        <li class="nav-divider">
                            Sensores
                        </li>
                        <li class="nav-item">
                            <!--================ LISTA SENSORES TEMPERATURA =================== -->
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fas fa-f fa-folder"></i>Sensores Temperatura</a>
                            <div id="submenu-2" class="collapse submenu">
                                <ul class="nav flex-column">
                                    <?php
                                    $sql = "SELECT * FROM dispositivos WHERE nome LIKE '%temperatura%' AND tipo_disp = '1'"; // IR ACRESCENTANDO O RESTO DOS SENSORES Á MEDIDA QUE VAMOS FAZENDO
                                    $resultado = $conn->query($sql);
                                    if ($resultado->num_rows > 0) {
                                        while ($row = $resultado->fetch_assoc()) {
                                    ?>
                                            <li class="nav-item">
                                                <a class="nav-link" href="?pagina=separadores/sensores/sensor_temperatura.php&nome=<?php echo $row["nome"]; ?>"><?php echo $row["nome"]; ?></a>
                                            </li>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-f fa-folder"></i>Sensores Humidade Ar</a>
                            <div id="submenu-3" class="collapse submenu">
                                <ul class="nav flex-column">
                                    <?php
                                    $sql = "SELECT * FROM dispositivos WHERE nome LIKE '%humidade%' AND tipo_disp = '1'";
                                    $resultado = $conn->query($sql);
                                    if ($resultado->num_rows > 0) {
                                        while ($row = $resultado->fetch_assoc()) {
                                    ?>
                                            <li class="nav-item">
                                                <a class="nav-link" href="?pagina=separadores/sensores/sensor_humidade_ar.php&nome=<?php echo $row["nome"]; ?>"><?php echo $row["nome"]; ?></a>
                                            </li>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-6" aria-controls="submenu-6"><i class="fas fa-f fa-folder"></i>Sensores Nivel Água</a>
                            <div id="submenu-6" class="collapse submenu">
                                <ul class="nav flex-column">
                                    <?php
                                    $sql = "SELECT * FROM dispositivos WHERE nome LIKE '%agua%' AND tipo_disp = '1'";
                                    $resultado = $conn->query($sql);
                                    if ($resultado->num_rows > 0) {
                                        while ($row = $resultado->fetch_assoc()) {
                                    ?>
                                            <li class="nav-item">
                                                <a class="nav-link" href="?pagina=separadores/sensores/sensor_nivel_agua.php&nome=<?php echo $row["nome"]; ?>"><?php echo $row["nome"]; ?></a>
                                            </li>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-4"><i class="fas fa-f fa-folder"></i>Sensores Luz</a>
                            <div id="submenu-4" class="collapse submenu">
                                <ul class="nav flex-column">
                                    <?php
                                    $sql = "SELECT * FROM dispositivos WHERE nome LIKE '%luz%' AND tipo_disp = '1'";
                                    $resultado = $conn->query($sql);
                                    if ($resultado->num_rows > 0) {
                                        while ($row = $resultado->fetch_assoc()) {
                                    ?>
                                            <li class="nav-item">
                                                <a class="nav-link" href="?pagina=separadores/sensores/sensor_luz.php&nome=<?php echo $row["nome"]; ?>"><?php echo $row["nome"]; ?></a>
                                            </li>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-5" aria-controls="submenu-5"><i class="fas fa-f fa-folder"></i>Sensores Velocidade Vento</a>
                            <div id="submenu-5" class="collapse submenu">
                                <ul class="nav flex-column">
                                    <?php
                                    $sql = "SELECT * FROM dispositivos WHERE nome LIKE '%vento%' AND tipo_disp = '1'";
                                    $resultado = $conn->query($sql);
                                    if ($resultado->num_rows > 0) {
                                        while ($row = $resultado->fetch_assoc()) {
                                    ?>
                                            <li class="nav-item">
                                                <a class="nav-link" href="?pagina=separadores/sensores/sensor_vento.php&nome=<?php echo $row["nome"]; ?>"><?php echo $row["nome"]; ?></a>
                                            </li>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-divider">
                            Atuadores
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-8" aria-controls="submenu-8"><i class="fas fa-f fa-folder"></i>Ares Condicionados</a>
                            <div id="submenu-8" class="collapse submenu">
                                <ul class="nav flex-column">
                                    <?php
                                    $sql = "SELECT * FROM dispositivos WHERE nome LIKE '%ac%' AND tipo_disp = '2'";
                                    $resultado = $conn->query($sql);
                                    if ($resultado->num_rows > 0) {
                                        while ($row = $resultado->fetch_assoc()) {
                                    ?>
                                            <li class="nav-item">
                                                <a class="nav-link" href="?pagina=separadores/atuadores/atuador_AC.php&nome=<?php echo $row["nome"]; ?>"><?php echo $row["nome"]; ?></a>
                                            </li>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-9" aria-controls="submenu-9"><i class="fas fa-f fa-folder"></i>Janelas</a>
                            <div id="submenu-9" class="collapse submenu">
                                <ul class="nav flex-column">
                                    <?php
                                    $sql = "SELECT * FROM dispositivos WHERE nome LIKE '%janela%' AND tipo_disp = '2'";
                                    $resultado = $conn->query($sql);
                                    if ($resultado->num_rows > 0) {
                                        while ($row = $resultado->fetch_assoc()) {
                                    ?>
                                            <li class="nav-item">
                                                <a class="nav-link" href="?pagina=separadores/atuadores/atuador_janela.php&nome=<?php echo $row["nome"]; ?>"><?php echo $row["nome"]; ?></a>
                                            </li>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-10" aria-controls="submenu-10"><i class="fas fa-f fa-folder"></i>Luzes</a>
                            <div id="submenu-10" class="collapse submenu">
                                <ul class="nav flex-column">
                                    <?php
                                    $sql = "SELECT * FROM dispositivos WHERE nome LIKE '%luz%' AND tipo_disp = '2'";
                                    $resultado = $conn->query($sql);
                                    if ($resultado->num_rows > 0) {
                                        while ($row = $resultado->fetch_assoc()) {
                                    ?>
                                            <li class="nav-item">
                                                <a class="nav-link" href="?pagina=separadores/atuadores/atuador_luz.php&nome=<?php echo $row["nome"]; ?>"><?php echo $row["nome"]; ?></a>
                                            </li>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-11" aria-controls="submenu-11"><i class="fas fa-f fa-folder"></i>Regas Chão</a>
                            <div id="submenu-11" class="collapse submenu">
                                <ul class="nav flex-column">
                                    <?php
                                    $sql = "SELECT * FROM dispositivos WHERE nome LIKE '%rega%' AND tipo_disp = '2'";
                                    $resultado = $conn->query($sql);
                                    if ($resultado->num_rows > 0) {
                                        while ($row = $resultado->fetch_assoc()) {
                                    ?>
                                            <li class="nav-item">
                                                <a class="nav-link" href="?pagina=separadores/atuadores/atuador_rega.php&nome=<?php echo $row["nome"]; ?>"><?php echo $row["nome"]; ?></a>
                                            </li>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-12" aria-controls="submenu-12"><i class="fas fa-f fa-folder"></i>Portas</a>
                            <div id="submenu-12" class="collapse submenu">
                                <ul class="nav flex-column">
                                    <?php
                                    $sql = "SELECT * FROM dispositivos WHERE nome LIKE '%porta%' AND tipo_disp = '2'";
                                    $resultado = $conn->query($sql);
                                    if ($resultado->num_rows > 0) {
                                        while ($row = $resultado->fetch_assoc()) {
                                    ?>
                                            <li class="nav-item">
                                                <a class="nav-link" href="?pagina=separadores/atuadores/atuador_porta.php&nome=<?php echo $row["nome"]; ?>"><?php echo $row["nome"]; ?></a>
                                            </li>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-13" aria-controls="submenu-13"><i class="fas fa-f fa-folder"></i>Humidificadores</a>
                            <div id="submenu-13" class="collapse submenu">
                                <ul class="nav flex-column">
                                    <?php
                                    $sql = "SELECT * FROM dispositivos WHERE nome LIKE '%humidade%' AND tipo_disp = '2'";
                                    $resultado = $conn->query($sql);
                                    if ($resultado->num_rows > 0) {
                                        while ($row = $resultado->fetch_assoc()) {
                                    ?>
                                            <li class="nav-item">
                                                <a class="nav-link" href="?pagina=separadores/atuadores/atuador_humidade.php&nome=<?php echo $row["nome"]; ?>"><?php echo $row["nome"]; ?></a>
                                            </li>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </li>

                    </ul>
                </div>
            </nav>
        </div>
    </div>

</div>