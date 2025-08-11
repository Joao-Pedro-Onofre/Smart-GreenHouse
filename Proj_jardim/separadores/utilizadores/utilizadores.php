<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">


            <?php if ($_SESSION['username'] != "admin") { ?>
            <div class="row">
                <div class="col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-4">

                    <!-- Perfil -->
                    <div class="profile-card card rounded-lg shadow p-4 p-xl-5 mb-4 text-center">
                        <div class="banner"></div>

                        <?php 
                        $pasta = "imagens/"; $nome = $_SESSION['username']; $extensao = ".png";
                        $caminhoImagem = $pasta . $nome . $extensao; 
                        ?>
                        <img src="<?php echo $caminhoImagem ?>" alt="Imagem" class="img-circle mx-auto mb-3">

                        <h3 class="mb-4"> <td> <?php echo $_SESSION["username"]; ?></td> </h3>

                        <div class="text-left mb-4">
                             <p class="mb-2"><i class="fa fa-envelope mr-2"></i> <?php echo $_SESSION["email"]; ?></p>
                            <!--<p class="mb-2"><i class="fa fa-phone mr-2"></i>9135746</p>
                            <p class="mb-2"><i class="fa fa-map-marker-alt mr-2"></i>Benedita</p> --> 

                        </div>
                    </div>
                </div>
            </div>


            <?php }else{ ?>

                
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <h5 class="card-header">Basic Table</h5>
                        <div class="card-body">
                            <div class="table-responsive">
                                    <table class="table table-striped table-bordered first">
                                        <thead>
                                            <tr>
                                                <th scope="col">Id</th>
                                                <th scope="col">Nome</th>
                                                <th scope="col">Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM utilizadores";
                                            $nomes = $conn->query($sql);
                                            if ($nomes->num_rows > 0) {
                                                while ($row = $nomes->fetch_assoc()) {
                                            ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $row["id"] ?></th>
                                                        <td><?php echo $row["nome"] ?></td>
                                                        <td><?php echo $row["email"] ?></td>
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
            <?php } ?>
        </div>
    </div>
</div>