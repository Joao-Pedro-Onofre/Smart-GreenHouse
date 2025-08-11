<?php
  $nomeServer = "localhost";
  $utilizador = "root";
  $password = "";
  $nomeBD = "proj_jardim_teste";

  //CRIAR CONECÇÃO
  $conn = new mysqli($nomeServer, $utilizador, $password, $nomeBD);
  mysqli_set_charset($conn, "utf8");

  //VALIDAR CONECÇÃO
  if ($conn->connect_error) {
    die("Conecção falhada:" . $conn->connect_error);
  }
